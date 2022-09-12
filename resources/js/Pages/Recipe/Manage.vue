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
                    placeholder="Ingrese nombre o descripción"
                    v-model="q"
                >
            </div>
        </div>

        <!-- Recipes table-->
        <div class="overflow-auto rounded-lg shadow mt-6 px-2">
            <table class="w-full border-x border-x-gray-200">
                <thead class="border-y-2 border-gray-200">
                    <tr>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Nombre</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Descripción</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Opciones</th>
                    </tr>
                </thead>
                <tbody 
                    v-for="recipe in recipes" :key="recipe.id"
                    class="divide-y divide-gray-200 border-b border-gray-100">
                        <tr>
                            <td class="p-2 border-r border-gray-200">{{ recipe.name }}</td>
                            <td class="p-2 border-r border-gray-200">
                                <p class="w-28 md:invisible md:w-0 md:h-0">
                                    {{ recipe.description.substring(0, 60) + "..." }}
                                </p>
                                <p class="invisible w-0 h-0  md:visible md:w-full md:h-full">
                                    {{ recipe.description }}
                                </p>
                            </td>
                            <td class="flex justify-center mt-6 sm:mt-12 md:mt-0 md:py-4 md:px-2">
                                <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">
                                    <div>
                                        <Link>
                                            <img 
                                                src="../../../img/edit.png" 
                                                alt="Editar receta"
                                                class="w-8 bg-yellow-400 rounded-md">
                                        </Link>
                                    </div>
                                    <div>
                                        <button @click="destroy(recipe.id)">
                                            <img 
                                                src="../../../img/trash.png" 
                                                alt="Eliminar receta"
                                                class="w-8 bg-red-500 rounded-md cursor-pointer">
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
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
            this.$inertia.get(this.route('recipe.manage', {q: value}), {}, {preserveState: true})
        }
    },
    methods: {
        destroy(id) {
            if(confirm("¿Desea eliminar esta receta?")) {
                this.$inertia.delete(this.route('recipe.destroy', id))
            }
        }
    }
}
</script>