<template>
    <Header>
    </Header>

    <div class="flex justify-center pt-24 px-4">
        <div>
            <div class="md:flex md:space-x-6">
                <div>
                    <img 
                        :src="recipe[0].image"
                        alt="Foto de la comida"
                        class="w-full md:w-[30rem]">
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="space-y-3">
                        <h1 class="text-[2.5rem]">
                            {{ recipe[0].name }}
                        </h1>
                        <p class="md:w-[25rem]">
                            {{ recipe[0].description }}
                        </p>
                        <p class="text-lg">
                            Porciones: {{ portions }}
                        </p>
                    </div>
                    <div class="mt-5 md:mt-10 space-y-2">
                        <p>Porciones</p>
                        <div class="flex space-x-2">
                            <img 
                                src="../../../img/less.png" 
                                alt="Restar" 
                                class="bg-indigo-600 w-10 rounded-md cursor-pointer"
                                @click="lessPortion">
                            <input 
                                type="number" 
                                v-model="portions"
                                class="rounded-md text-center"
                                required
                                >
                            <img 
                                src="../../../img/plus.png" 
                                alt="Sumar" 
                                class="bg-indigo-600 w-10 rounded-md cursor-pointer"
                                @click="addPortion">
                        </div>
                        <p class="text-gray-700">
                            Usted puede cambiar las porciones. La cantidad de ingredientes se ajustará
                        </p>
                    </div>
                </div>
            </div>

            <!-- ingredients and steps -->
            <div class="mt-6 space-y-6 md:space-y-0 md:flex justify-evenly md:space-x-28 md:mt-10">
                <div class="md:w-[20rem]">
                    <h2 class="text-[2rem] text-center">
                        Ingredientes
                    </h2>
                    <div v-for="ingredient in recipe[0].ingredients" :key="ingredient.id">
                        <div class="flex items-center mt-2 space-x-2">
                            <input type="checkbox"> 
                            <div class="flex justify-start space-x-1">
                                <p>
                                    <!-- {{ ingredient.amount }} -->
                                    {{ ingredientCalculation(ingredient.amount) }}
                                </p>
                                <p>
                                    {{ ingredient.unit_of_measurement }}
                                </p>
                                <p>
                                    {{ ingredient.ingredient }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-[2rem] text-center">
                        Preparación
                    </h2>
                    <div v-for="(step, index) in recipe[0].steps" :key="step.id">
                        <div class="flex items-center mt-2 space-x-3">
                            <input type="checkbox"> 
                            <div>
                                <p>
                                    Paso {{ index + 1 }}
                                </p>
                                <p class="text-gray-800 w-80">
                                    {{ step.step }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../Header/Header.vue';

export default {
    components: {
        Header,
    },
    props: {
        recipe: Array
    },
    data() {
        return {
            portions: this.recipe[0].portions,
        }
    },
    methods: {
        lessPortion() {
            if (this.portions != 1) {
                this.portions += - 1;
            }
        },
        addPortion() {
            this.portions += 1;
        },
        ingredientCalculation(ingredient_amount) {
            let ingredienPortions = (this.portions * ingredient_amount) / this.recipe[0].portions;
            return ingredienPortions.toFixed(2);
        }
    }
}
</script>