<template>
    <Header>
    </Header>

    <div class="flex justify-center pt-28 px-4">
        <div>
            <h1 class="text-2xl text-center">
                Editar receta
            </h1>
            <div v-show="errors != null" class=" bg-red-600 text-white rounded-md">
                <!-- <p>
                    {{ mesagge }}
                </p> -->
                <div v-for="error in errors">
                    <p class="p-2">- {{ error }}</p>
                </div>
            </div>
            <form @submit.prevent="update" class="mt-10 space-y-4">
                <div>
                    <p>Nombre</p>
                    <input 
                        type="text" 
                        v-model="form.name"
                        class="rounded-md border border-gray-500 w-full"
                        
                    >
                </div>
                <div>
                    <p>Porciones</p>
                    <div class="flex space-x-2">
                        <img 
                            src="../../../img/less.png" 
                            alt="Restar" 
                            class="bg-indigo-600 w-10 rounded-md cursor-pointer"
                            @click="lessPortion">
                        <input 
                            type="number" 
                            v-model="form.portions"
                            class="rounded-md text-center"
                            required
                            >
                        <img 
                            src="../../../img/plus.png" 
                            alt="Sumar" 
                            class="bg-indigo-600 w-10 rounded-md cursor-pointer"
                            @click="addPortion">
                    </div>
                </div>
                <div>
                    <p>Descripción</p>
                    <textarea cols="34" rows="3" class="rounded-md" v-model="form.description" required></textarea>
                </div>
                <div>
                    <p>Foto</p>
                    <input type="file" accept="image/*" ref="photo" @input="form.image = $event.target.files[0]">
                </div>
                
                <div>
                    <h2 class="text-xl text-center">
                        Ingredientes
                    </h2>
                    <div class="flex justify-around">
                        <p>
                            Cantidad
                        </p>
                        <p>
                            Unidad medida
                        </p>
                        <p>
                            Ingrediente
                        </p>
                        <p></p>
                    </div>
                    <div class="flex items-center mb-2 md:space-x-4" v-for="(ingredient, index) in form.ingredients" :key="index">
                        <div>
                            <input v-model="ingredient.amount" type="number" class="w-20" required>
                        </div>
                        <div>
                            <select v-model="ingredient.unit_of_measurement" required>
                                <option value="Al gusto">Al gusto</option>
                                <option value="Gramo(S)">Gramo</option>
                                <option value="Kilogramo(s)">Kilogramo</option>
                                <option value="Litro(s)">Litro</option>
                            </select>
                        </div>
                        <div>
                            <input 
                                type="text" 
                                placeholder="Nombre"
                                class="w-28"
                                v-model="ingredient.ingredient"
                                required
                                >
                        </div>
                        <div>
                            <img 
                                src="../../../img/trash.png" 
                                alt="Borrar"
                                class="bg-red-600 p-1 hover:bg-red-500 w-10 rounded-md ml-1"
                                @click="deleteIngredient(index, ingredient.id)"   
                            >
                        </div>
                    </div>
                    <div 
                        class="flex justify-center items-center space-x-2 mt-2 cursor-pointer"
                        @click="addIngredient()">
                        <p class="text-blue-600 hover:text-blue-500">
                            Agregar ingrediente
                        </p>
                        <img 
                            src="../../../img/plus.png" 
                            alt="Agregar ingrediente"
                            class="bg-blue-600 p-1 hover:bg-blue-500 w-8 rounded-md"
                        >
                    </div>
                </div>
                <div class="flex justify-center">
                    <div>
                        <h2 class="text-xl text-center">
                            Pasos
                        </h2>
                        <div 
                            class="flex space-x-2 items-end space-y-4"
                            v-for="(step, index) in form.steps" :key="index"
                        >
                            <div>
                                <input 
                                    type="text" 
                                    class="w-34 rounded-md"
                                    v-model="step.step"
                                    required
                                >
                            </div>
                            <div>
                                <img 
                                    src="../../../img/trash.png" 
                                    alt="Borrar"
                                    class="bg-red-600 p-1 hover:bg-red-500 w-9 rounded-md"
                                    @click="deleteStep(index, step.id)" 
                                >
                            </div>
                        </div>
                        <div 
                            class="flex justify-center items-center space-x-2 mt-2 cursor-pointer"
                            @click="addStep()">
                            <p class="text-blue-600 hover:text-blue-500">
                                Agregar paso
                            </p>
                            <img 
                                src="../../../img/plus.png" 
                                alt="Agregar ingrediente"
                                class="bg-blue-600 p-1 hover:bg-blue-500 w-8 rounded-md"
                            >
                        </div>
                        
                    </div>
                </div>
                <button class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-md">
                    Guardar
                </button>
            </form>
        </div>
    </div>

