<template>
    <div class="fixed w-full">
        <header class="flex justify-between p-4 border-b border-b-amber-500 shadow-sm">
            <div>
                <img 
                    src="../../../img/logo.png" 
                    alt="Logo"
                    class="w-20"
                >
            </div>
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