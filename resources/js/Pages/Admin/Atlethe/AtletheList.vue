<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'


defineProps({
    atlethes: Array
})

const brands = usePage().props.brands;
const categories = usePage().props.categories;


// console.log(products);
const isAddAtlethe = ref(false);
const editMode = ref(false);
const dialogVisible = ref(false)

//upload mulitpel images
const atletheImages = ref([])
const dialogImageUrl = ref('')
const handleFileChange = (file) => {
    console.log(file)
    atletheImages.value.push(file)
}

const handlePictureCardPreview = (file) => {
    dialogImageUrl.value = file.url
    dialogVisible.value = true
}

const handleRemove = (file) => {
    console.log(file)
}
//news from data
const id = ref('');
const title = ref('')
const description = ref('')
const extrainfo = ref('')
const atlethe_images = ref([])
const published = ref('')
//const category_id = ref('')
//const brand_id = ref('')
//end

const openEditModal = (atlethe, index) => {

    console.log(atlethe, index);
    //updatde data
    id.value = atlethe.id;
    title.value = atlethe.title;
    description.value = atlethe.description;
    extrainfo.value = atlethe.extrainfo;
    //brand_id.value = product.brand_id;
    //category_id.value = product.category_id;
    atlethe_images.value = atlethe.atlethe_images;

    editMode.value = true;
    isAddAtlethe.value = false
    dialogVisible.value = true

}


//open add modal
const openAddModal = () => {
    isAddAtlethe.value = true
    dialogVisible.value = true
    editMode.value = false;

}

// add product method
const AddAtlethe = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('extrainfo', extrainfo.value);
    //formData.append('brand_id', brand_id.value);
    //formData.append('category_id', category_id.value);
    // Append product images to the FormData
    for (const image of atletheImages.value) {
        formData.append('atlethe_images[]', image.raw);
    }

    try {
        await router.post('atlethes/store', formData, {
            onSuccess: page => {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    title: page.props.flash.success
                })
                dialogVisible.value = false;
                resetFormData();
            },
        })
    } catch (err) {
        console.log(err)
    }



}

//rest data after added
const resetFormData = () => {
    id.value = '';
    title.value = '';
    description.value = '';
    extrainfo.value = '';
    atletheImages.value = [];
    dialogImageUrl.value = ''
};



//delete sigal product image

const deleteImage = async (aimage, index) => {
    try {
        await router.delete('/admin/atlethes/image/' + aimage.id, {
            onSuccess: (page) => {
                atlethe_images.value.splice(index, 1);
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success
                });
            }
        })
    } catch (err) {
        console.log(err);
    }
}

//update product method
const updateAtlethe = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('extrainfo', extrainfo.value);
   // formData.append('category_id', category_id.value);
   // formData.append('brand_id', brand_id.value);
    formData.append("_method", 'PUT');
    // Append product images to the FormData
    for (const image of atletheImages.value) {
        formData.append('atlethe_images[]', image.raw);
    }

    try {
        await router.post('atlethes/update/' + id.value, formData, {
            onSuccess: (page) => {
                dialogVisible.value = false;
                resetFormData();
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success
                });
            }
        })
    } catch (err) {
        console.log(err)
    }
}

