<template>
    <Header>
    </Header>

    <div class="flex justify-center pt-28 px-4">
        <div>
            <h1 class="text-2xl text-center">
                Editar receta
            </h1>
            {{ error }}
            <div v-show="mesagge != null" class="p-2 bg-green-500 text-white rounded-md">
                <p>
                    {{ mesagge }}
                </p>
            </div>
            <form @submit.prevent="submit" class="mt-10 space-y-4">
                <div>
                    <p>Nombre</p>
                    <input 
                        type="text" 
                        v-model="form.name"
                        class="rounded-md border border-gray-500 w-full"
                        required
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
                    <input type="file" accept="image/*" ref="photo" required>
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
                    <div class="flex items-center mb-2 md:space-x-4" v-for="ingredient in form.ingredients" :key="ingredient.id">
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
                            {{ ingredient.id }}
                        </div>
                        <div>
                            <img 
                                src="../../../img/trash.png" 
                                alt="Borrar"
                                class="bg-red-600 p-1 hover:bg-red-500 w-10 rounded-md ml-1"
                                @click="deleteIngredient(ingredient.id)"   
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
                            v-for="step in form.steps" :key="step.id"
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
                                    @click="deleteStep(step.id)" 
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


<script>
import Header from '../Header/Header.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Header,
        Link
    },
    props: {
        recipe: Object,
    },
    data() {
        return {
            form: {
                name: this.recipe.name,
                description: this.recipe.description,
                portions: this.recipe.portions,
                image: '',
                ingredients: [...this.recipe.ingredients],
                steps: [...this.recipe.steps],
            },
            mesagge: null,
        }
    },
    methods: {
        // submit() {
        //     if (this.$refs.photo) {
        //         this.form.image = this.$refs.photo.files[0];
        //     }
        //     this.$inertia.post(this.route('recipe.store'), this.form);
            
        //     this.form.name = '';
        //     this.form.description = '';
        //     this.form.portions = 1;
        //     this.form.image = '';
        //     this.form.ingredients = [];
        //     this.form.steps = [];

        //     this.mesagge = "Receta guardada con éxito";
        //     return this.mesagge;
        // },
        lessPortion() {
            if (this.form.portions != 1) {
                this.form.portions += - 1;
            }
        },
        addPortion() {
            this.form.portions += 1;
        },
        addIngredient() {
            this.form.ingredients.push({
                ingredient: "",
                amount: 1,
                unit_of_measurement: "",
            });
        },
        addStep() {
            this.form.steps.push({
                step: "",
            });
        },
        deleteIngredient(id) {
            if(id != null) {
                this.form.ingredients.splice(id - 1, 1);
            } else {
                this.form.ingredients.pop();
            }
        },
        deleteStep(id) {
            if(id != null) {
                this.form.steps.splice(id - 1, 1);
            } else {
                this.form.steps.pop();
            }
        },
    },
}
</script>