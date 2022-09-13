<template>
    <Header>
    </Header>
    
    <main class="pt-32">
        
        <!-- Search -->
        <div class="flex justify-center">
            <div class="space-y-2 w-full px-10">
                <p class="text-lg">
                    Buscar receta
                </p>
                <input 
                    type="text" 
                    class="rounded-md border border-gray-500 w-full"
                    placeholder="Ingrese el término de búsqueda"
                    v-model="q"
                >
            </div>
        </div>

        <!-- Recipes -->
        <div class="mt-20">
            <div  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div v-for="recipe in recipes" :key="recipe.id" class="col-span-1 px-2 sm:px-4">
                    <div class="shadow-lg rounded-lg">
                        <img 
                            :src="recipe.image"
                            alt="Foro de la comida"
                            class="rounded-t-lg w-full h-[15rem] object-fill "
                        >
                        <div class="py-4 pl-2 space-y-2 border-b border-b-gray-300">
                            <h2 class="text-2xl">
                                {{ recipe.name }}
                            </h2>
                            <p>
                                {{ recipe.description }}
                            </p>
                        </div>
                        <Link :href="route('recipe.show', recipe.id)">
                            <div class="flex justify-center text-indigo-700 hover:text-white hover:bg-indigo-500 cursor-pointer rounded-b-md">
                                <p class=" text-lg py-2">
                                    Ver
                                </p>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

    </main>

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
        recipes: Array
    },
    data() {
        return {
            q: ''
        }
    },
    watch: {
        q: function (value) {
            this.$inertia.get(this.route('recipe.index', {q: value}), {}, {preserveState: true})
        }
    }
}
</script>