//delete product method
const deleteAtlethe = (atlethe, index) => {
    Swal.fire({
        title: 'Are you Sure',
        text: "This actions cannot undo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'no',
        confirmButtonText: 'yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                router.delete('atlethes/destory/' + atlethe.id, {
                    onSuccess: (page) => {
                        this.delete(atlethe, index);
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            position: "top-end",
                            showConfirmButton: false,
                            title: page.props.flash.success
                        });
                    }
                })
            } catch (err) {
                console.log(err)
            }
        }
    })

}
</script>
<template>
    <section class="p-3 sm:p-5 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
        <!-- Modern Modal for adding/editing athlete -->
        <el-dialog 
            v-model="dialogVisible" 
            :title="editMode ? 'Editar Atleta' : 'Nuevo Atleta'" 
            width="600px"
            :before-close="handleClose"
            class="modern-dialog"
        >
            <template #header>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ editMode ? 'Editar Atleta' : 'Nuevo Atleta' }}</h3>
                        <p class="text-sm text-gray-500">{{ editMode ? 'Actualiza la información del atleta' : 'Completa los datos del nuevo atleta' }}</p>
                    </div>
                </div>
            </template>

            <div class="bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-2xl p-6">
                <form @submit.prevent="editMode ? updateAtlethe() : AddAtlethe()" class="space-y-6">
                    <!-- Title Field with Modern Design -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Nombre del Atleta</span>
                            </span>
                        </label>
                        <input 
                            v-model="title" 
                            type="text" 
                            class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 group-hover:border-gray-300" 
                            placeholder="Ingresa el nombre del atleta" 
                            required 
                        />
                    </div>

                    <!-- Description Field -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Descripción</span>
                            </span>
                        </label>
                        <textarea 
                            v-model="description"
                            rows="4" 
                            class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-300 resize-none group-hover:border-gray-300"
                            placeholder="Describe los logros y características del atleta..."
                        ></textarea>
                    </div>

                    <!-- Extra Info Field -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Información Adicional</span>
                            </span>
                        </label>
                        <textarea 
                            v-model="extrainfo"
                            rows="3" 
                            class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 resize-none group-hover:border-gray-300"
                            placeholder="Información adicional relevante..."
                        ></textarea>
                    </div>

                    <!-- Images Upload Section -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Imágenes del Atleta</span>
                            </span>
                        </label>
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border-2 border-dashed border-gray-300 hover:border-indigo-400 transition-colors duration-300">
                            <el-upload 
                                v-model:file-list="atletheImages" 
                                list-type="picture-card" 
                                multiple
                                :on-preview="handlePictureCardPreview" 
                                :on-remove="handleRemove" 
                                :on-change="handleFileChange"
                                class="modern-upload"
                            >
                                <div class="flex flex-col items-center justify-center py-4">
                                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="text-sm text-gray-500">Agregar imagen</span>
                                </div>
                            </el-upload>
                        </div>
                    </div>

                    <!-- Current Images Display -->
                    <div v-if="atlethe_images && atlethe_images.length > 0" class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Imágenes Actuales</label>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
                            <div v-for="(aimage, index) in atlethe_images" :key="aimage.id" class="relative group/image">
                                <div class="relative overflow-hidden rounded-xl bg-white p-2 shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <img class="w-full h-20 object-cover rounded-lg" :src="`/${aimage.image}`" alt="">
                                    <button 
                                        @click="deleteImage(aimage, index)"
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors duration-200 opacity-0 group-hover/image:opacity-100"
                                    >
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4">
                        <button 
                            type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-indigo-700 focus:ring-4 focus:ring-blue-200 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            {{ editMode ? 'Actualizar Atleta' : 'Crear Atleta' }}
                        </button>
                    </div>
                </form>
            </div>
        </el-dialog>

        <!-- Main Content Container -->
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                            Gestión de Atletas
                        </h1>
                        <p class="text-gray-600">Administra los perfiles de atletas y su información</p>
                    </div>
                </div>
            </div>

            <!-- Modern Card Container -->
            <div class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/50 overflow-hidden">
                <!-- Top Actions Bar -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                        <!-- Search Section -->
                        <div class="w-full md:w-1/2">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    class="w-full pl-12 pr-4 py-3 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" 
                                    placeholder="Buscar atletas..." 
                                />
                            </div>
                        </div>

                        <!-- Add Button -->
                        <div class="w-full md:w-auto">
                            <button 
                                type="button" 
                                @click="openAddModal"
                                class="w-full md:w-auto flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-indigo-700 focus:ring-4 focus:ring-blue-200 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nuevo Atleta
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modern Table -->
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-blue-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Atleta
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr 
                                    v-for="(atlethe, index) in atlethes" 
                                    :key="atlethe.id"
                                    class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/30 transition-all duration-300 group"
                                >
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                                    {{ atlethe.title }}
                                                </h3>
                                                <p class="text-sm text-gray-500">Atleta profesional</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span 
                                            v-if="atlethe.published == 0" 
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200"
                                        >
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                            Publicado
                                        </span>
                                        <span 
                                            v-else 
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200"
                                        >
                                            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                            No Publicado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button 
                                                @click="openEditModal(atlethe)"
                                                class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors duration-200 hover:scale-110 transform"
                                                title="Editar"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteAtlethe(atlethe, index)"
                                                class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors duration-200 hover:scale-110 transform"
                                                title="Eliminar"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modern Pagination -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50/50 px-6 py-4 border-t border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <div class="text-sm text-gray-600">
                            Mostrando <span class="font-semibold text-gray-900">1-10</span> de <span class="font-semibold text-gray-900">1000</span> resultados
                        </div>
                        <div class="flex items-center space-x-1">
                            <button class="p-2 bg-white hover:bg-gray-50 text-gray-600 rounded-lg border border-gray-200 transition-colors duration-200 hover:border-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button class="px-3 py-2 bg-blue-500 text-white rounded-lg font-medium">1</button>
                            <button class="px-3 py-2 bg-white hover:bg-gray-50 text-gray-600 rounded-lg border border-gray-200 transition-colors duration-200">2</button>
                            <button class="px-3 py-2 bg-white hover:bg-gray-50 text-gray-600 rounded-lg border border-gray-200 transition-colors duration-200">3</button>
                            <span class="px-2 text-gray-500">...</span>
                            <button class="px-3 py-2 bg-white hover:bg-gray-50 text-gray-600 rounded-lg border border-gray-200 transition-colors duration-200">100</button>
                            <button class="p-2 bg-white hover:bg-gray-50 text-gray-600 rounded-lg border border-gray-200 transition-colors duration-200 hover:border-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.modern-dialog :deep(.el-dialog) {
    @apply rounded-3xl border-0 shadow-2xl;
}

.modern-dialog :deep(.el-dialog__header) {
    @apply bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-3xl border-b border-gray-100 p-6;
}

.modern-dialog :deep(.el-dialog__body) {
    @apply p-0;
}

.modern-upload :deep(.el-upload--picture-card) {
    @apply bg-white/60 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 transition-colors duration-300;
}

.modern-upload :deep(.el-upload-list--picture-card) {
    @apply grid grid-cols-3 gap-4;
}

.modern-upload :deep(.el-upload-list__item) {
    @apply rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300;
}
</style>
