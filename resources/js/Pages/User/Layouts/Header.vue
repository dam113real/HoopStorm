<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';

const canLogin = usePage().props.canLogin;
const canRegister = usePage().props.canRegister;
const auth = usePage().props.auth;
const cart = computed(() => usePage().props.cart);

const isAdmin = computed(() => auth.user?.isAdmin === 1);
const isMenuOpen = ref(false);
const isUserDropdownOpen = ref(false);
const isScrolled = ref(false);

// Dark mode with system preference detection
const isDarkMode = ref(false);

onMounted(() => {
  // Check for scroll to add shadow
  window.addEventListener('scroll', handleScroll);
  
  // Dark mode with system preference
  const savedMode = localStorage.getItem('darkMode');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
  isDarkMode.value = savedMode ? savedMode === 'true' : systemPrefersDark;
  updateDarkClass(isDarkMode.value);
});

function handleScroll() {
  isScrolled.value = window.scrollY > 10;
}

function toggleDarkMode() {
  isDarkMode.value = !isDarkMode.value;
  localStorage.setItem('darkMode', isDarkMode.value);
  updateDarkClass(isDarkMode.value);
}

function updateDarkClass(enabled) {
  const html = document.documentElement;
  enabled ? html.classList.add('dark') : html.classList.remove('dark');
}

function toggleMenu() {
  isMenuOpen.value = !isMenuOpen.value;
}

function toggleUserDropdown() {
  isUserDropdownOpen.value = !isUserDropdownOpen.value;
}
</script>

<template>
  <header 
    class="fixed w-full z-50 transition-all duration-500 ease-out-expo"
    :class="{
      'bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-lg': isScrolled,
      'bg-white dark:bg-gray-900': !isScrolled
    }"
  >
  
    <!-- Gradient decorative elements -->
    <div class="absolute inset-0 -z-10 opacity-20 overflow-hidden">
      <div class="absolute -top-20 -left-20 w-80 h-80 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
      <div class="absolute -top-20 -right-20 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 md:h-20">
        <!-- Logo with animation -->
        <Link 
          :href="route('home')" 
          class="flex items-center space-x-2 group"
          aria-label="Home"
        >
          <div class="relative">
            <div class="absolute -inset-2 bg-indigo-500/10 rounded-full group-hover:opacity-100 opacity-0 transition-opacity duration-300"></div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
              class="w-8 h-8 text-indigo-600 dark:text-indigo-400 transform transition-transform group-hover:rotate-12 group-hover:scale-110 duration-300">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
          </div>
          <span class="text-2xl font-bold bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 text-transparent bg-clip-text tracking-tight">
            Hoop Storm
          </span>
        </Link>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <Link 
            :href="route('home')" 
            class="relative text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
            active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          >
            <span class="relative group">
              Home
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
          </Link>

          <Link 
            :href="route('products.index')" 
            class="relative text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
            active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          >
            <span class="relative group">
              Tienda
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
          </Link>

          <Link 
            :href="route('news.index')" 
            class="relative text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
            active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          >
            <span class="relative group ">
              Noticias
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
          </Link>

          <Link 
            :href="route('atlethes.index')" 
            class="relative text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
            active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          >
            <span class="relative group">
              Atletas
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
          </Link>

          <Link 
            v-if="isAdmin"
            :href="route('admin.dashboard')" 
            class="relative text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
            active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          >
            <span class="relative group">
              Admin
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
            </span>
          </Link>
        </nav>

        <!-- Right side controls -->
        <div class="flex items-center space-x-4">
          <!-- Dark mode toggle -->
          <button
            @click="toggleDarkMode"
            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300"
            aria-label="Toggle dark mode"
          >
            <svg v-if="isDarkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
          </button>

          <!-- Cart with animation -->
          <Link 
            :href="route('cart.view')" 
            class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300 group"
            aria-label="Shopping cart"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <span v-if="cart.data.count > 0" class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full transform group-hover:scale-110 transition-transform">
              {{ cart.data.count }}
            </span>
          </Link>

          <!-- User controls -->
          <div class="relative" v-if="canLogin">
            <div v-if="auth.user">
              <button 
                @click="toggleUserDropdown"
                class="flex items-center space-x-1 focus:outline-none group"
                aria-label="User menu"
              >
                <div class="relative">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-medium">
                    {{ auth.user.name.charAt(0).toUpperCase() }}
                  </div>
                  <div class="absolute inset-0 rounded-full border-2 border-white/30 group-hover:border-indigo-400 transition-all duration-300"></div>
                </div>
              </button>

              <!-- User dropdown -->
              <div 
                v-show="isUserDropdownOpen"
                @click.away="isUserDropdownOpen = false"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5 focus:outline-none transition-all origin-top-right duration-200 ease-out"
                :class="{
                  'scale-95 opacity-0 invisible': !isUserDropdownOpen,
                  'scale-100 opacity-100 visible': isUserDropdownOpen
                }"
              >
                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth.user.name }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth.user.email }}</p>
                </div>
                <Link 
                  :href="route('dashboard')"
                  class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                >
                  Mis Pedidos
                </Link>
                <Link 
                  :href="route('logout')" 
                  method="post"
                  class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                >
                  Cerrar Cesión
                </Link>
              </div>
            </div>

            <div v-else class="flex items-center space-x-2">
              <Link 
                :href="route('login')" 
                class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
              >
                Sign in
              </Link>
              <Link 
                v-if="canRegister"
                :href="route('register')" 
                class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
              >
                Sign up
              </Link>
            </div>
          </div>

          <!-- Mobile menu button -->
          <button 
            @click="toggleMenu"
            class="md:hidden p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300"
            aria-label="Toggle menu"
          >
            <svg v-if="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div 
      class="md:hidden transition-all duration-300 ease-out-expo overflow-hidden"
      :class="{
        'max-h-0 opacity-0': !isMenuOpen,
        'max-h-screen opacity-100 py-4': isMenuOpen
      }"
    >
      <div class="px-4 sm:px-6 lg:px-8 space-y-4">
        <Link 
          :href="route('home')" 
          class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
          active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          @click="isMenuOpen = false"
        >
          Home
        </Link>
        <Link 
          :href="route('products.index')" 
          class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
          active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          @click="isMenuOpen = false"
        >
          Tienda
        </Link>
        <Link 
          :href="route('news.index')" 
          class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
          active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          @click="isMenuOpen = false"
        >
          Noticias
        </Link>
        <Link 
          :href="route('atlethes.index')" 
          class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
          active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          @click="isMenuOpen = false"
        >
          Atletas
        </Link>
        <Link 
          v-if="isAdmin"
          :href="route('admin.dashboard')" 
          class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
          active-class="text-indigo-600 dark:text-indigo-400 font-semibold"
          @click="isMenuOpen = false"
        >
          Admin 
        </Link>
      </div>
    </div>
  </header>
</template>

<style>
/* Custom animations */
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(20px, -30px) scale(1.1); }
  66% { transform: translate(-10px, 10px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
  animation: blob 7s ease-in-out infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.ease-out-expo {
  transition-timing-function: cubic-bezier(0.19, 1, 0.22, 1);
}

/* Custom scrollbar for dark mode */
.dark ::-webkit-scrollbar {
  width: 8px;
}

.dark ::-webkit-scrollbar-track {
  background: #1f2937;
}

.dark ::-webkit-scrollbar-thumb {
  background: #4b5563;
  border-radius: 4px;
}

.dark ::-webkit-scrollbar-thumb:hover {
  background: #6b7280;
}
</style>