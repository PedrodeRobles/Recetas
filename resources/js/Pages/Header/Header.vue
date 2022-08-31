<template>
    <div class="fixed w-full bg-white">
        <header class="flex justify-between p-4 border-b border-b-green-500 shadow-sm">
            <div>
                <img 
                    src="../../../img/logo.png" 
                    alt="Logo"
                    class="w-20"
                >
            </div>

            <!-- Options medium to + screen -->
            <div class="invisible h-0 md:visible md:h-10 md:flex md:items-center md:space-x-24 md:px-2">
                <Link class="flex items-center space-x-4 cursor-pointer">
                    <img src="../../../img/chef.png" alt="Tecetario" class="w-8">
                    <p class="text-xl text-gray-800 hover:text-indigo-700">
                        Recetario
                    </p>
                </Link>
                <Link class="flex items-center space-x-4 cursor-pointer">
                    <img src="../../../img/add.png" alt="Tecetario" class="w-8">
                    <p class="text-xl text-gray-800 hover:text-indigo-700">
                        Agregar Receta
                    </p>
                </Link>
                <Link class="flex items-center space-x-4 cursor-pointer">
                    <img src="../../../img/book.png" alt="Tecetario" class="w-8">
                    <p class="text-xl text-gray-800 hover:text-indigo-700">
                        Gestionar recetas
                    </p>
                </Link>
            </div>

            <!-- Burger menu small to medium screen -->
            <div class="md:invisible md:w-0 md:h-0">
                <img 
                    src="../../../img/burgerMenu.png" 
                    alt="Menu"
                    class="w-10 cursor-pointer"
                    @click="showMenu = !showMenu"
                    v-show="!showMenu"
                >
                <img 
                    src="../../../img/close.png" 
                    alt="Menu"
                    class="w-10 cursor-pointer"
                    @click="showMenu = !showMenu"
                    v-show="showMenu"
                >
            </div>
        </header>
    
        <Menu v-show="showMenu"></Menu>
    </div>

</template>

<script>
import Menu from './Menu.vue';

export default {
    components: {
        Menu
    },
    data() {
        return {
            showMenu: false
        }
    },
}
</script>