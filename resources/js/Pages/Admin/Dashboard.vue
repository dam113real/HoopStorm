<template>
  <AdminLayout>
    <div class="p-6 sm:p-10 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
      <!-- Header con animación -->
      <div class="mb-8">
        <h1 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 bg-clip-text text-transparent mb-3">
          Panel de Administración
        </h1>
        <p class="text-gray-600 text-lg">Gestiona tu ecommerce de manera eficiente</p>
        <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mt-4"></div>
      </div>

      <!-- Stats Cards -->
      <div class="grid gap-4 sm:grid-cols-3 mb-8">
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 border border-white/50 shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Total Productos</p>
              <p class="text-2xl font-bold text-gray-900">1,247</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 border border-white/50 shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Noticias Activas</p>
              <p class="text-2xl font-bold text-gray-900">32</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 border border-white/50 shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Atletas Registrados</p>
              <p class="text-2xl font-bold text-gray-900">89</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Cards Grid -->
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Productos -->
        <Link
          :href="route('admin.products.index')"
          class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:scale-105 hover:-translate-y-2"
        >
          <!-- Gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          
          <!-- Floating elements -->
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-blue-400/20 to-indigo-500/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
          
          <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform duration-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
              </div>
              <div class="text-right">
                <span class="text-3xl font-bold text-gray-800">1.2K</span>
                <p class="text-sm text-green-600 font-medium">+12% este mes</p>
              </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-indigo-600 transition-colors">
              Productos
            </h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
              Gestiona tu catálogo completo, añade nuevos productos y optimiza tu inventario.
            </p>
            
            <div class="flex items-center text-indigo-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
              <span>Gestionar productos</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </div>
          </div>
        </Link>

        <!-- Noticias -->
        <Link
          :href="route('admin.news.index')"
          class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:scale-105 hover:-translate-y-2"
        >
          <!-- Gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          
          <!-- Floating elements -->
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-emerald-400/20 to-green-500/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
          
          <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform duration-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
              </div>
              <div class="text-right">
                <span class="text-3xl font-bold text-gray-800">32</span>
                <p class="text-sm text-green-600 font-medium">+5 nuevas</p>
              </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">
              Noticias
            </h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
              Mantén informados a tus usuarios con contenido fresco y relevante.
            </p>
            
            <div class="flex items-center text-emerald-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
              <span>Gestionar noticias</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </div>
          </div>
        </Link>

        <!-- Atletas -->
        <Link
          :href="route('admin.atlethes.index')"
          class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:scale-105 hover:-translate-y-2"
        >
          <!-- Gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          
          <!-- Floating elements -->
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-purple-400/20 to-pink-500/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
          
          <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
              <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform duration-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <div class="text-right">
                <span class="text-3xl font-bold text-gray-800">89</span>
                <p class="text-sm text-green-600 font-medium">+3 nuevos</p>
              </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors">
              Atletas
            </h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
              Administra los perfiles de atletas y sus logros deportivos.
            </p>
            
            <div class="flex items-center text-purple-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
              <span>Gestionar atletas</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </div>
          </div>
        </Link>
      </div>

      <!-- Quick Actions -->
      <div class="mt-12 bg-white/60 backdrop-blur-sm rounded-3xl p-8 border border-white/50 shadow-xl">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Acciones Rápidas</h3>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <button class="flex items-center justify-center p-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nuevo Producto
          </button>
          
          <button class="flex items-center justify-center p-4 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-2xl hover:from-emerald-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Nueva Noticia
          </button>
          
          <button class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-2xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Nuevo Atleta
          </button>
          
          <button class="flex items-center justify-center p-4 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-2xl hover:from-orange-600 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Ver Estadísticas
          </button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { Link } from '@inertiajs/vue3'
import AdminLayout from './Components/AdminLayout.vue'
import Navbar from "@/Pages/Admin/Components/Navbar.vue"
import Sidebar from "@/Pages/Admin/Components/Sidebar.vue"

onMounted(() => {
  initFlowbite()
})
</script>
