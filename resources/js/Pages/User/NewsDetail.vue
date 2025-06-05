<template>
  <UserLayouts>
    <!-- Advanced hero section with dynamic background -->
    <div class="relative overflow-hidden min-h-[50vh] flex items-center" ref="heroSection">
      <!-- Animated gradient background -->
      <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700 z-0">
        <div class="absolute inset-0 opacity-30 mix-blend-overlay">
          <div class="absolute w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLjIxIDEuNzktNCA0LTRzNCAyLjc5IDQgNWMwIDEuMjEtLjM5IDIuMy0xLjA0IDMuMi0uNjUuODktMS42NyAxLjUtMi45MSAxLjUtMi4yMSAwLTQtMS43OS00LTQiLz48cGF0aCBkPSJNMCA1LjVjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTQiLz48L2c+PC9nPjwvc3ZnPg==')] animate-float"></div>
        </div>
      </div>
      
      <!-- Interactive geometric shapes -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-32 h-32 rounded-full bg-gradient-to-r from-teal-400/30 to-emerald-500/30 blur-xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/3 right-1/3 w-24 h-24 rounded-full bg-gradient-to-r from-rose-400/30 to-pink-500/30 blur-xl animate-float-slow"></div>
        <div class="absolute top-1/2 right-1/4 w-40 h-40 rounded-full bg-gradient-to-r from-amber-400/20 to-yellow-500/20 blur-xl animate-float-reverse"></div>
      </div>

      <div class="container mx-auto px-4 py-20 relative z-10">
        <!-- Decorative element -->
      
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white text-center mb-6 animate-fade-in"
            :class="{ 'text-shadow-glow': true }">
          {{ news.title }}
        </h1>
        
        <div class="flex justify-center">
          <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full animate-fade-in-delay">
            <div class="w-2 h-2 bg-lime-400 rounded-full animate-pulse"></div>
            <span class="text-white text-sm font-medium">Breaking News</span>
          </span>
        </div>
      </div>
      
      <!-- Diagonal divider -->
      <div class="absolute bottom-0 left-0 right-0 h-16 bg-white dark:bg-gray-900 transform -skew-y-2 translate-y-8 z-20"></div>
    </div>

    <!-- Main content with enhanced visuals -->
    <div class="container mx-auto px-4 -mt-6 mb-20 relative z-30">
      <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-500 animate-slide-up">
        <div class="grid grid-cols-1 lg:grid-cols-2">
          <!-- Enhanced image container with overlay effects -->
          <div class="relative overflow-hidden group h-[400px] lg:h-auto">
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20 opacity-40 group-hover:opacity-60 transition-opacity duration-500 z-10"></div>
            
            <!-- Image with parallax effect -->
            <div class="absolute inset-0 scale-105 group-hover:scale-110 transition-transform duration-3000 ease-out">
              <img 
                v-if="news.news_images && news.news_images.length > 0" 
                :src="`/${news.news_images[0].image}`"
                :alt="news.imageAlt"
                class="w-full h-full object-cover object-center"
              />
              <img 
                v-else
                src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
                :alt="news.imageAlt"
                class="w-full h-full object-cover object-center"
              />
            </div>
            
            <!-- Interactive badges -->
            <div class="absolute bottom-6 left-6 z-20 flex flex-wrap gap-2">
              <span class="px-3 py-1 bg-teal-400/90 text-white text-xs font-bold rounded-full transform group-hover:translate-y-0 translate-y-10 transition-transform duration-500 delay-100">
                #trending
              </span>
              <span class="px-3 py-1 bg-purple-500/90 text-white text-xs font-bold rounded-full transform group-hover:translate-y-0 translate-y-10 transition-transform duration-500 delay-200">
                #mustread
              </span>
              <span class="px-3 py-1 bg-amber-500/90 text-white text-xs font-bold rounded-full transform group-hover:translate-y-0 translate-y-10 transition-transform duration-500 delay-300">
                #latest
              </span>
            </div>
            
            <!-- Reading time indicator -->
            <div class="absolute top-6 right-6 z-20 px-4 py-2 bg-black/50 backdrop-blur-sm rounded-full text-white text-sm font-medium">
              {{ calculateReadingTime(news.description + ' ' + news.extrainfo) }} min read
            </div>
          </div>
          
          <!-- Enhanced content section -->
          <div class="p-8 lg:p-12 animate-fade-in-delay-2">
            <!-- Modern title design -->
            <div class="relative mb-8">
              <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-teal-400 to-lime-400 rounded-full"></div>
              <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white pl-4">{{ news.title }}</h2>
              <div class="mt-2 pl-4">
                <div class="flex items-center gap-2">
                  <span class="block bg-gradient-to-r from-teal-400 to-lime-400 h-0.5 w-10"></span>
                  <span class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-medium">Featured Story</span>
                </div>
              </div>
            </div>
            
            <!-- Description with enhanced typography -->
            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8 first-letter:text-4xl first-letter:font-bold first-letter:text-teal-500 first-letter:mr-1 first-letter:float-left">
              {{ news.description }}
            </p>
            
            <!-- Author info with modern design -->
            <div class="flex items-center mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
              <div class="relative flex-shrink-0">
                <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-teal-400 to-lime-400 animate-spin-slow"></div>
                <div class="relative h-10 w-10 rounded-full overflow-hidden border-2 border-white dark:border-gray-800">
                  <img src="https://ui-avatars.com/api/?name=News&background=random" alt="Author" class="h-full w-full object-cover" />
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-800 dark:text-white">Staff Writer</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ formatDate(new Date()) }}</p>
              </div>
              
              <!-- Interactive reading indicator -->
              <div class="ml-auto flex items-center">
                <div class="w-16 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-teal-400 to-lime-400" :style="{ width: `${readingProgress}%` }"></div>
                </div>
                <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ Math.round(readingProgress) }}%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Enhanced content body -->
      <div class="mt-12 px-4 md:px-12 lg:px-16 bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 md:p-10 animate-fade-in-delay-3">
        <!-- Modern divider -->
        <div class="relative h-0.5 w-full mb-10">
          <div class="absolute inset-0 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
          <div class="absolute inset-0 bg-gradient-to-r from-teal-400 to-lime-400 rounded-full w-1/3"></div>
          <div class="absolute top-1/2 left-1/3 w-3 h-3 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-teal-400 to-lime-400 rounded-full"></div>
        </div>
        
        <!-- Content with enhanced typography -->
        <div class="prose prose-lg dark:prose-invert max-w-none">
          <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
            {{ news.extrainfo }}
          </p>
        </div>
        
        <!-- Interactive feedback section -->
        <div class="mt-16 flex justify-center">
          <div class="inline-flex bg-gray-100 dark:bg-gray-700/50 p-1 rounded-full">
            <button @click="like" class="flex items-center gap-2 px-5 py-2 rounded-full transition-colors duration-300"
                    :class="isLiked ? 'bg-gradient-to-r from-teal-400 to-lime-400 text-gray-900' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
              </svg>
              <span>{{ likeCount }}</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modernized floating back button -->
    <div class="fixed bottom-10 right-10 z-50">
      <Link 
        :href="route('news.index')"
        class="flex items-center gap-2 p-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-lg rounded-full hover:shadow-xl transform hover:scale-110 transition-all duration-300 group overflow-hidden">
        <!-- Button background effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-teal-400 to-lime-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Button content -->
        <svg class="w-6 h-6 relative z-10 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="absolute right-0 transform translate-x-10 group-hover:translate-x-0 transition-transform duration-300 pr-4 font-medium relative z-10">Back</span>
      </Link>
    </div>
    
    <!-- Modern reading progress bar -->
    <div class="fixed top-0 left-0 right-0 h-1 z-50">
      <div class="h-full bg-gradient-to-r from-teal-400 via-lime-400 to-teal-400 backdrop-blur-sm" :style="{ width: `${readingProgress}%` }"></div>
    </div>
    
    <!-- Toast notification container -->
    <div ref="toastContainer" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 z-50"></div>
  </UserLayouts>
  <Footer />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import UserLayouts from "./Layouts/UserLayouts.vue";
