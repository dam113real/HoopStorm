<template>
  <UserLayouts :class="{ dark: isDarkMode }">
    <div id="ItemPage" class="my-12 pb-16 px-4 md:px-10 max-w-7xl mx-auto">
      <!-- Toggle modo oscuro -->
      <!-- <div class="flex justify-end mb-6">
        <button
          @click="toggleDarkMode"
          class="px-4 py-2 rounded-md border border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
          aria-label="Toggle dark mode"
        >
          {{ isDarkMode ? "Modo Claro" : "Modo Oscuro" }}
        </button>
      </div> -->

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start reveal-on-scroll">
        <!-- IMÁGENES DEL PRODUCTO -->
        <div>
          <!-- Imagen Principal -->
          <div
            class="relative rounded-2xl overflow-hidden shadow-md aspect-[4/3] cursor-pointer group"
            @click="openModal = true"
          >
            <transition name="fade">
              <img
                v-if="activeImage"
                :key="activeImage"
                :src="activeImage"
                :alt="product.imageAlt"
                class="w-full h-full object-cover object-center transition-transform duration-500"
                loading="lazy"
              />
            </transition>
            <span
              class="absolute top-2 left-2 bg-gray-900/80 dark:bg-gray-200/80 text-white dark:text-gray-900 text-xs px-3 py-1 rounded-full shadow select-none"
            >
              {{ product.product_images.length }} imágenes
            </span>

            <!-- Indicador stock bajo -->
            <transition name="blink">
              <p
                v-if="lowStock"
                class="absolute bottom-2 right-2 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold select-none"
              >
                Últimas {{ stockCount }} unidades
              </p>
            </transition>
          </div>

          <!-- Miniaturas -->
          <div class="flex gap-2 mt-4 overflow-x-auto">
            <div
              v-for="(img, i) in product.product_images"
              :key="i"
              class="w-16 h-16 rounded-xl overflow-hidden border-2 cursor-pointer transition-all duration-300 hover:scale-110"
              :class="{
                'border-blue-500 scale-105 shadow-lg': activeImage === `/${img.image}`,
                'border-transparent': activeImage !== `/${img.image}`,
              }"
              @click="activeImage = `/${img.image}`"
            >
              <img
                :src="`/${img.image}`"
                class="w-full h-full object-cover object-center"
                loading="lazy"
                alt="Miniatura producto"
              />
            </div>
          </div>
        </div>

        <!-- DETALLES DEL PRODUCTO -->
        <div
          class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-xl space-y-4 animate-fade-in reveal-on-scroll"
        >
          <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
            {{ product.title }}
          </h1>
          <p class="text-gray-500 dark:text-gray-400 font-medium">
            {{ product.brand.name }} — {{ product.category.name }}
          </p>

          <div class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ product.description }}
          </div>

          <!-- Valoración -->
          <div class="flex items-center space-x-2 text-sm mt-2">
            <div class="flex space-x-1 text-yellow-400">
              <Icon name="ic:baseline-star" v-for="n in 5" :key="n" />
            </div>
            <span class="text-gray-500 dark:text-gray-400">5/5 · 213 valoraciones</span>
          </div>

          <!-- Precio -->
          <div
            class="flex items-center gap-3 text-2xl font-bold text-gray-800 dark:text-gray-100 mt-3"
          >
            <span>{{ product.price }} € </span>
            <span
              class="bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-200 text-xs font-semibold px-2 py-1 rounded-full select-none"
            >
              -70% dto
            </span>
          </div>

          <!-- Envío -->
          <p class="text-green-600 dark:text-green-400 text-sm font-medium">
            Envío gratis en 11 días — desde 8,28 €
          </p>

          <!-- Opciones de color y talla (visual) -->
          <div class="flex flex-col sm:flex-row gap-4 mt-4">
            <div>
              <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                Color:
              </p>
              <div class="flex gap-2">
                <span class="w-5 h-5 rounded-full bg-red-600 border border-white shadow" />
                <span class="w-5 h-5 rounded-full bg-blue-600 border border-white shadow" />
                <span class="w-5 h-5 rounded-full bg-black border border-white shadow" />
              </div>
            </div>
            <div>
              <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                Talla:
              </p>
              <div class="flex gap-2">
                <span
                  class="px-3 py-1 rounded-md border text-sm cursor-default"
                  >S</span
                >
                <span
                  class="px-3 py-1 rounded-md border text-sm cursor-default"
                  >M</span
                >
                <span
                  class="px-3 py-1 rounded-md border text-sm cursor-default"
                  >L</span
                >
              </div>
            </div>
          </div>

          <!-- BOTONES -->
          <div class="flex flex-col sm:flex-row gap-4 mt-6">
            <button
              @click="handleAddToCart(product)"
              :disabled="addingToCart"
              class="w-full sm:w-auto px-6 py-3 rounded-lg bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300"
            >
              <span v-if="addingToCart">Añadiendo...</span>
              <span v-else-if="addedToCart">Añadido ✓</span>
              <span v-else>Añadir al carrito</span>
            </button>

            <Link :href="route('products.index')">
              <button
                class="w-full sm:w-auto px-6 py-3 rounded-lg bg-gradient-to-r from-green-300 to-lime-200 text-gray-800 font-semibold shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300"
              >
                Seguir comprando
              </button>
            </Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Imagen Ampliada -->
    <transition name="fade">
      <div
        v-if="openModal"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 cursor-zoom-out"
        @click.self="openModal = false"
      >
        <img
          :src="activeImage"
          alt="Imagen ampliada producto"
          class="max-w-[90vw] max-h-[90vh] rounded-lg shadow-lg"
          loading="lazy"
        />
      </div>
    </transition>

    <Footer />
  </UserLayouts>
