<template>
  <UserLayouts>
    <!-- Hero Section con fondo limpio -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-100 to-slate-200 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900 relative">
      <!-- Patrón sutil de fondo -->
      <div class="absolute inset-0 opacity-30">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
      </div>

      <div class="xl:container mx-auto px-4 py-16 relative z-10">
        <!-- Grid principal con efecto glassmorphism -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-200/50 dark:border-gray-700/50 product-card">
          
          <!-- Sección de imagen mejorada -->
          <div class="flex justify-center items-center relative group">
            <div class="image-container relative">
              <!-- Efecto de resplandor -->
              <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 rounded-2xl opacity-20 blur-lg group-hover:opacity-40 transition-opacity duration-500 glow-effect"></div>
              
              <!-- Imagen principal -->
              <img
                :src="atlethe.atlethe_images.length > 0 ? `/${atlethe.atlethe_images[0].image}` : 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg'"
                :alt="atlethe.title"
                class="relative w-full max-w-lg aspect-[4/5] object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-all duration-700 ease-out border-2 border-gray-200/50 dark:border-gray-700/50"
              />
            </div>
          </div>

          <!-- Sección de detalles mejorada -->
          <div class="flex flex-col justify-center space-y-8">
            <!-- Título con efecto de escritura -->
            <div class="space-y-4">
              <div class="flex items-center space-x-3 mb-4">
                <div class="flex space-x-1">
                  <div class="w-3 h-3 bg-gradient-to-r from-pink-500 to-purple-500 rounded-full animate-pulse"></div>
                  <div class="w-3 h-3 bg-gradient-to-r from-purple-500 to-cyan-500 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                  <div class="w-3 h-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                </div>
                <span class="text-sm font-medium text-purple-600 dark:text-purple-400 tracking-wider uppercase">Atleta Destacado</span>
              </div>
              
              <h1 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-gray-900 via-purple-800 to-cyan-700 dark:from-white dark:via-purple-200 dark:to-cyan-200 bg-clip-text text-transparent leading-tight title-animation">
                {{ atlethe.title }}
              </h1>
            </div>

            <!-- Descripción con mejor tipografía -->
            <div class="space-y-6">
              <p class="text-lg text-gray-700 dark:text-gray-200 leading-relaxed font-light description-text">
                {{ atlethe.description }}
              </p>
              
              <!-- Información adicional con íconos -->
              <div class="bg-gray-50/80 dark:bg-slate-700/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-600/50">
                <div class="flex items-start space-x-3">
                  <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-gray-900 dark:text-white font-semibold mb-2">Información adicional</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ atlethe.extrainfo }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Botón de navegación mejorado -->
        <div class="flex justify-center mt-16">
          <Link
            :href="route('atlethes.index')"
            class="group inline-flex items-center space-x-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-out nav-button"
          >
            <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-base">Volver a Atletas</span>
          </Link>
        </div>
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

// Funciones para interactividad (si se necesitan en el futuro)
const handleImageHover = () => {
  // Funcionalidad futura
};

const handleImageLeave = () => {
  // Funcionalidad futura
};
</script>

<style scoped>
/* Animaciones de elementos flotantes - REMOVIDAS */

/* Animación de la tarjeta principal */
@keyframes slideInUp {
  0% { 
    opacity: 0; 
    transform: translateY(60px) scale(0.95); 
  }
  100% { 
    opacity: 1; 
    transform: translateY(0) scale(1); 
  }
}

.product-card {
  animation: slideInUp 1s ease-out;
}

/* Efecto de resplandor */
@keyframes glow {
  0%, 100% { opacity: 0.5; }
  50% { opacity: 1; }
}

.glow-effect {
  animation: glow 2s ease-in-out infinite;
}

/* Animación del título */
@keyframes titleSlide {
  0% { 
    opacity: 0; 
    transform: translateX(-30px); 
  }
  100% { 
    opacity: 1; 
    transform: translateX(0); 
  }
}

.title-animation {
  animation: titleSlide 1.2s ease-out 0.3s both;
}

/* Animación de la descripción */
@keyframes fadeInUp {
  0% { 
    opacity: 0; 
    transform: translateY(20px); 
  }
  100% { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

.description-text {
  animation: fadeInUp 1s ease-out 0.6s both;
}

/* Hover effects removidos para características */

/* Animación del botón - simplificada */
@keyframes buttonPulse {
  0% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4); }
  70% { box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
  100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
}

.nav-button {
  animation: fadeInUp 1s ease-out 1s both;
}
/* ALTERNATIVA más simple y efectiva */
.nav-button:hover {
  /* Solo usar transform y box-shadow sin animations conflictivas */
  transform: translateY(0) scale(1.05);
  box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
  transition: all 0.3s ease;
}


/* Efectos de ondas y zoom removidos */

/* Contenedor de imagen */
.image-container {
  position: relative;
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.image-container:hover {
  transform: perspective(1000px) rotateY(2deg) rotateX(2deg);
}

/* Responsive improvements */
@media (max-width: 768px) {
  .product-card {
    margin: 1rem;
    padding: 1.5rem;
  }
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #8b5cf6, #06b6d4);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #7c3aed, #0891b2);
}
</style>