</template>


<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineComponent } from '@vue/runtime-core';
import Header from '../Header/Header.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { defineProps } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

defineComponent({
    Header,
    Link
});

const props = defineProps({
    recipe: Object,
    errors: Object,
});

const form = useForm({
    name: props.recipe.name,
    description: props.recipe.description,
    portions: props.recipe.portions,
    image: '',
    ingredients: [...props.recipe.ingredients],
    steps: [...props.recipe.steps],
    ingredientIdDelete: [],
    stepIdDelete: []
});

let mesagge = null
let error = "hi"

// function infoForUser() {
    // Object.keys(props.errors).forEach(element => {
    //     if(element != null) {
    //         error = true;
    //         mesagge = "Error | Los siguente campos son requeridos:";
    //     } else {
    //         error = false;
    //         mesagge = "Receta guardada con éxito";
    //     }
    // });
// }

function update() {
    Inertia.post(`/receta/${props.recipe.id}`, {
    _method: 'put',
    name: form.name,
    description: form.description,
    portions: form.portions,
    image: form.image,
    ingredients: form.ingredients,
    steps: form.steps,
    ingredientIdDelete: form.ingredientIdDelete,
    stepIdDelete: form.stepIdDelete
    })
}

function lessPortion() {
    if (form.portions != 1) {
        form.portions += - 1;
    }
}

function addPortion() {
    form.portions += 1;
}

function addIngredient() {
    form.ingredients.push({
        ingredient: "",
        amount: 1,
        unit_of_measurement: "",
    });
}

function addStep() {
    form.steps.push({
        step: "",
    });
}

function deleteIngredient(index, ingredient_id) {
    if(index != null) {
        form.ingredients.splice(index, 1);
        form.ingredientIdDelete.push(ingredient_id);
    } else {
        form.ingredients.pop();
    }
}

function deleteStep(index, step_id) {
    if(index != null) {
        form.steps.splice(index, 1);
        form.stepIdDelete.push(step_id);
    } else {
        form.steps.pop();
    }
}

// export default {
//     components: {
//         Header,
//         Link
//     },
//     props: {
//         recipe: Object,
//     },
//     data() {
//         return {
//             form: {
//                 name: this.recipe.name,
//                 description: this.recipe.description,
//                 portions: this.recipe.portions,
//                 image: '',
//                 ingredients: [...this.recipe.ingredients],
//                 steps: [...this.recipe.steps],
//             },
//             mesagge: null,
//         }
//     },
//     methods: {
//         update() {
//             this.$inertia.put(this.route('recipe.update'), this.form);
//         },
//         // submit() {
//         //     if (this.$refs.photo) {
//         //         this.form.image = this.$refs.photo.files[0];
//         //     }
//         //     this.$inertia.post(this.route('recipe.store'), this.form);
            
//         //     this.form.name = '';
//         //     this.form.description = '';
//         //     this.form.portions = 1;
//         //     this.form.image = '';
//         //     this.form.ingredients = [];
//         //     this.form.steps = [];

//         //     this.mesagge = "Receta guardada con éxito";
//         //     return this.mesagge;
//         // },
//         lessPortion() {
//             if (this.form.portions != 1) {
//                 this.form.portions += - 1;
//             }
//         },
//         addPortion() {
//             this.form.portions += 1;
//         },
//         addIngredient() {
//             this.form.ingredients.push({
//                 ingredient: "",
//                 amount: 1,
//                 unit_of_measurement: "",
//             });
//         },
//         addStep() {
//             this.form.steps.push({
//                 step: "",
//             });
//         },
//         deleteIngredient(id) {
//             if(id != null) {
//                 this.form.ingredients.splice(id - 1, 1);
//             } else {
//                 this.form.ingredients.pop();
//             }
//         },
//         deleteStep(id) {
//             if(id != null) {
//                 this.form.steps.splice(id - 1, 1);
//             } else {
//                 this.form.steps.pop();
//             }
//         },
//     },
// }
</script>