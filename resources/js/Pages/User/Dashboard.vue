<script setup>
import UserLayouts from './Layouts/UserLayouts.vue'
import { computed } from 'vue'

const props = defineProps({
  orders: {
    type: Array,
    default: () => []
  }
})

const calculateTotal = (order) => {
  return order.order_items.reduce((total, item) => {
    return total + item.quantity * item.product.price
  }, 0)
}

const sortedOrders = computed(() => {
  if (!props.orders || props.orders.length === 0) return []
  return [...props.orders].sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
})
</script>

<template>
  <UserLayouts>
    <section class="py-20 px-4 md:px-6 relative bg-gradient-to-br from-purple-100 via-indigo-200 to-blue-100 min-h-screen">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 animate-fade-in">
          <h2 class="text-5xl font-extrabold text-indigo-900 tracking-tight drop-shadow-lg">
            🛍️ Tus Pedidos
          </h2>
          
        </div>

        <!-- Pedidos -->
        <transition-group name="staggered-fade" tag="div" class="space-y-12">
          <div
            v-for="(order, index) in sortedOrders"
            :key="order.id"
            v-show="order.order_items.length > 0"
            class="relative group overflow-hidden bg-white/60 backdrop-blur-md border border-indigo-200 rounded-3xl shadow-xl transition-transform transform hover:-translate-y-1 hover:shadow-2xl duration-300 animate-fade-in"
            :style="{ animationDelay: `${index * 100}ms` }"
          >
            <!-- Encabezado -->
            <div class="flex items-center justify-between px-6 py-5 bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 border-b border-indigo-200">
              <div>
                <h3 class="text-xl font-bold text-indigo-800">
                  Pedido #{{ order.id }}
                </h3>
                <p class="text-sm text-gray-600">
                  {{ new Date(order.created_at).toLocaleDateString() }}
                </p>
              </div>
              <span class="bg-purple-200 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full animate-pulse shadow-inner">
                🟢 En proceso
              </span>
            </div>

            <!-- Artículos del pedido -->
            <div class="divide-y divide-gray-200">
              <div
                v-for="item in order.order_items"
                :key="item.id"
                class="flex flex-col md:flex-row gap-6 px-6 py-6 hover:bg-white/40 transition duration-300"
              >
                <!-- Imagen -->
                <div class="w-full md:w-40 h-40 rounded-xl overflow-hidden bg-gray-200 shadow-md group-hover:shadow-lg transition duration-300 transform group-hover:scale-105">
                  <img
                    v-if="item.product.product_images.length > 0"
                    :src="'/' + item.product.product_images[0].image"
                    alt="Producto"
                    class="w-full h-full object-cover object-center"
                  />
                  <img
                    v-else
                    src="https://via.placeholder.com/300x300?text=Sin+imagen"
                    alt="Sin imagen"
                    class="w-full h-full object-cover object-center"
                  />
                </div>

                <!-- Información -->
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <h4 class="text-xl font-semibold text-gray-800 hover:text-indigo-500 transition">
                      {{ item.product.title }}
                    </h4>
                    <div class="text-sm text-gray-500 mt-2 space-y-1">
                      <p>🏷️ Marca: {{ item.product.brand.name }}</p>
                      <p>📁 Categoría: {{ item.product.category.name }}</p>
                    </div>
                  </div>

                  <div class="grid grid-cols-3 text-center text-sm md:text-base">
                    <div>
                      <p class="text-gray-500">Precio</p>
                      <p class="font-medium text-indigo-600">{{ item.product.price }} € </p>
                    </div>
                    <div>
                      <p class="text-gray-500">Cantidad</p>
                      <p class="font-medium">{{ item.quantity }}</p>
                    </div>
                    <div>
                      <p class="text-gray-500">Subtotal</p>
                      <p class="font-medium text-gray-900">{{ (item.product.price * item.quantity).toFixed(2) }} € </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie del pedido -->
            <div class="flex flex-col md:flex-row items-center justify-between px-6 py-5 bg-white/30 border-t border-indigo-200 backdrop-blur">
              <div class="text-center md:text-left mb-3 md:mb-0">
                <p class="text-sm text-gray-500">Entrega estimada</p>
                <p class="font-medium text-green-600">14 de junio de 2024</p>
              </div>
              <div class="text-lg font-semibold text-gray-800">
                Total:
                <span class="ml-2 text-indigo-600">{{ calculateTotal(order).toFixed(2) }} € </span>
              </div>
            </div>
          </div>
        </transition-group>

        <!-- Sin pedidos -->
        <div
          v-if="sortedOrders.length === 0"
          class="text-center mt-20 bg-white/80 border border-gray-200 p-10 rounded-2xl shadow-xl animate-fade-in"
        >
          <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
              />
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-900">Aún no tienes pedidos</h3>
          <p class="text-gray-600 mt-2">Cuando compres algo, aparecerá aquí automáticamente.</p>
        </div>
      </div>
    </section>
  </UserLayouts>
</template>

<style>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.6s ease-out both;
}

.staggered-fade-enter-active {
  transition: all 0.5s ease;
}
.staggered-fade-leave-active {
  transition: all 0.3s ease;
}
.staggered-fade-enter-from {
  opacity: 0;
  transform: translateY(30px);
}
.staggered-fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}
</style>
