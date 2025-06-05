<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'

defineProps({
    products: Array,
    pagination: Object
})

const goToPage = (page) => {
    router.get(route('admin.products.index', { page }), {}, {
        preserveState: true
    });
}

const brands = usePage().props.brands;
const categories = usePage().props.categories;

const isAddProduct = ref(false);
const editMode = ref(false);
const dialogVisible = ref(false)

//upload mulitpel images
const productImages = ref([])
const dialogImageUrl = ref('')
const handleFileChange = (file) => {
    console.log(file)
    productImages.value.push(file)
}

const handlePictureCardPreview = (file) => {
    dialogImageUrl.value = file.url
    dialogVisible.value = true
}

const handleRemove = (file) => {
    console.log(file)
}

//prodct from data
const id = ref('');
const title = ref('')
const price = ref('')
const quantity = ref('')
const description = ref('')
const product_images = ref([])
const published = ref('')
const category_id = ref('')
const brand_id = ref('')
const inStock = ref('')

const openEditModal = (product, index) => {
    console.log(product, index);
    //updatde data
    id.value = product.id;
    title.value = product.title;
    price.value = product.price;
    quantity.value = product.quantity;
    description.value = product.description;
    brand_id.value = product.brand_id;
    category_id.value = product.category_id;
    product_images.value = product.product_images;

    editMode.value = true;
    isAddProduct.value = false
    dialogVisible.value = true
}

//open add modal
const openAddModal = () => {
    isAddProduct.value = true
    dialogVisible.value = true
    editMode.value = false;
}

