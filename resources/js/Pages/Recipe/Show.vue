<template>
    <Header>
    </Header>

    <div class="flex justify-center pt-28 px-4">
        <div>
            <div>
                <img src="../../../img/comida.jpg" alt="Foto de la comida">
            </div>
            <div>
                <h1 class="text-[2rem]">
                    {{ recipe.name }}
                </h1>
                <p>
                    {{ recipe.description }}
                </p>
                <p class="text-lg">
                    Porciones: {{ portions }}
                </p>
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
            <!-- ingredients and steps -->
            <div>
                <div>
                    <h2 class="text-[1.4rem] text-center">
                        Ingredientes
                    </h2>
                    <div v-for="ingredient in recipe.ingredients" :key="ingredient.id">
                        <div class="flex items-center mt-2 space-x-2">
                            <input type="checkbox"> 
                            <div class="flex space-x-1">
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
                    <h2 class="text-[1.4rem] text-center">
                        Preparación
                    </h2>
                    <div v-for="step in recipe.steps" :key="step.id">
                        <div class="flex items-center mt-2 space-x-3">
                            <input type="checkbox"> 
                            <div>
                                <p>
                                    Paso #
                                </p>
                                <p class="text-gray-800">
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
        recipe: Object
    },
    data() {
        return {
            portions: this.recipe.portions,
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
            let ingredienPortions = (this.portions * ingredient_amount) / this.recipe.portions;
            return ingredienPortions.toFixed(2);
        }
    }
}
</script>