<script setup>
import { computed, reactive, ref } from "vue";
import UserLayouts from "./Layouts/UserLayouts.vue";
import { router, usePage, Link } from "@inertiajs/vue3";

const props = defineProps({
    userAddress: Object,
});

const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);
const itemId = (id) => carts.value.findIndex((item) => item.product_id === id);

const form = reactive({
    address1: "",
    state: "",
    city: "",
    zipcode: "",
    country_code: "",
    type: "",
});

const loading = ref(false);
const showTestCards = ref(false);

const formFilled = computed(() =>
    Object.values(form).every((field) => field.trim() !== "")
);

// Tarjetas de prueba de Stripe
const testCards = [
    { number: "4242424242424242", description: "Visa - Pago exitoso" },
    { number: "5555555555554444", description: "Mastercard - Pago exitoso" },
    { number: "378282246310005", description: "American Express - Pago exitoso" }
];

const copyToClipboard = (text) => {
    navigator.clipboard.writeText(text).then(() => {
        // Aquí podrías mostrar un toast de confirmación
        console.log('Número copiado al portapapeles');
    });
};

const update = (product, quantity) =>
    router.patch(route("cart.update", product), { quantity });
const remove = (product) => router.delete(route("cart.delete", product));

function submit() {
    if (!usePage().props.auth.user) {
        router.visit(route("login"));
        return;
    }

    loading.value = true;
    router.visit(route("checkout.store"), {
        method: "post",
        data: {
            carts: carts.value,
            products: products.value,
            total: total.value,
            address: form,
        },
        onFinish: () => (loading.value = false),
    });
}
</script>

