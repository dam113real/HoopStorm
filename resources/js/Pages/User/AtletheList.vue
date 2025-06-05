<template>
  <UserLayouts>
    <div class="px-4 md:px-10 py-8">
      <!-- Título -->
      <div class="text-center mb-8">
        <h1 class="text-3xl lg:text-5xl font-extrabold bg-gradient-to-r from-red-500 via-yellow-400 to-orange-500 text-transparent bg-clip-text animate-fade-in">
          Nuestros Atletas
        </h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">Inspiración, fuerza y determinación.</p>
      </div>

      <!-- Componente Atlethes que recibe toda la lista -->
      <div class="w-full animate-slide-up">
        <Atlethes
          class="gap-8 p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
          :atlethes="atlethes"
        />
      </div>
    </div>
    <Footer />
  </UserLayouts>
</template>

<script setup>
import { defineProps } from 'vue'
import UserLayouts from './Layouts/UserLayouts.vue'
import Atlethes from './Components/Atlethes.vue'
import Footer from '../User/Layouts/Footer.vue'

const props = defineProps({
  atlethes: Array
})
</script>

<style scoped>
@keyframes fade-in {
  0% { opacity: 0; transform: translateY(-10px); }
  100% { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fade-in 1s ease-in-out forwards;
}

.animate-slide-up {
  animation: slide-up 0.6s ease-out forwards;
}
</style>
