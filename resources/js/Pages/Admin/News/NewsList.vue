<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'


defineProps({
    news: Array
})

const brands = usePage().props.brands;
const categories = usePage().props.categories;


// console.log(products);
const isAddNews = ref(false);
const editMode = ref(false);
const dialogVisible = ref(false)

//upload mulitpel images
const newsImages = ref([])
const dialogImageUrl = ref('')
const handleFileChange = (file) => {
    console.log(file)
    newsImages.value.push(file)
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
const news_images = ref([])
const published = ref('')
//const category_id = ref('')
//const brand_id = ref('')
//end

const openEditModal = (news, index) => {

    console.log(news, index);
    //updatde data
    id.value = news.id;
    title.value = news.title;
    description.value = news.description;
    extrainfo.value = news.extrainfo;
    //brand_id.value = product.brand_id;
    //category_id.value = product.category_id;
    news_images.value = news.news_images;

    editMode.value = true;
    isAddNews.value = false
    dialogVisible.value = true

}


//open add modal
const openAddModal = () => {
    isAddNews.value = true
    dialogVisible.value = true
    editMode.value = false;

}

// add product method
const AddNews = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('extrainfo', extrainfo.value);
    //formData.append('brand_id', brand_id.value);
    //formData.append('category_id', category_id.value);
    // Append product images to the FormData
    for (const image of newsImages.value) {
        formData.append('news_images[]', image.raw);
    }

    try {
        await router.post('news/store', formData, {
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
    newsImages.value = [];
    dialogImageUrl.value = ''
};



//delete sigal product image

const deleteImage = async (nimage, index) => {
    try {
        await router.delete('/admin/news/image/' + nimage.id, {
            onSuccess: (page) => {
                news_images.value.splice(index, 1);
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
const updateNews = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('extrainfo', extrainfo.value);
   // formData.append('category_id', category_id.value);
   // formData.append('brand_id', brand_id.value);
    formData.append("_method", 'PUT');
    // Append product images to the FormData
    for (const image of newsImages.value) {
        formData.append('news_images[]', image.raw);
    }

    try {
        await router.post('news/update/' + id.value, formData, {
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
const deleteNews = (news, index) => {
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
                router.delete('news/destory/' + news.id, {
                    onSuccess: (page) => {
                        this.delete(news, index);
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
    <section class="min-h-screen p-3 sm:p-8">
        <!-- Modal moderno con glassmorphism -->
        <el-dialog 
            v-model="dialogVisible" 
            :title="editMode ? 'Editar Noticia' : 'Nueva Noticia'" 
            width="90%" 
            max-width="600px"
            :before-close="handleClose"
            class="modern-dialog"
        >
            <template #header>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        {{ editMode ? 'Editar Noticia' : 'Nueva Noticia' }}
                    </h3>
                </div>
            </template>

            <div class="backdrop-blur-sm bg-white/5 rounded-2xl p-6 border border-gray-200">
                <form @submit.prevent="editMode ? updateNews() : AddNews()" class="space-y-6">
                    <!-- Título con efecto futurista -->
                    <div class="group">
                        <div class="relative">
                            <input 
                                v-model="title" 
                                type="text" 
                                id="floating_title"
                                class="peer w-full bg-transparent border-0 border-b-2 border-gray-300 text-gray-800 placeholder-transparent focus:border-blue-500 focus:outline-none transition-all duration-300 py-3 text-lg"
                                placeholder="Título de la noticia" 
                                required 
                            />
                            <label 
                                for="floating_title"
                                class="absolute left-0 -top-6 text-blue-500 text-sm font-medium transition-all duration-300 peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-focus:-top-6 peer-focus:text-blue-500 peer-focus:text-sm"
                            >
                                Título
                            </label>
                            <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-300 peer-focus:w-full"></div>
                        </div>
                    </div>

                    <!-- Descripción con estilo moderno -->
                    <div class="space-y-2">
                        <label class="text-gray-700 text-sm font-medium flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                            </svg>
                            <span>Descripción</span>
                        </label>
                        <textarea 
                            v-model="description"
                            rows="4"
                            class="w-full bg-gray-50 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-500 focus:border-blue-500 focus:bg-white transition-all duration-300 p-4 resize-none"
                            placeholder="Escribe la descripción de la noticia..."
                        ></textarea>
                    </div>

                    <!-- Información extra -->
                    <div class="space-y-2">
                        <label class="text-gray-700 text-sm font-medium flex items-center space-x-2">
                            <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                            </svg>
                            <span>Información Extra</span>
                        </label>
                        <textarea 
                            v-model="extrainfo"
                            rows="4"
                            class="w-full bg-gray-50 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-500 focus:border-purple-500 focus:bg-white transition-all duration-300 p-4 resize-none"
                            placeholder="Información adicional..."
                        ></textarea>
                    </div>

                    <!-- Upload de imágenes modernizado -->
                    <div class="space-y-4">
                        <label class="text-gray-700 text-sm font-medium flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                            <span>Imágenes</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 bg-gray-50 hover:border-gray-400 transition-all duration-300">
                            <el-upload 
                                v-model:file-list="newsImages" 
                                list-type="picture-card" 
                                multiple
                                :on-preview="handlePictureCardPreview" 
                                :on-remove="handleRemove" 
                                :on-change="handleFileChange"
                                class="modern-upload"
                            >
                                <div class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-700 transition-colors duration-300">
                                    <svg class="w-8 h-8 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                    </svg>
                                    <span class="text-sm">Subir imagen</span>
                                </div>
                            </el-upload>
                        </div>
                    </div>

                    <!-- Imágenes existentes con diseño moderno -->
                    <div v-if="news_images && news_images.length > 0" class="space-y-2">
                        <label class="text-gray-700 text-sm font-medium">Imágenes actuales</label>
                        <div class="flex flex-wrap gap-4">
                            <div v-for="(dimage, index) in news_images" :key="dimage.id" class="group relative">
                                <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                    <img class="w-full h-full object-cover" :src="`/${dimage.image}`" alt="">
                                </div>
                                <button
                                    @click="deleteImage(dimage, index)"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-all duration-300 transform hover:scale-110"
                                >
                                    ×
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Botón submit moderno -->
                    <div class="flex justify-end pt-4">
                        <button 
                            type="submit"
                            class="group relative px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            <span class="relative flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                <span>{{ editMode ? 'Actualizar' : 'Crear' }}</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </el-dialog>

        <!-- Container principal con glassmorphism -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden">
                <!-- Header moderno -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-b border-gray-200 p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                        <!-- Título y búsqueda -->
                        <div class="space-y-4 lg:space-y-0 lg:flex lg:items-center lg:space-x-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800 mb-1">Gestión de Noticias</h1>
                                <p class="text-gray-600 text-sm">Administra el contenido de noticias</p>
                            </div>
                            
                            <!-- Buscador moderno -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text"
                                    class="w-full lg:w-80 bg-white border border-gray-300 rounded-xl pl-12 pr-4 py-3 text-gray-800 placeholder-gray-500 focus:bg-white focus:border-blue-500 focus:outline-none transition-all duration-300"
                                    placeholder="Buscar noticias..."
                                />
                            </div>
                        </div>

                        <!-- Botón añadir -->
                        <button 
                            @click="openAddModal"
                            class="group relative px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                </svg>
                                <span>Nueva Noticia</span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Tabla moderna -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-4 px-6 text-gray-600 font-medium text-sm uppercase tracking-wider">
                                    Noticia
                                </th>
                                <th class="text-left py-4 px-6 text-gray-600 font-medium text-sm uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="text-right py-4 px-6 text-gray-600 font-medium text-sm uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr 
                                v-for="(newsItem, index) in news" 
                                :key="newsItem.id"
                                class="group hover:bg-gray-50 transition-all duration-300"
                            >
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-gray-800 font-medium">{{ newsItem.title }}</h3>
                                            <p class="text-gray-500 text-sm mt-1">ID: {{ newsItem.id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span 
                                        v-if="newsItem.published == 0" 
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
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Botón editar -->
                                        <button
                                            @click="openEditModal(newsItem)"
                                            class="group/btn p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-all duration-300 hover:scale-110"
                                            title="Editar"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                            </svg>
                                        </button>
                                        
                                        <!-- Botón eliminar -->
                                        <button
                                            @click="deleteNews(newsItem, index)"
                                            class="group/btn p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-300 hover:scale-110"
                                            title="Eliminar"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación moderna -->
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                        <div class="text-sm text-gray-600">
                            Mostrando <span class="font-medium text-gray-800">1-10</span> de <span class="font-medium text-gray-800">1000</span> resultados
                        </div>
                        
                        <div class="flex items-center space-x-1">
                            <!-- Paginación -->
                            <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
                                </svg>
                            </button>
                            
                            <button class="px-3 py-2 text-sm bg-blue-100 text-blue-600 rounded-lg font-medium">1</button>
                            <button class="px-3 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all duration-300">2</button>
                            <button class="px-3 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all duration-300">3</button>
                            <span class="px-3 py-2 text-sm text-gray-400">...</span>
                            <button class="px-3 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all duration-300">100</button>
                            
                            <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
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
/* Estilos personalizados para el modal */
:deep(.el-dialog) {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 24px;
}

:deep(.el-dialog__header) {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 51, 234, 0.05));
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    padding: 24px;
    border-radius: 24px 24px 0 0;
}

:deep(.el-dialog__title) {
    color: #374151;
    font-size: 1.25rem;
    font-weight: 600;
}

:deep(.el-dialog__body) {
    padding: 0;
}

:deep(.el-dialog__close) {
    color: #6b7280;
    font-size: 20px;
}

:deep(.el-dialog__close:hover) {
    color: #374151;
}

/* Estilos para el upload moderno */
:deep(.el-upload--picture-card) {
    background: rgba(249, 250, 251, 1);
    border: 2px dashed rgba(209, 213, 219, 1);
    border-radius: 12px;
    width: 120px;
    height: 120px;
}

:deep(.el-upload--picture-card:hover) {
    border-color: rgba(59, 130, 246, 0.5);
    background: rgba(59, 130, 246, 0.05);
}

:deep(.el-upload-list--picture-card .el-upload-list__item) {
    background: rgba(249, 250, 251, 1);
    border: 1px solid rgba(209, 213, 219, 1);
    border-radius: 12px;
}

/* Animaciones suaves */
.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

/* Animaciones personalizadas */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Hover effects mejorados */
.group:hover {
    transform: translateY(-1px);
}

/* Focus states mejorados */
input:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Botones con efectos avanzados */
button:active {
    transform: scale(0.98);
}

/* Scrollbar personalizada */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.05);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.3);
}
</style>



