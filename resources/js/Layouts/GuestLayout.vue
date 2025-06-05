<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

// Add animation effect when component is mounted
onMounted(() => {
  const contentElement = document.querySelector('.content-wrapper');
  if (contentElement) {
    contentElement.classList.add('appear');
  }
});
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 bg-wrapper z-0"></div>
    <div class="basketball-overlay"></div>
    
   
    
    <!-- Logo/Title with animation -->
    <div class="logo-container mb-6 relative z-10">
      <h1 class="font-bold lg:text-6xl text-4xl bg-gradient-to-r pb-3 from-red-600 via-orange-400 to-blue-600 text-transparent bg-clip-text hover-scale">
        Hoop Storm
      </h1>
      <div class="logo-underline"></div>
    </div>

    <!-- Content card with animation -->
    <div class="content-wrapper w-full sm:max-w-md mt-6 px-8 py-6 bg-opacity-90 shadow-2xl overflow-hidden sm:rounded-xl relative z-10 backdrop-blur-sm">
      <slot />
    </div>
    
    <!-- Basketball icon in the background -->
    <div class="basketball-icon"></div>
  </div>
</template>

<style>
.bg-wrapper {
  background-image: url('basket/home/fondo.jpg');
  background-size: cover;
  background-position: center;
  filter: contrast(1.1) brightness(0.9);
}

.content-wrapper {
  transform: translateY(30px);
  opacity: 0;
  transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.content-wrapper.appear {
  transform: translateY(0);
  opacity: 1;
}

.logo-container {
  position: relative;
  transition: transform 0.3s ease;
}

.logo-container:hover {
  transform: scale(1.05);
}

.logo-underline {
  height: 3px;
  background: linear-gradient(90deg, transparent, #ff4b2b, #ff416c, transparent);
  width: 100%;
  position: relative;
  margin-top: 8px;
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

.hover-scale {
  transition: transform 0.3s ease;
}

.hover-scale:hover {
  transform: scale(1.05);
}

.basketball-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff4b2b' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.4;
  z-index: 1;
}

.basketball-icon {
  position: absolute;
  width: 300px;
  height: 300px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FF6B00' d='M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0z'/%3E%3Cpath fill='%23E45500' d='M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0v512z'/%3E%3Cpath fill='%23000' d='M256 464c114.9 0 208-93.1 208-208S370.9 48 256 48 48 141.1 48 256s93.1 208 208 208z' opacity='.1'/%3E%3Cpath d='M430.6 143.3C399.5 95.9 351.9 64 297.3 53c-12.1 28.7-33.7 52.1-61 64.6 29.3 15.4 52.7 41.3 63.8 73.9 32.3-15.5 68.3-21.2 102.6-16-5.5-12.2-12.8-23.5-21.1-34.2h-1c49.1 55.6 60.2 135.8 33.4 203.8 41.4-51.3 44-127.4-.5-201.8z' opacity='.2'/%3E%3Cpath d='M99.3 175.1c33.3-71.5 104.3-114.7 180.7-114.9v.2c-76.1 6.6-141.4 60.1-166 140.9C88.7 290.5 112.2 388.7 184 446c-12.3-7.3-24.1-15.9-35-25.6-75-66.8-85-181.7-19.8-257.3-36 55.5-37.1 127.8 6.1 189-52.2-59.2-63-145.7-36-277z' opacity='.2'/%3E%3C/svg%3E");
  background-size: contain;
  background-repeat: no-repeat;
  bottom: -30px;
  right: -30px;
  opacity: 0.06;
  z-index: 0;
  transform: rotate(-15deg);
}

/* Animated circles background */
.circles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 1;
}

.circle {
  position: absolute;
  border-radius: 50%;
  background: linear-gradient(45deg, rgba(255, 75, 43, 0.1), rgba(255, 65, 108, 0.1));
  animation: float 8s infinite;
}

.circle-1 {
  width: 80px;
  height: 80px;
  left: 10%;
  top: 20%;
  animation-delay: 0s;
  animation-duration: 9s;
}

.circle-2 {
  width: 120px;
  height: 120px;
  right: 15%;
  top: 10%;
  animation-delay: 1s;
  animation-duration: 12s;
}

.circle-3 {
  width: 60px;
  height: 60px;
  left: 20%;
  bottom: 20%;
  animation-delay: 2s;
  animation-duration: 8s;
}

.circle-4 {
  width: 100px;
  height: 100px;
  right: 25%;
  bottom: 15%;
  animation-delay: 3s;
  animation-duration: 10s;
}

.circle-5 {
  width: 50px;
  height: 50px;
  left: 40%;
  top: 30%;
  animation-delay: 4s;
  animation-duration: 7s;
}

.circle-6 {
  width: 150px;
  height: 150px;
  right: 5%;
  bottom: 30%;
  animation-delay: 5s;
  animation-duration: 15s;
  opacity: 0.05;
}

.circle-7 {
  width: 70px;
  height: 70px;
  left: 30%;
  bottom: 10%;
  animation-delay: 6s;
  animation-duration: 11s;
}

.circle-8 {
  width: 110px;
  height: 110px;
  right: 30%;
  top: 5%;
  animation-delay: 7s;
  animation-duration: 13s;
}

.circle-9 {
  width: 90px;
  height: 90px;
  left: 5%;
  top: 50%;
  animation-delay: 8s;
  animation-duration: 14s;
}

.circle-10 {
  width: 65px;
  height: 65px;
  right: 10%;
  top: 40%;
  animation-delay: 9s;
  animation-duration: 9s;
}

@keyframes float {
  0% {
    transform: translateY(0) rotate(0);
    opacity: 0.3;
  }
  50% {
    transform: translateY(-20px) rotate(180deg);
    opacity: 0.5;
  }
  100% {
    transform: translateY(0) rotate(360deg);
    opacity: 0.3;
  }
}
</style>