// add product method
const AddProduct = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('price', price.value);
    formData.append('quantity', quantity.value);
    formData.append('description', description.value);
    formData.append('brand_id', brand_id.value);
    formData.append('category_id', category_id.value);
    // Append product images to the FormData
    for (const image of productImages.value) {
        formData.append('product_images[]', image.raw);
    }

    try {
        await router.post('products/store', formData, {
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
    price.value = '';
    quantity.value = '';
    description.value = '';
    productImages.value = [];
    dialogImageUrl.value = ''
};

//delete sigal product image
const deleteImage = async (pimage, index) => {
    try {
        await router.delete('/admin/products/image/' + pimage.id, {
            onSuccess: (page) => {
                product_images.value.splice(index, 1);
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
const updateProduct = async () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('price', price.value);
    formData.append('quantity', quantity.value);
    formData.append('description', description.value);
    formData.append('category_id', category_id.value);
    formData.append('brand_id', brand_id.value);
    formData.append("_method", 'PUT');
    // Append product images to the FormData
    for (const image of productImages.value) {
        formData.append('product_images[]', image.raw);
    }

    try {
        await router.post('products/update/' + id.value, formData, {
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
const deleteProduct = (product, index) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'rounded-xl shadow-lg',
            title: 'text-lg font-semibold text-gray-800',
            htmlContainer: 'text-sm text-gray-600',
            confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md focus:outline-none',
            cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md focus:outline-none'
        },
        buttonsStyling: false,
        backdrop: true,
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                router.delete('products/destory/' + product.id, {
                    onSuccess: (page) => {
                        // Asegúrate que `delete` no depende de `this` si estás en función flecha.
                        deleteProductFromList(product, index);

                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            position: 'top-end',
                            title: page.props.flash.success || 'Producto eliminado correctamente',
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                popup: 'rounded-xl shadow-md bg-white text-gray-800 text-sm p-3'
                            }
                        });
                    }
                })
            } catch (err) {
                console.log(err)
            }
        }
    });
};

</script>

<template>
    <section class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 p-4 sm:p-6">
        <!-- Fondo con patrón geométrico sutil -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,0.1) 1px, transparent 0); background-size: 20px 20px;"></div>
        </div>
        
        <!-- Modal usando el-dialog pero con estilos modernos -->
        <el-dialog v-model="dialogVisible" 
                   :title="editMode ? 'Editar Producto' : 'Nuevo Producto'" 
                   width="800px"
                   :before-close="() => dialogVisible = false"
                   class="modern-dialog"
                   :modal-class="'modern-modal-backdrop'">
            
            <!-- Header personalizado -->
            <template #header>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                        {{ editMode ? 'Editar Producto' : 'Nuevo Producto' }}
                    </h3>
                </div>
            </template>

            <!-- Contenido del modal -->
            <form @submit.prevent="editMode ? updateProduct() : AddProduct()" class="space-y-6">
                    <!-- Título -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                            Título del Producto
                        </label>
                        <input v-model="title" type="text" required
                               class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder-slate-400"
                               placeholder="Ingresa el título del producto">
                    </div>

                    <!-- Precio y Cantidad -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                                Precio
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 text-lg">€</span>
                                </div>
                                <input v-model="price" type="text" required
                                       class="w-full pl-8 pr-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200"
                                       placeholder="0.00">
                            </div>
                        </div>
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                                Cantidad
                            </label>
                            <input v-model="quantity" type="number" required
                                   class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200"
                                   placeholder="0">
                        </div>
                    </div>

                    <!-- Categoría y Marca -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Categoría</label>
                            <select v-model="category_id" 
                                    class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Marca</label>
                            <select v-model="brand_id"
                                    class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                                    {{ brand.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                            Descripción
                        </label>
                        <textarea v-model="description" rows="4"
                                  class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder-slate-400 resize-none"
                                  placeholder="Describe el producto..."></textarea>
                    </div>

                    <!-- Upload de imágenes -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-4">Imágenes del Producto</label>
                        <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 bg-slate-50/50 hover:bg-slate-100/50 transition-colors">
                            <el-upload v-model:file-list="productImages" list-type="picture-card" multiple
                                       :on-preview="handlePictureCardPreview" :on-remove="handleRemove"
                                       :on-change="handleFileChange"
                                       class="upload-modern">
                                <div class="flex flex-col items-center justify-center text-slate-500">
                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="text-sm font-medium">Agregar imagen</span>
                                </div>
                            </el-upload>
                        </div>
                    </div>

                    <!-- Imágenes existentes -->
                    <div v-if="product_images && product_images.length > 0" class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">Imágenes Actuales</label>
                        <div class="flex flex-wrap gap-3">
                            <div v-for="(pimage, index) in product_images" :key="pimage.id" 
                                 class="relative group">
                                <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 border-2 border-slate-200">
                                    <img class="w-full h-full object-cover" :src="`/${pimage.image}`" alt="">
                                </div>
                                <button @click="deleteImage(pimage, index)" type="button"
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xs font-bold transition-colors duration-200 opacity-0 group-hover:opacity-100">
                                    ×
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-200">
                        <button type="button" @click="dialogVisible = false"
                                class="px-6 py-3 text-slate-600 hover:text-slate-800 font-semibold transition-colors duration-200">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ editMode ? 'Actualizar' : 'Crear' }} Producto
                        </button>
                    </div>
                </form>
        </el-dialog>

        <!-- Contenido principal -->
        <div class="relative max-w-7xl mx-auto">
            <!-- Header mejorado -->
            <div class="mb-8">
                <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl border border-white/20 p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-900 via-blue-800 to-purple-800 bg-clip-text text-transparent">
                                Gestión de Productos
                            </h1>
                            <p class="text-slate-600 mt-1">Administra tu inventario de manera eficiente</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <!-- Buscador mejorado -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" placeholder="Buscar productos..."
                                       class="w-full sm:w-80 pl-12 pr-4 py-3 bg-white/70 border-2 border-slate-200/50 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder-slate-400">
                            </div>
                            
                            <!-- Botón agregar mejorado -->
                            <button @click="openAddModal" type="button"
                                    class="group flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nuevo Producto
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla mejorada -->
            <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl border border-white/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200/50">
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Categoría</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Marca</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/50">
                            <tr v-for="(product, index) in products" :key="product.id" 
                                class="hover:bg-slate-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">{{ product.title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ product.category.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                        {{ product.brand.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-slate-700">{{ product.quantity }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-green-600">{{ product.price }} € </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span v-if="product.inStock == 0"
                                          class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-800 rounded-full">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                        En Stock
                                    </span>
                                    <span v-else
                                          class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">
                                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                        Sin Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button v-if="product.published == 0" type="button"
                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full hover:bg-green-200 transition-colors">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                        Publicado
                                    </button>
                                    <button v-else type="button"
                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full hover:bg-orange-200 transition-colors">
                                        <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                                        No Publicado
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button @click="openEditModal(product, index)"
                                                class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button @click="deleteProduct(product, index)"
                                                class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación mejorada -->
                <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-t border-slate-200/50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-600">
                            Mostrando <span class="font-semibold text-slate-900">1-10</span> de 
                            <span class="font-semibold text-slate-900">1000</span> productos
                        </div>
                        <!-- Aquí puedes agregar la lógica de paginación comentada -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
    <style scoped>
    /* Animaciones personalizadas */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .upload-modern :deep(.el-upload-list--picture-card .el-upload-list__item) {
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .upload-modern :deep(.el-upload-list--picture-card .el-upload-list__item:hover) {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .upload-modern :deep(.el-upload--picture-card) {
        border-radius: 12px;
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        transition: all 0.2s ease;
    }

    .upload-modern :deep(.el-upload--picture-card:hover) {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    </style>
