<template>
    <Header>
    </Header>

    <div class="flex justify-center pt-28 px-4">
        <div>
            <h1 class="text-2xl text-center">
                Nueva receta
            </h1>
            <form @submit.prevent="submit" class="mt-10 space-y-4">
                <div>
                    <p>Nombre</p>
                    <input 
                        type="text" 
                        v-model="form.name"
                        class="rounded-md border border-gray-500 w-full">
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
                    <textarea cols="34" rows="3" class="rounded-md" v-model="form.description"></textarea>
                </div>
                <div>
                    <p>Foto</p>
                    <input type="file" accept="image/*" ref="image">
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
                    </div>
                    <div class="flex items-center mb-2 md:space-x-4" v-for="ingredient in form.ingredients" :key="ingredient.id">
                        <div>
                            <input v-model="ingredient.amount" type="number" class="w-28">
                        </div>
                        <div>
                            <select v-model="ingredient.unit_of_measurement">
                                <option value="Al gusto">Al gusto</option>
                                <option value="Gramo">Gramo</option>
                                <option value="Kilogramo">Kilogramo</option>
                            </select>
                        </div>
                        <div>
                            <input 
                                type="text" 
                                placeholder="Nombre"
                                class="w-28"
                                v-model="ingredient.ingredient">
                        </div>
                    </div>
                    <div 
                        class="flex justify-center items-center space-x-2 mt-2"
                        @click="addIngredient()">
                        <p class="text-blue-600 hover:text-blue-500">
                            Agregar ingrediente
                        </p>
                        <img 
                            src="../../../img/plus.png" 
                            alt="Agregar ingrediente"
                            class="bg-blue-600 hover:bg-blue-500 w-8 rounded-md">
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
    data() {
        return {
            form: {
                name: '',
                description: '',
                portions: 1,
                image: '',
                ingredients: [],
            }
        }
    },
    methods: {
        submit() {
            if (this.$refs.image) {
                this.form.image = this.$refs.image.files[0];
            }
            this.$inertia.post(this.route('recipe.store'), this.form);
        },
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
    },
}
</script>