<template>
    <UserLayouts>
        <section
            class="relative bg-gradient-to-tr from-indigo-100 via-white to-purple-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 min-h-screen overflow-hidden transition-colors duration-500"
        >
            <div
                class="container mx-auto px-4 grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-10"
            >
                <!-- 🛒 CART LIST -->
                <div class="lg:col-span-2 space-y-6">
                    <h1 class="text-3xl font-extrabold text-indigo-700 mb-6">
                        🛒 Tu Carrito
                    </h1>

                    <div
                        v-if="products.length === 0"
                        class="text-center py-16 bg-white/60 rounded-2xl shadow-xl"
                    >
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">
                            Tu carrito está vacío
                        </h2>
                        <p class="text-gray-500 mb-4">
                            ¡Explora productos y añade algo que te guste!
                        </p>
                        <Link
                            :href="route('products.index')" 
                            class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-xl shadow-md transition-all"
                        >
                            Ir a la tienda
                        </Link>
                    </div>
                    <transition-group name="fade" tag="div">
                        <div
                            v-for="product in products"
                            :key="product.id"
                            class="bg-white/80 dark:bg-white/10 backdrop-blur-md rounded-2xl shadow-[0_4px_30px_rgba(0,0,0,0.05)] p-5 flex flex-col sm:flex-row items-center justify-between gap-4 hover:scale-[1.01] transition-all duration-300 ease-in-out"
                        >
                            <div class="flex gap-4 items-center">
                                <img
                                    :src="
                                        product.product_images.length
                                            ? `/${product.product_images[0].image}`
                                            : 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png'
                                    "
                                    class="w-20 h-20 object-cover rounded-xl border"
                                />
                                <div>
                                    <h2
                                        class="text-lg font-bold text-gray-800 dark:text-gray-100"
                                    >
                                        {{ product.title }}
                                    </h2>
                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        {{ product.price }} € 
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <button
                                    @click.prevent="
                                        update(
                                            product,
                                            carts[itemId(product.id)].quantity -
                                                1
                                        )
                                    "
                                    :disabled="
                                        carts[itemId(product.id)].quantity <= 1
                                    "
                                    class="h-8 w-8 flex items-center justify-center text-white bg-indigo-500 hover:bg-indigo-600 active:scale-95 disabled:opacity-50 rounded-full shadow-md transition-all"
                                >
                                    -
                                </button>

                                <input
                                    type="number"
                                    v-model.number="
                                        carts[itemId(product.id)].quantity
                                    "
                                    class="w-14 text-center border border-gray-300 dark:border-gray-600 rounded-md py-1 px-2 shadow-inner bg-white dark:bg-gray-700 text-black dark:text-white"
                                />

                                <button
                                    @click.prevent="
                                        update(
                                            product,
                                            carts[itemId(product.id)].quantity +
                                                1
                                        )
                                    "
                                    class="h-8 w-8 flex items-center justify-center text-white bg-indigo-500 hover:bg-indigo-600 active:scale-95 rounded-full shadow-md transition-all"
                                >
                                    +
                                </button>

                                <button
                                    @click="remove(product)"
                                    class="ml-4 text-red-500 hover:text-red-700 dark:hover:text-red-400 transition-colors"
                                >
                                    ✕
                                </button>
                            </div>
                        </div>
                    </transition-group>
                </div>

                <!-- 🧾 ORDER SUMMARY -->
                <div
                    class="bg-white/70 dark:bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 transition-all"
                >
                    <h2
                        class="text-2xl font-bold text-gray-800 dark:text-white mb-4"
                    >
                        🧾 Dirección Pedido
                    </h2>
                    <div
                        class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4"
                    >
                        Total:
                        <span class="text-indigo-600 dark:text-indigo-400"
                            >{{ total }} € </span
                        >
                    </div>

                    <!-- Información de tarjetas de prueba -->
                    <div class="mb-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-semibold text-amber-800 dark:text-amber-200 flex items-center">
                                ⚠️ Modo de Prueba
                            </h3>
                            <button 
                                @click="showTestCards = !showTestCards"
                                class="text-xs text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-200 transition-colors"
                            >
                                {{ showTestCards ? 'Ocultar' : 'Ver tarjetas de prueba' }}
                            </button>
                        </div>
                        <p class="text-xs text-amber-700 dark:text-amber-300 mb-2">
                            Esta tienda está en modo de prueba. Usa las tarjetas de prueba de Stripe para simular pagos.
                        </p>
                        
                        <div v-if="showTestCards" class="space-y-2 mt-3">
                            <div 
                                v-for="card in testCards" 
                                :key="card.number"
                                class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 rounded-lg border"
                            >
                                <div>
                                    <p class="text-xs font-mono text-gray-800 dark:text-gray-200">{{ card.number }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ card.description }}</p>
                                </div>
                                <button 
                                    @click="copyToClipboard(card.number)"
                                    class="text-xs px-2 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 rounded hover:bg-indigo-200 dark:hover:bg-indigo-800 transition-colors"
                                >
                                    Copiar
                                </button>
                            </div>
                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-2">
                                💡 Usa cualquier fecha futura y CVC (ej: 123)
                            </p>
                        </div>
                    </div>

                    <div
                        v-if="props.userAddress"
                        class="mb-6 text-sm text-gray-600 dark:text-gray-400"
                    >
                        <h3
                            class="text-md font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Shipping to:
                        </h3>
                        <p>
                            {{ props.userAddress.address1 }},
                            {{ props.userAddress.city }},
                            {{ props.userAddress.zipcode }}
                        </p>
                    </div>

                    <div v-if="!props.userAddress" class="space-y-4">
                        <input
                            v-model="form.address1"
                            placeholder="Dirección"
                            class="input-modern"
                        />
                        <input
                            v-model="form.city"
                            placeholder="Ciudad"
                            class="input-modern"
                        />
                        <input
                            v-model="form.state"
                            placeholder="Estado"
                            class="input-modern"
                        />
                        <input
                            v-model="form.zipcode"
                            placeholder="Codigo Postal"
                            class="input-modern"
                        />
                        <input
                            v-model="form.country_code"
                            placeholder="Siglas País"
                            class="input-modern"
                        />
                        <input
                            v-model="form.type"
                            placeholder="Tipo Dirección (trabajo, casa ...)"
                            class="input-modern"
                        />
                    </div>

                    <button
                        @click.prevent="submit"
                        :disabled="
                            products.length === 0 ||
                            !(formFilled || props.userAddress)
                        "
                        class="w-full mt-6 py-3 text-white bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 rounded-xl shadow-lg transition-all disabled:opacity-40"
                        :title="
                            products.length === 0
                                ? 'Tu carrito está vacío'
                                : !(formFilled || props.userAddress)
                                ? 'Por favor completa la dirección'
                                : ''
                        "
                    >
                        🚀 Proceder al checkout
                    </button>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>

<style scoped>
.input-modern {
    @apply w-full bg-white dark:bg-gray-800 text-black dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition-all;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s, transform 0.5s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(10px);
}
</style>