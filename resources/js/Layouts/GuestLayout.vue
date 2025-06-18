<script setup>
import { onMounted } from 'vue';

// Animación sencilla para que el contenido aparezca suave
onMounted(() => {
  const contentElement = document.querySelector('.content-wrapper');
  if (contentElement) {
    contentElement.classList.add('appear');
  }
});
</script>

<template>
  <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden ">
    <!-- Imagen de fondo -->
    <img
      src="/basket/home/1.jpg"
      alt="Fondo baloncesto"
      class="absolute inset-0 w-full h-full object-cover -z-10 filter contrast-110 brightness-90"
    />

    <!-- Contenido principal -->
    <div
      class="content-wrapper relative z-10 p-8 bg-white bg-opacity-80 rounded-xl shadow-2xl max-w-md w-full text-center"
    >
      <h1
        class="font-bold text-4xl mb-6 bg-gradient-to-r from-red-600 via-orange-400 to-blue-600 text-transparent bg-clip-text"
      >
        Hoop Storm
      </h1>
      <slot />
    </div>
  </div>
</template>

<style>
.content-wrapper {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.content-wrapper.appear {
  opacity: 1;
  transform: translateY(0);
}
</style>
