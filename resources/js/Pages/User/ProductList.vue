<template>
  <UserLayouts>
    <div class="w-full bg-gradient-to-b from-white via-gray-50 to-white text-gray-800 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:text-gray-100">

    <!-- Marcas logos -->
<div class="w-full py-4 px-2 flex justify-around gap-4 overflow-x-auto scrollbar-hide animate-slide-in">
  <div
    v-for="(logo, index) in logos"
    :key="index"
    class="w-28 h-20 flex items-center justify-center rounded-xl backdrop-blur-lg p-3 shadow-md hover:scale-105 hover:shadow-lg transition-transform duration-300 shrink-0
           bg-white/60 dark:bg-white/20"
  >
    <a :href="logo.link" target="_blank">
      <img
        :src="logo.src"
        :alt="logo.name"
        class="max-h-full max-w-full object-contain transition duration-300
               dark:invert dark:brightness-200"
      />
    </a>
  </div>
</div>


      <!-- Contenido principal -->
      <div class="w-full px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-6 animate-fade-in">
        <!-- Filtros -->
        <div class="bg-white/80 dark:bg-gray-800/80 p-6 rounded-xl shadow-md backdrop-blur-lg">
          <!-- Precio -->
          <div class="mb-6">
            <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">Precio</h2>
            <div class="flex space-x-2">
              <input v-model="filterPrices.prices[0]" type="number" placeholder="Desde"
                     class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400 transition" />
              <input v-model="filterPrices.prices[1]" type="number" placeholder="Hasta"
                     class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400 transition" />
            </div>
            <SecondaryButtonVue class="mt-4 w-full" @click="priceFilter">Filtrar</SecondaryButtonVue>
          </div>

          <!-- Marcas -->
          <div class="mb-6">
            <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">Marcas</h2>
            <div v-for="brand in brands" :key="brand.id" class="flex items-center mb-2">
              <input type="checkbox" v-model="selectedBrands" :value="brand.id"
                     class="accent-indigo-500 w-4 h-4 transition-all" />
              <label class="ml-2 text-sm text-gray-800 dark:text-gray-200">{{ brand.name }}</label>
            </div>
          </div>

          <!-- Categorías -->
          <div>
            <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">Categorías</h2>
            <div v-for="category in categories" :key="category.id" class="flex items-center mb-2">
              <input type="checkbox" v-model="selectedCategories" :value="category.id"
                     class="accent-indigo-500 w-4 h-4 transition-all" />
              <label class="ml-2 text-sm text-gray-800 dark:text-gray-200">{{ category.name }}</label>
            </div>
          </div>
        </div>

        <!-- Productos -->
        <div class="md:col-span-3">
          <Products :products="products.data" />
        </div>
      </div>

      <Footer />
    </div>
  </UserLayouts>
</template>


<script setup>
import { ref, watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import UserLayouts from "./Layouts/UserLayouts.vue";
import Products from "../User/Components/Products.vue";
import Footer from "../User/Layouts/Footer.vue";
import SecondaryButtonVue from "@/Components/SecondaryButton.vue";

const filterPrices = useForm({ prices: [0, 1] });
const selectedBrands = ref([]);
const selectedCategories = ref([]);

const priceFilter = () => {
  filterPrices
    .transform(data => ({
      ...data,
      prices: { from: filterPrices.prices[0], to: filterPrices.prices[1] },
    }))
    .get("products", { preserveState: true, replace: true });
};

watch([selectedBrands, selectedCategories], () => {
  router.get("products", {
    brands: selectedBrands.value,
    categories: selectedCategories.value,
  }, {
    preserveState: true,
    replace: true,
  });
});

const props = defineProps({
  products: Object,
  brands: Array,
  categories: Array,
});

const logos = [
  { name: "Nike", src: "/basket/logos/NIKE.png", link: "https://www.nike.com/es/" },
  { name: "Jordan", src: "/basket/logos/jordan.png", link: "https://www.nike.com/es/jordan" },
  { name: "Adidas", src: "/basket/logos/Adidas.png", link: "https://www.adidas.es/" },
  { name: "Under Armour", src: "/basket/logos/Under_armour.png", link: "https://www.underarmour.es/es-es/" },
  { name: "Reebok", src: "/basket/logos/Reebok.png", link: "https://www.reebok.eu/" },
  { name: "Puma", src: "/basket/logos/Puma.png", link: "https://eu.puma.com/de/en/home" },
];
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.7s ease-out forwards;
}

@keyframes slideIn {
  from { opacity: 0; transform: translateX(-30px); }
  to { opacity: 1; transform: translateX(0); }
}

.animate-slide-in {
  animation: slideIn 0.8s ease-out forwards;
}
</style>
