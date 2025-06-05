<template>
    <div>
        

          <div v-for="atlethe in atlethes" :key="atlethe.id" class="group scale-95 duration-300 hover:scale-105 relative">
             
              <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75">
                  <img v-if="atlethe.atlethe_images.length > 0" :src="`/${atlethe.atlethe_images[0].image}`"
                      :alt="atlethe.imageAlt"
                      class="w-full 2xl:h-96 xl:h-80 lg:h-72 md:h-72 max-sm:h-52 object-cover object-center" />
                  <img v-else
                      src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"
                      :alt="atlethe.imageAlt" class="w-full  object-cover object-center" />
                      <div
                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer ">

                   
                    <Link :href="route('atlethes.show', { atlethe: atlethe.id })">
                    <!-- Contenido del enlace -->
                    <div class="bg-blue-700 p-2 rounded-full ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    </Link>

                </div>
              </div>
         
  
              <div class="mt-4 flex justify-between">
                  <div class="flex gap-2 flex-col">
                      <p class="xl:text-xl 2xl:text-xl font-bold ">
                          {{ atlethe.title }}
                      </p>
                      <p class="xl:text-base 2xl:text-lg "> {{ atlethe.description }}</p>
                  
  
                      <!-- <p class="mt-1 xl:text-sm 2xl:text-base text-gray-500">{{ product.brand.name }}</p> -->
                  </div>
                  <!-- <p class="2xl:text-base xl:text-sm font-semibold text-gray-900">${{ product.price }}</p> -->
              </div>
          </div>
      </div>
  </template>
  
  
  
  <script  setup>
  import { Link, router } from "@inertiajs/vue3";
  defineProps({
    atlethes:Array
   })
  
  
  </script>
  
  <style></style>
  