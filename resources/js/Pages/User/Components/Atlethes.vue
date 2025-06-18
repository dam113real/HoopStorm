<template>
    <div>
        <div v-for="atlethe in atlethes" :key="atlethe.id" class="group scale-95 duration-300 hover:scale-105 relative cursor-pointer">
            <Link :href="route('atlethes.show', { atlethe: atlethe.id })">
                <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75">
                    <img v-if="atlethe.atlethe_images.length > 0" :src="`/${atlethe.atlethe_images[0].image}`"
                        :alt="atlethe.imageAlt"
                        class="w-full 2xl:h-96 xl:h-80 lg:h-72 md:h-72 max-sm:h-52 object-cover object-center" />
                    <img v-else
                        src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
                        :alt="atlethe.imageAlt" class="w-full object-cover object-center" />
                </div>
                
                <div class="mt-4 flex justify-between">
                    <div class="flex gap-2 flex-col">
                        <p class="xl:text-xl 2xl:text-xl font-bold ">
                            {{ atlethe.title }}
                        </p>
                        <p class="xl:text-base 2xl:text-lg "> {{ atlethe.description }}</p>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
defineProps({
  atlethes: Array
})
</script>

<style></style>