import Footer from '../User/Layouts/Footer.vue';
import { ref, onMounted, onUnmounted } from 'vue';

// Define props para recibir el producto desde Inertia
const props = defineProps({
  news: Object,
});

// DOM refs
const heroSection = ref(null);
const toastContainer = ref(null);

// UI state
const readingProgress = ref(0);
const isLiked = ref(false);
const likeCount = ref(Math.floor(Math.random() * 50) + 5); // Random initial likes

// Format date utility
const formatDate = (date) => {
  return new Intl.DateTimeFormat('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  }).format(date);
};

// Calculate reading time based on content length
const calculateReadingTime = (content) => {
  const wordsPerMinute = 200;
  const words = content.split(/\s+/).length;
  const minutes = Math.ceil(words / wordsPerMinute);
  return Math.max(1, minutes); // At least 1 minute
};

// Reading progress tracking
const calculateReadingProgress = () => {
  const scrollTop = window.scrollY;
  const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
  readingProgress.value = (scrollTop / scrollHeight) * 100;
};

// Like functionality
const like = () => {
  if (!isLiked.value) {
    likeCount.value++;
    isLiked.value = true;
    
    // Create heart animation
    const heart = document.createElement('div');
    heart.className = 'absolute text-4xl text-rose-500 pointer-events-none z-50';
    heart.style.left = `${Math.random() * 80 + 10}%`;
    heart.style.top = '100%';
    heart.innerHTML = '❤️';
    document.body.appendChild(heart);
    
    // Animate heart
    heart.animate([
      { transform: 'translateY(0) scale(1)', opacity: 1 },
      { transform: 'translateY(-100px) scale(1.5)', opacity: 0.5 },
      { transform: 'translateY(-200px) scale(0.5)', opacity: 0 }
    ], {
      duration: 1500,
      easing: 'ease-out'
    }).onfinish = () => {
      document.body.removeChild(heart);
    };
  } else {
    likeCount.value--;
    isLiked.value = false;
  }
};

// Parallax effect and scroll handling
const handleScroll = () => {
  calculateReadingProgress();
  
  if (heroSection.value) {
    const scrollPosition = window.scrollY;
    const offset = scrollPosition * 0.4;
    heroSection.value.style.backgroundPosition = `50% ${offset}px`;
  }
  
  // Animate elements on scroll
  const animateOnScroll = () => {
    const elements = document.querySelectorAll('.animate-on-scroll');
    elements.forEach(el => {
      const rect = el.getBoundingClientRect();
      const windowHeight = window.innerHeight || document.documentElement.clientHeight;
      
      if (rect.top <= windowHeight * 0.85 && rect.bottom >= 0) {
        el.classList.add('visible');
      }
    });
  };
  
  animateOnScroll();
};

// Lifecycle hooks
onMounted(() => {
  window.addEventListener('scroll', handleScroll);
  
  // Add animation classes to elements when they come into view
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
      }
    });
  }, { threshold: 0.1 });
  
  document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
  });
  
  // Initial call to set up animations
  handleScroll();
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<style>
/* Text shadow effect */
.text-shadow-glow {
  text-shadow: 0 0 20px rgba(56, 189, 248, 0.5), 0 0 30px rgba(6, 182, 212, 0.3);
}

