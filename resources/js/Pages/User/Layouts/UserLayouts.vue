<template>

    <div>
        <Header />
  <div class="h-16 md:h-20"></div> 
        <slot />

    </div>
</template>

<script setup>
import {onMounted} from 'vue';
import {initFlowbite} from 'flowbite';
import Header from './Header.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';

onMounted( () =>{
    initFlowbite();
})
</script>

<style lang="scss" scoped>

</style>
