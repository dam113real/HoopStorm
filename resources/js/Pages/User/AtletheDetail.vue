<template>
  <UserLayouts>
    <div class="xl:container mx-auto px-4 py-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white/60 dark:bg-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl animate-fade-in">
        <!-- Imagen -->
        <div class="flex justify-center items-center">
          <img
            :src="atlethe.atlethe_images.length > 0 ? `/${atlethe.atlethe_images[0].image}` : 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg'"
            :alt="atlethe.title"
            class="w-full max-w-md aspect-[4/5] object-cover rounded-2xl border-4 border-transparent hover:border-indigo-400 transition-all duration-500 shadow-md"
          />
        </div>

        <!-- Detalles -->
        <div class="flex flex-col justify-center space-y-6">
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100">{{ atlethe.title }}</h1>
          <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">{{ atlethe.description }}</p>
          <div class="pt-4 border-t border-gray-300 dark:border-gray-700">
            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">{{ atlethe.extrainfo }}</p>
          </div>
        </div>
      </div>

      <!-- Botón de volver -->
      <div class="flex justify-center mt-10">
        <Link
          :href="route('atlethes.index')"
          class="transition transform scale-95 hover:scale-105 duration-300 text-white bg-gradient-to-r from-teal-400 to-lime-400 hover:from-lime-400 hover:to-teal-400 font-semibold rounded-lg px-8 py-3 shadow-lg"
        >
          ⬅️ Volver a Atletas
        </Link>
      </div>
    </div>
    <Footer />
  </UserLayouts>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import UserLayouts from "./Layouts/UserLayouts.vue";
import Footer from '../User/Layouts/Footer.vue';

defineProps({
  atlethe: Object
});
</script>

<style scoped>
@keyframes fade-in {
  0% { opacity: 0; transform: scale(0.95); }
  100% { opacity: 1; transform: scale(1); }
}
.animate-fade-in {
  animation: fade-in 0.7s ease-out;
}
</style>
