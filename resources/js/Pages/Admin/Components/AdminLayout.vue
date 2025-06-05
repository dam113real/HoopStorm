<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- navbar start -->
        <Navbar/>
        <div class="w-full flex flex-row">
            <div class="w-fit">
                <Sidebar />
            </div>
            <div class="flex-1">
                <slot />
            </div>
        </div>

    </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Navbar from './Navbar.vue'
import Sidebar from './Sidebar.vue'
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