</template>

<script setup>
import UserLayouts from "./Layouts/UserLayouts.vue";
import Footer from "../User/Layouts/Footer.vue";
import { Link, router } from "@inertiajs/vue3";
import { defineProps, ref, onMounted } from "vue";

const props = defineProps({
  product: Object,
});

// Imagen activa
const activeImage = ref(`/${props.product.product_images[0]?.image || ""}`);

// Modal imagen
const openModal = ref(false);

// Estado botón añadir carrito
const addingToCart = ref(false);
const addedToCart = ref(false);

// Stock y aviso urgente
const stockCount = ref(5); // Ajusta según tu lógica real
const lowStock = ref(stockCount.value <= 5);

// Modo oscuro
const isDarkMode = ref(false);

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
  localStorage.setItem("darkMode", isDarkMode.value);
};

// Cargar modo oscuro guardado
onMounted(() => {
  const savedMode = localStorage.getItem("darkMode");
  if (savedMode) {
    isDarkMode.value = savedMode === "true";
  }

  // Reveal on scroll
  const revealElements = document.querySelectorAll(".reveal-on-scroll");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("reveal-visible");
        }
      });
    },
    { threshold: 0.1 }
  );

  revealElements.forEach((el) => observer.observe(el));
});

// Añadir al carrito con animación y feedback + estado botón
const handleAddToCart = (product) => {
  if (addingToCart.value) return; // evitar clicks múltiples

  addingToCart.value = true;
  addedToCart.value = false;

  router.post(
    route("cart.store", product),
    {},
    {
      onSuccess: (page) => {
        if (page.props.flash?.success) {
          addedToCart.value = true;
          // Vuelve al estado normal después de 2s
          setTimeout(() => {
            addedToCart.value = false;
          }, 2000);

          Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            showConfirmButton: false,
            timer: 2500,
            title: page.props.flash.success,
          });
        }
      },
      onError: () => {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo añadir el producto al carrito.",
        });
      },
      onFinish: () => {
        addingToCart.value = false;
      },
    }
  );
};
</script>

<style scoped>
/* Fade entre imágenes */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Animación al aparecer */
@keyframes fade-in {
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
  animation: fade-in 0.5s ease-out;
}

/* Reveal on scroll */
.reveal-on-scroll {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}
.reveal-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Pulso */
@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
  100% {
    transform: scale(1);
  }
}
.hover\:animate-pulse:hover {
  animation: pulse 0.6s ease-in-out;
}

/* Blink animación para stock bajo */
@keyframes blink {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}
.blink-enter-active,
.blink-leave-active {
  animation: blink 1.5s infinite;
}
</style>