/* Advanced animations */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slideUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes widthExpand {
  from { width: 0; }
  to { width: 20px; }
}

@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
  100% { transform: translateY(0px); }
}

@keyframes floatSlow {
  0% { transform: translate(0px, 0px); }
  33% { transform: translate(10px, -30px); }
  66% { transform: translate(-20px, 20px); }
  100% { transform: translate(0px, 0px); }
}

@keyframes floatReverse {
  0% { transform: translate(0px, 0px); }
  33% { transform: translate(-15px, 10px); }
  66% { transform: translate(10px, -15px); }
  100% { transform: translate(0px, 0px); }
}

@keyframes spinSlow {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Applied animations */
.animate-fade-in {
  opacity: 0;
  animation: fadeIn 0.8s ease-out forwards;
}

.animate-fade-in-delay {
  opacity: 0;
  animation: fadeIn 0.8s ease-out 0.3s forwards;
}

.animate-fade-in-delay-2 {
  opacity: 0;
  animation: fadeIn 0.8s ease-out 0.6s forwards;
}

.animate-fade-in-delay-3 {
  opacity: 0;
  animation: fadeIn 0.8s ease-out 0.9s forwards;
}

.animate-width-expand {
  width: 0;
  animation: widthExpand 0.8s ease-out 0.2s forwards;
}

.animate-slide-up {
  opacity: 0;
  animation: slideUp 1s ease-out 0.3s forwards;
}

.animate-float {
  animation: float 15s ease-in-out infinite;
}

.animate-float-slow {
  animation: floatSlow 20s ease-in-out infinite;
}

.animate-float-reverse {
  animation: floatReverse 18s ease-in-out infinite;
}

.animate-spin-slow {
  animation: spinSlow 8s linear infinite;
}

.animate-pulse-slow {
  animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Transition durations */
.duration-3000 {
  transition-duration: 3000ms;
}

/* Scroll animation classes */
.animate-on-scroll {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.animate-on-scroll.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Ensure dark mode works correctly */
@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #1f2937;
  }
  
  .dark\:bg-gray-900 {
    background-color: #111827;
  }
  
  .dark\:text-white {
    color: #ffffff;
  }
  
  .dark\:text-gray-300 {
    color: #d1d5db;
  }
  
  .dark\:text-gray-400 {
    color: #9ca3af;
  }
  
  .dark\:border-gray-700 {
    border-color: #374151;
  }
  
  .dark\:border-gray-800 {
    border-color: #1f2937;
  }
  
  .dark\:bg-gray-700\/50 {
    background-color: rgba(55, 65, 81, 0.5);
  }
  
  .dark\:prose-invert {
    --tw-prose-body: #d1d5db;
    --tw-prose-headings: #ffffff;
    --tw-prose-links: #93c5fd;
  }
}
</style>