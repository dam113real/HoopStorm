<template>
  <AdminLayout>
    <div class="p-6 sm:p-10 bg-gray-50 min-h-screen">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de administración</h1>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Productos -->
        <Link
          :href="route('admin.products.index')"
          class="block group bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all border border-transparent hover:border-indigo-500"
        >
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 group-hover:text-indigo-600 transition">Productos</h2>
            <svg class="w-6 h-6 text-indigo-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M9 3v18m6-18v18M4 21h16" />
            </svg>
          </div>
          <p class="text-gray-500 text-sm">Gestionar productos disponibles, añadir nuevos o editar existentes.</p>
        </Link>

        <!-- Noticias -->
        <Link
          :href="route('admin.news.index')"
          class="block group bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all border border-transparent hover:border-indigo-500"
        >
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 group-hover:text-indigo-600 transition">Noticias</h2>
            <svg class="w-6 h-6 text-indigo-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h7l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
            </svg>
          </div>
          <p class="text-gray-500 text-sm">Publicar nuevas noticias o editar contenido informativo del sitio.</p>
        </Link>

        <!-- Atletas -->
        <Link
          :href="route('admin.atlethes.index')"
          class="block group bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all border border-transparent hover:border-indigo-500"
        >
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 group-hover:text-indigo-600 transition">Atletas</h2>
            <svg class="w-6 h-6 text-indigo-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A9 9 0 1112 21a8.963 8.963 0 01-6.879-3.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <p class="text-gray-500 text-sm">Agregar, modificar o eliminar perfiles de atletas registrados.</p>
        </Link>
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
