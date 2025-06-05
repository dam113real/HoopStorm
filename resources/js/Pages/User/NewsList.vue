<template>
  <UserLayouts>
    <div class="bg-gray-100 min-h-screen py-8 px-4 lg:px-16">
      <!-- Título con gradiente -->
      <div class="text-center mb-10 animate-fade-in-down">
        <h1 class="text-4xl lg:text-5xl font-extrabold bg-gradient-to-r from-red-500 to-orange-400 text-transparent bg-clip-text">
          EXPLORA LAS NOTICIAS RECIENTES
        </h1>
      </div>

      <!-- Secciones animadas -->
      <section v-motion="fadeUp">
        <News :news="section1News" class="mb-8" />
      </section>
      <section v-motion="fadeUp" class="mb-8">
        <News :news="section2News" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6" />
      </section>
      <section v-motion="fadeUp" class="mb-8">
        <News :news="section3News" class="grid grid-cols-1 md:grid-cols-2 gap-6" />
      </section>
      <section v-motion="fadeUp" class="mb-8">
        <News :news="section4News" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6" />
      </section>
      <section v-motion="fadeUp">
        <News :news="section5News" class="grid grid-cols-1 md:grid-cols-2 gap-6" />
      </section>
    </div>
    <Footer />
  </UserLayouts>
</template>

<script setup>
import { ref } from "vue";
import UserLayouts from "./Layouts/UserLayouts.vue";
import News from './Components/News.vue';
import Footer from '../User/Layouts/Footer.vue';

// Props
const props = defineProps({
  news: Array
});

const section1News = props.news.slice(0, 1);
const section2News = props.news.slice(1, 5);
const section3News = props.news.slice(5, 7);
const section4News = props.news.slice(7, 11);
const section5News = props.news.slice(11, 13);

// Motion directives si usas @vueuse/motion (opcional pero recomendado para efectos suaves)
const fadeUp = {
  initial: { opacity: 0, y: 30 },
  enter: { opacity: 1, y: 0, transition: { duration: 0.6 } }
}
</script>
