<template>
  <div class="grid gap-8">
    <div
      v-for="news in news"
      :key="news.id"
      class="relative overflow-hidden rounded-3xl bg-white shadow-xl hover:shadow-2xl transition-shadow duration-500 group cursor-pointer"
    >
      <Link :href="route('news.show', { news: news.id })">
        <div class="relative w-full h-64 overflow-hidden">
          <img
            v-if="news.news_images.length > 0"
            :src="`/${news.news_images[0].image}`"
            :alt="news.imageAlt"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
          />
          <img
            v-else
            src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            :alt="news.imageAlt"
          />
        </div>

        <div class="p-5 space-y-2">
          <h2 class="text-lg md:text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">
            {{ news.title }}
          </h2>
        </div>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  news: Array
})
</script>