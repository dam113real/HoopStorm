<template>
  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
    <div
      v-for="product in products"
      :key="product.id"
      class="group scale-95 duration-300 hover:scale-105 relative bg-white dark:bg-gray-800 rounded-lg shadow-md p-2"
    >
      <!-- Imagen -->
      <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75">
        <img
          v-if="product.product_images.length > 0"
          :src="`/${product.product_images[0].image}`"
          :alt="product.imageAlt"
          class="w-full h-64 object-cover object-center"
        />
        <img
          v-else
          src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
          alt="Sin imagen"
          class="w-full h-64 object-cover object-center"
        />

        <!-- Acciones -->
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer">
          <div class="bg-blue-700 p-2 rounded-full">
            <a @click="addToCart(product)">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
              </svg>
            </a>
          </div>

          <Link :href="route('products.show', { product: product.id })">
            <div class="bg-blue-700 p-2 rounded-full ml-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
          </Link>
        </div>
      </div>

      <!-- Info -->
      <div class="mt-4 flex justify-between items-center">
        <div>
          <h3 class="text-base font-bold text-gray-700 dark:text-gray-200">
            <Link :href="route('products.show', { product: product.id })">
              {{ product.title }}
            </Link>
          </h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">
  {{ product.brand?.name ?? 'Sin marca' }}
</p>

        </div>
        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ product.price }} € </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";

defineProps({
  products: Array
});

const addToCart = (product) => {
  router.post(route('cart.store', product), {
    onSuccess: (page) => {
      if (page.props.flash.success) {
        Swal.fire({
          toast: true,
          icon: "success",
          position: "top-end",
          showConfirmButton: false,
          title: page.props.flash.success,
        });
      }
    },
  });
};
</script>
