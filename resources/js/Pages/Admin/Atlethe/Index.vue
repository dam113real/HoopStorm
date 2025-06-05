<template>
    <AdminLayout>
        <AtletheList :atlethes = "atlethes"></AtletheList>
    </AdminLayout>
</template>

<script setup>
defineProps({
    atlethes:Array
})
import AdminLayout from '../Components/AdminLayout.vue'
import AtletheList from './AtletheList.vue'
</script>
