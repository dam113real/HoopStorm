<template>
    <AdminLayout>
        <NewsList :news = "news"></NewsList>
    </AdminLayout>
</template>

<script setup>
defineProps({
    news:Array
})
import AdminLayout from '../Components/AdminLayout.vue'
import NewsList from './NewsList.vue'
</script>
