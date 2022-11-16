<template>
    <div class="flex justify-center p-4 border-b border-gray-500">
        <div class="space-y-3">
            <Link :href="route('recipe.index')" class="flex items-center space-x-4 cursor-pointer">
                <img src="../../../img/chef.png" alt="Tecetario" class="w-8">
                <p class="text-xl text-gray-800 hover:text-indigo-700">
                    Recetario
                </p>
            </Link>
            <Link :href="route('recipe.create')" class="flex items-center space-x-4 cursor-pointer">
                <img src="../../../img/add.png" alt="Tecetario" class="w-8">
                <p class="text-xl text-gray-800 hover:text-indigo-700">
                    Agregar Receta
                </p>
            </Link>
            <Link :href="route('recipe.manage')" class="flex items-center space-x-4 cursor-pointer">
                <img src="../../../img/book.png" alt="Tecetario" class="w-8">
                <p class="text-xl text-gray-800 hover:text-indigo-700">
                    Gestionar recetas
                </p>
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    }
}
</script>