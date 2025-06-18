<template>
  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
    <div
      v-for="product in products"
      :key="product.id"
      class="group scale-95 duration-300 hover:scale-105 relative bg-white dark:bg-gray-800 rounded-lg shadow-md p-2 cursor-pointer"
      @click="goToProduct(product.id)"
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

        
       
      </div>

      <!-- Info -->
      <div class="mt-4 flex justify-between items-center">
        <div>
          <h3 class="text-base font-bold text-gray-700 dark:text-gray-200">
            {{ product.title }}
          </h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ product.brand?.name ?? 'Sin marca' }}
          </p>
        </div>
        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ product.price }} €</p>
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

const goToProduct = (productId) => {
  router.visit(route('products.show', { product: productId }));
};
</script>