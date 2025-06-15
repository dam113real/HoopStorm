<template class="">
    <UserLayouts>
        <main class="min-h-screen bg-gray-50">
            <!-- Hero Section con video de fondo -->
            <section class="relative h-screen overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <video
                        class="w-full h-full object-cover"
                        autoplay
                        loop
                        muted
                        playsinline
                    >
                        <source
                            src="/basket/home/homebackground.mp4"
                            type="video/mp4"
                        />
                    </video>
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>

                <div
                    class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4"
                >
                    <h1
                        class="text-5xl md:text-7xl font-bold text-white mb-6 transition-all duration-700 transform translate-y-0 opacity-100"
                        v-motion
                        :initial="{ opacity: 0, y: 100 }"
                        :enter="{
                            opacity: 1,
                            y: 0,
                            transition: { delay: 200, duration: 800 },
                        }"
                    >
                        DOMINA LA CANCHA
                    </h1>
                    <p
                        class="text-xl md:text-2xl text-white mb-8 max-w-2xl"
                        v-motion
                        :initial="{ opacity: 0 }"
                        :enter="{
                            opacity: 1,
                            transition: { delay: 600, duration: 800 },
                        }"
                    >
                        Equípate con lo mejor para llevar tu juego al siguiente
                        nivel
                    </p>
                    <div
                        v-motion
                        :initial="{ opacity: 0, y: 50 }"
                        :enter="{
                            opacity: 1,
                            y: 0,
                            transition: { delay: 1000, duration: 600 },
                        }"
                    >
                        <!-- <router-link to="/tienda" class="inline-block bg-orange-500 text-white font-bold py-3 px-8 rounded-full hover:bg-orange-600 transform hover:scale-105 transition-all duration-300 mr-4">
            COMPRAR AHORA
          </router-link>
          <router-link to="/atletas" class="inline-block bg-transparent text-white font-bold py-3 px-8 rounded-full border-2 border-white hover:bg-white hover:text-black transform hover:scale-105 transition-all duration-300">
            CONOCE A LOS ATLETAS
          </router-link>
          <router-link to="/tienda" class="inline-block bg-orange-500 text-white font-bold py-3 px-8 rounded-full hover:bg-orange-600 transform hover:scale-105 transition-all duration-300 mx-4">
            COMPRAR AHORA
          </router-link> -->
                    </div>
                </div>
            </section>

            <section
                class="relative py-24 px-4 bg-gradient-to-br from-gray-950 via-black to-gray-900 text-white"
            >
                <div class="container mx-auto">
                    <h2
                        class="text-5xl font-extrabold text-center mb-20 tracking-tight"
                        data-aos="fade-down"
                    >
                        Productos
                        <span
                            class="text-orange-500 drop-shadow-[0_0_5px_#f97316]"
                            >Top</span
                        >
                        Baloncesto
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div
                            v-for="product in products"
                            :key="product.id"
                            class="bg-gradient-to-tr from-gray-900/90 via-gray-800 to-gray-900 backdrop-blur-xl rounded-3xl border border-orange-500/20 shadow-2xl shadow-orange-500/10 hover:shadow-orange-500/30 transition-all transform hover:scale-[1.02] hover:rotate-[0.2deg] duration-300 group relative overflow-hidden"
                            data-aos="zoom-in-up"
                        >
                            <img
                                :src="product.image"
                                :alt="product.name"
                                class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105"
                            />

                            <div class="p-6">
                                <span
                                    class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full mb-3 shadow-md shadow-orange-500/30"
                                >
                                    {{ product.category }}
                                </span>

                                <h3
                                    class="text-xl font-bold mb-2 tracking-tight"
                                >
                                    {{ product.name }}
                                </h3>
                                <p
                                    class="text-gray-300 text-sm mb-4 leading-relaxed"
                                >
                                    {{ product.description }}
                                </p>

                                <div class="flex justify-between items-center">
                                    <p
                                        class="text-orange-400 font-bold text-xl"
                                    >
                                        {{ product.price }}€
                                    </p>
                                    <div class="flex gap-1">
                                        <svg
                                            v-for="i in 5"
                                            :key="i"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 transition-all duration-200"
                                            :class="{
                                                'text-yellow-400 scale-110':
                                                    i <= product.rating,
                                                'text-gray-600':
                                                    i > product.rating,
                                            }"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                            />
                                        </svg>
                                    </div>
                                </div>

                                <div
                                    class="mt-6 flex justify-between items-center"
                                >
                                    <Link
                                        :href="route('products.index')"
                                        class="text-orange-400 text-sm font-medium hover:underline underline-offset-4"
                                    >
                                        Ver detalles
                                    </Link>
                                    <Link :href="route('products.index')">
                                        <button
                                            class="bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600 transition shadow-lg shadow-orange-400/30"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path
                                                    d="M6 6h15l-1.5 9h-13.5l-1.5-9zm0 0l-2-4h-2"
                                                />
                                                <circle cx="9" cy="21" r="1" />
                                                <circle cx="20" cy="21" r="1" />
                                            </svg>
                                        </button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-20">
                        <Link
                            :href="route('products.index')"
                            class="bg-orange-500 text-white font-semibold py-4 px-10 rounded-full shadow-lg shadow-orange-400/30 hover:bg-orange-600 transition-all hover:scale-105"
                        >
                            Ver toda la tienda
                        </Link>
                    </div>
                </div>
            </section>

            <section class="py-20 px-4 bg-white relative overflow-hidden">
                <!-- Esferas decorativas -->
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-orange-500 rounded-full opacity-10 blur-3xl mix-blend-multiply animate-pulse"
                    v-motion
                    :initial="{ scale: 0 }"
                    :visible="{ scale: 1, transition: { duration: 800 } }"
                ></div>
                <div
                    class="absolute -bottom-32 -left-32 w-96 h-96 bg-blue-500 rounded-full opacity-10 blur-3xl mix-blend-multiply animate-pulse"
                    v-motion
                    :initial="{ scale: 0 }"
                    :visible="{
                        scale: 1,
                        transition: { duration: 800, delay: 200 },
                    }"
                ></div>

                <!-- Contenido principal -->
                <div class="container mx-auto relative z-10">
                    <!-- TÍTULO -->
                    <div class="px-6 py-2 rounded-xl mb-10">
                        <h2
                            class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 drop-shadow-md text-center"
                        >
                            NUESTROS ATLETAS
                        </h2>
                    </div>

                    <!-- TARJETAS -->
                    <div class="flex flex-wrap justify-center gap-10">
                        <div
                            v-for="(athlete, index) in athletes"
                            :key="index"
                            class="w-full md:w-1/2 lg:w-1/3 max-w-sm"
                            v-motion
                            :initial="{ opacity: 0, y: 50 }"
                            :visible="{
                                opacity: 1,
                                y: 0,
                                transition: { delay: index * 200 },
                            }"
                        >
                            <div
                                class="group relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-orange-500/30 transition duration-300 hover:scale-[1.02] transform"
                            >
                                <div class="relative h-96 overflow-hidden">
                                    <img
                                        :src="athlete.image"
                                        :alt="athlete.name"
                                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                    />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"
                                    ></div>
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 p-6 text-white"
                                >
                                    <h3 class="text-2xl font-bold mb-1">
                                        {{ athlete.name }}
                                    </h3>
                                    <p
                                        class="text-orange-400 font-semibold mb-2"
                                    >
                                        {{ athlete.position }}
                                    </p>
                                    <p class="text-gray-300 mb-4 line-clamp-2">
                                        {{ athlete.bio }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTÓN -->
                    <div class="text-center mt-14">
                        <Link
                            :href="route('atlethes.index')"
                            class="inline-block bg-gradient-to-r from-orange-500 to-pink-500 hover:from-pink-500 hover:to-orange-500 text-white font-bold py-3 px-10 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                        >
                            CONOCE A TODOS LOS ATLETAS
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Banner Tecnológico Futurista Mejorado -->
            <section
                class="relative bg-gradient-to-br from-gray-900 via-black to-gray-800 py-20 px-6 overflow-hidden text-white"
            >
                <!-- Fondos decorativos animados -->
                <div
                    class="absolute -top-32 -left-32 w-96 h-96 bg-orange-500 opacity-30 rounded-full blur-3xl animate-pulse-slow z-0"
                ></div>
                <div
                    class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-600 opacity-30 rounded-full blur-3xl animate-pulse-slow z-0"
                ></div>

                <div
                    class="container mx-auto relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center"
                >
                    <!-- Texto -->
                    <div
                        v-motion
                        :initial="{ opacity: 0, x: -80 }"
                        :visible="{
                            opacity: 1,
                            x: 0,
                            transition: { duration: 700 },
                        }"
                    >
                        <h2
                            class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6"
                        >
                            <span class="text-orange-500">TECNOLOGÍA</span> QUE
                            TRANSFORMA <br />
                            TU RENDIMIENTO
                        </h2>
                        <p class="text-gray-300 text-lg mb-8 max-w-xl">
                            Desde tejidos inteligentes hasta suelas con
                            propulsión reactiva, nuestra tecnología está
                            diseñada para romper límites. Juega más rápido, más
                            fuerte, más lejos.
                        </p>
                        <a
                            href="https://www.catapult.com/es/deportes/baloncesto"
                            target="_blank"
                            class="inline-flex items-center gap-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg transition-all transform hover:scale-105"
                        >
                            Descúbrela
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                />
                            </svg>
                        </a>
                    </div>

                    <!-- Imagen con efecto holograma y animación -->
                    <div
                        class="relative rounded-3xl overflow-hidden shadow-2xl group bg-white/10 backdrop-blur-md border border-white/20"
                        v-motion
                        :initial="{ opacity: 0, scale: 0.9 }"
                        :visible="{
                            opacity: 1,
                            scale: 1,
                            transition: { duration: 700, delay: 200 },
                        }"
                    >
                        <div class="relative h-80 w-full overflow-hidden">
                            <img
                                src="/basket/home/futuro.jpg"
                                alt="Tecnología deportiva"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                            />

                            <!-- Animación holográfica -->
                            <div
                                class="absolute inset-0 z-10 pointer-events-none"
                            >
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 via-pink-500/10 to-transparent animate-hologram-effect mix-blend-screen"
                                ></div>
                            </div>

                            <!-- Overlay gradiente para profundidad -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent z-10"
                            ></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Últimas Noticias con Efecto Slider -->
            <section class="py-16 px-4 bg-gray-100">
                <div class="container mx-auto">
                    <h2
                        class="text-4xl font-bold text-center text-gray-900 mb-16 relative overflow-hidden"
                    >
                        <span class="inline-block relative">
                            ÚLTIMAS NOTICIAS
                            <span
                                class="absolute bottom-0 left-0 w-full h-1 bg-orange-500 transform origin-left"
                            ></span>
                        </span>
                    </h2>

                    <div class="relative">
                        <button
                            @click="slideNews('prev')"
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 bg-white p-2 rounded-full shadow-lg z-10 hidden md:block focus:outline-none hover:bg-gray-100 transition-colors"
                            aria-label="Noticia anterior"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-gray-700"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </button>

                        <div class="overflow-hidden">
                            <div
                                class="flex transition-transform duration-500 ease-out"
                                :style="{
                                    transform: `translateX(-${
                                        newsActiveSlide * 100
                                    }%)`,
                                }"
                            >
                                <div
                                    v-for="(news, index) in latestNews"
                                    :key="index"
                                    class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4"
                                >
                                    <div
                                        class="bg-white rounded-xl shadow-lg overflow-hidden h-full transform hover:-translate-y-1 transition-all duration-300"
                                    >
                                        <div
                                            class="relative h-48 overflow-hidden"
                                        >
                                            <img
                                                :src="news.image"
                                                :alt="news.title"
                                                class="w-full h-full object-cover"
                                            />
                                            <div
                                                class="absolute top-4 left-4 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded"
                                            >
                                                {{ news.category }}
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <div
                                                class="flex items-center text-gray-500 text-sm mb-3"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 mr-1"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                    />
                                                </svg>
                                                {{ news.date }}
                                            </div>
                                            <h3
                                                class="text-xl font-bold text-gray-900 mb-3"
                                            >
                                                {{ news.title }}
                                            </h3>
                                            <p
                                                class="text-gray-600 mb-4 line-clamp-3"
                                            >
                                                {{ news.excerpt }}
                                            </p>
                                            <Link
                                                :href="route('news.index')"
                                                class="text-orange-500 font-semibold hover:text-orange-700 transition-colors inline-flex items-center"
                                            >
                                                Leer más
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 ml-1"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                              </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            @click="slideNews('next')"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 bg-white p-2 rounded-full shadow-lg z-10 hidden md:block focus:outline-none hover:bg-gray-100 transition-colors"
                            aria-label="Siguiente noticia"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-gray-700"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-center mt-8 space-x-2">
                        <button
                            v-for="(_, index) in Math.ceil(
                                latestNews.length / 3
                            )"
                            :key="index"
                            @click="newsActiveSlide = index"
                            class="w-3 h-3 rounded-full transition-colors duration-300"
                            :class="
                                newsActiveSlide === index
                                    ? 'bg-orange-500'
                                    : 'bg-gray-300'
                            "
                            :aria-label="`Ir a la diapositiva ${index + 1}`"
                        ></button>
                    </div>

                    <div class="text-center mt-12">
                        <Link
                            :href="route('news.index')"
                            class="inline-block bg-transparent text-gray-900 font-bold py-3 px-8 rounded-full border-2 border-gray-900 hover:bg-gray-900 hover:text-white transform hover:scale-105 transition-all duration-300"
                        >
                            VER TODAS LAS NOTICIAS
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Instagram Gallery -->
            <section class="py-16 px-4 bg-white">
                <div class="container mx-auto">
                    <h2
                        class="text-4xl font-bold text-center text-gray-900 mb-6"
                    >
                        <span class="inline-block relative">
                            MOMENTOS PARA RECORDAR
                        </span>
                    </h2>
                    <p
                        class="text-center text-gray-600 mb-12 max-w-2xl mx-auto"
                    >
                        Síguenos en Instagram y comparte tus momentos con
                        nuestros productos
                    </p>

                    <div
                        class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2"
                    >
                        <div
                            v-for="(post, index) in instagramPosts"
                            :key="index"
                            class="relative overflow-hidden group aspect-square"
                            v-motion
                            :initial="{ opacity: 0, scale: 0.8 }"
                            :visible="{
                                opacity: 1,
                                scale: 1,
                                transition: {
                                    delay: index * 100,
                                    duration: 500,
                                },
                            }"
                        >
                            <img
                                :src="post.image"
                                :alt="`Instagram post ${index + 1}`"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-80 transition-opacity duration-300 flex items-end justify-center p-4"
                            >
                                <div
                                    class="text-white text-center transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                >
                                    <div
                                        class="flex justify-center space-x-4 mb-2"
                                    >
                                        <span class="flex items-center">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ post.likes }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ post.comments }}
                                        </span>
                                    </div>
                                    <p class="text-sm">{{ post.caption }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <a
                            href="https://www.instagram.com/baloncestoesp/?hl=es"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center text-gray-900 font-bold hover:text-orange-500 transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 mr-2"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                />
                            </svg>
                            @baloncestoesp
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </UserLayouts>
    <Footer />
</template>

<script>
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import Footer from "../User/Layouts/Footer.vue";
import UserLayouts from "./Layouts/UserLayouts.vue";
import Products from "../User/Components/Products.vue";

export default {
    name: "HomePage",
    components: {
        Link,
        UserLayouts,
        Footer,
    },
    // props: {
    //   products: {
    //     type: Array,
    //     default: () => []
    //   }
    // },
    setup(props) {
        // Secciones de productos según ID
        // const section1Products = ref([]);
        // const section2Products = ref([]);
        // const section3Products = ref([]);
        // const section4Products = ref([]);

        // if (props.products.length) {
        //   section1Products.value = props.products.filter(p => p.id === 1);
        //   section2Products.value = props.products.filter(p => p.id === 13);
        //   section3Products.value = props.products.filter(p => p.id === 25);
        //   section4Products.value = props.products.filter(p => p.id === 37);
        // }

        // Productos destacados
        const products = ref([
            {
                id: 1,
                name: "Zapatillas Air Max Dunk",
                category: "Calzado",
                description:
                    "Edición especial para cancha y calle. Comodidad máxima y diseño icónico.",
                image: "/basket/ropa/23/1.webp",
                price: 120,
                rating: 5,
            },
            {
                id: 2,
                name: "Pantalones FlexFit Pro",
                category: "Ropa",
                description:
                    "antalón de entrenamiento con tejido transpirable y ajuste cómodo, perfecto para correr, gym o uso casual.",
                image: "/basket/ropa/9/1.png",
                price: 35,
                rating: 4,
            },
            {
                id: 3,
                name: "Bolsa Deportiva UltraGear",
                category: "Accesorios",
                description:
                    "Bolsa espaciosa con compartimento principal, bolsillo para calzado ventilado y correa ajustable acolchada. Ideal para gym, viajes o actividades deportivas.",
                image: "/basket/ropa/34/1.png",
                price: 60,
                rating: 5,
            },
        ]);

        // Atletas destacados
        const athletes = ref([
            {
                id: 1,
                name: "Alba Torrens",
                position: "Base · 1,88m",
                bio: "Jugadora profesional con experiencia internacional. Destacado por su velocidad y precisión en el tiro exterior.",
                image: "/basket/home/alba.jpeg",
            },
            {
                id: 2,
                name: "Javier Calvo",
                position: "Escolta · 1,82m",
                bio: "Campeon nacional con una técnica impecable. Su capacidad defensiva la convierte en una jugador completo.",
                image: "/basket/home/yebi.jpeg",
            },
            {
                id: 3,
                name: "Mariona Ortiz",
                position: "Ala-pívot · 2,05m",
                bio: "Potencia y dominio bajo el aro. Su capacidad de rebote y bloqueo le han valido múltiples reconocimientos.",
                image: "/basket/home/mariona.jpg",
            },
        ]);

        // Noticias recientes
        const latestNews = ref([
            {
                id: 1,
                title: "Kevin Durant decide cuál es su siguiente destino preferido: no es Barcelona",
                excerpt:
                    "Kevin Durant ya tiene claro cuál es su destino preferido este verano, en el que será traspasado con toda seguridad por los Phoenix Suns. Todavía lejana la posibilidad de jugar la Euroliga -el Barça es una de las opciones que maneja-, la estrella de 36 años se decantaría por los San Antonio Spurs de Victor Wembanyama.",
                date: "15 febrero, 2025",
                image: "/basket/noticias/suns.jpg",
            },
            {
                id: 2,
                title: "España gana a Portugal para seguir adelante con su preparación",
                excerpt:
                    "La selección española femenina de baloncesto venció este martes a Portugal (59-68) en un partido de preparación para el Eurobasket 2025 disputado en la localidad lusa de Viana do Castelo en el que, tras un gran arranque, logró superar sus dudas del segundo y tercer cuarto para terminar imponiendo su mayor calidad en el tramo final del choque.",
                date: "10 mayo, 2025",
                image: "/basket/noticias/chicas.webp",
            },
            {
                id: 3,
                title: "La NBA anuncia que Mavericks y Pistons jugarán en México el 1 de noviembre",
                excerpt:
                    "La NBA anunció este martes que Dallas Mavericks y Detroit Pistons jugarán el NBA Mexico City Game 2025 en la Arena Ciudad de México el 1 de noviembre.",
                date: "5 abril, 2025",
                image: "/basket/noticias/1.jpeg",
            },
            {
                id: 4,
                title: "Los Lakers intentan reunir a Doncic con un excompañero para ganar músculo",
                excerpt:
                    "Tras su decepcionante eliminación en la primera ronda de los playoffs ante los Wolves (1-4), los Lakers trabajan ya en la planificación de la próxima temporada, y tienen muy claro que uno de sus puntos débiles esta campaña ha sido el juego interior, sin un pívot de referencia para complementar a su potente perímetro con LeBron James, Luka Doncic y Austin Reaves.",
                date: "1 enero, 2025",
                image: "/basket/noticias/doncic.webp",
            },
            {
                id: 5,
                title: "🏀 Último segundo, gloria total: el punto que cambió el destino del partido",
                excerpt:
                    "En una noche de tensión absoluta, con el marcador empatado y el cronómetro marcando los últimos segundos, todo se redujo a una sola jugada. La afición contenía la respiración mientras el balón viajaba en el aire.",
                date: "28 abril, 2025",
                image: "/basket/noticias/2.jpg",
            },
            {
                id: 6,
                title: "Victoria agónica de los Raptors en tiempo extra ante los Warriors",
                excerpt:
                    "En un partido lleno de emoción y dramatismo, los Toronto Raptors se impusieron 112-109 a los Golden State Warriors en tiempo extra. Con una actuación estelar de Scottie Barnes, quien anotó 28 puntos y capturó 10 rebotes, los Raptors lograron remontar en los últimos minutos. Stephen Curry intentó forzar la remontada con 6 triples, pero una defensa férrea en los segundos finales selló la victoria para Toronto.",
                date: "6 junio, 2025",
                image: "/basket/noticias/1.jpg",
            },
        ]);

        // Instagram
        const instagramPosts = ref([
            {
                image: "/basket/home/1.webp",
                likes: 1248,
                comments: 43,
                caption: "Estrenando las nuevas Air Zoom GT ",
            },
            {
                image: "/basket/home/2.webp",
                likes: 973,
                comments: 28,
                caption: "Comienzan las reformas!!! ",
            },
            {
                image: "/basket/home/2.png",
                likes: 1502,
                comments: 67,
                caption: "Nuevas sensaciones con la naturaleza ",
            },
            {
                image: "/basket/home/2.jpg",
                likes: 843,
                comments: 19,
                caption: "Atardecer perfecto para un partido",
            },
            {
                image: "/basket/home/1.jpg",
                likes: 1105,
                comments: 34,
                caption: "Detalles que marcan la diferencia",
            },
            {
                image: "/basket/home/3.jpg",
                likes: 762,
                comments: 22,
                caption: "Preparados para el gran torneo del fin de semana",
            },
        ]);

        // Referencias y comportamiento de la vista
        const newsActiveSlide = ref(0);
        const showVideoModal = ref(false);
        const productsSection = ref(null);

        const slideNews = (direction) => {
            const totalSlides = Math.ceil(latestNews.value.length / 3);
            if (direction === "next") {
                newsActiveSlide.value =
                    (newsActiveSlide.value + 1) % totalSlides;
            } else {
                newsActiveSlide.value =
                    (newsActiveSlide.value - 1 + totalSlides) % totalSlides;
            }
        };

        const scrollToProducts = () => {
            if (productsSection.value) {
                productsSection.value.scrollIntoView({ behavior: "smooth" });
            }
        };

        const handleMouseMove = (e) => {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const mouseX = e.clientX - centerX;
            const mouseY = e.clientY - centerY;
            const rotateX = (mouseY / (rect.height / 2)) * -5;
            const rotateY = (mouseX / (rect.width / 2)) * 5;
            card.querySelector(
                "div"
            ).style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        };

        const handleMouseLeave = (e) => {
            e.currentTarget.querySelector("div").style.transform =
                "rotateX(0) rotateY(0)";
        };

        const subscribeNewsletter = () => {
            alert("¡Gracias por suscribirte a nuestro newsletter!");
        };

        // Carrusel automático
        onMounted(() => {
            const carousel = document.getElementById("carousel");
            if (carousel) {
                const items = carousel.querySelectorAll(".card-item");
                if (items.length > 0) {
                    const itemWidth = items[0].offsetWidth + 24;
                    let index = 0;
                    setInterval(() => {
                        index = (index + 1) % items.length;
                        const offset = index * itemWidth;
                        carousel.style.transform = `translateX(-${offset}px)`;
                    }, 2000);
                }
            }
        });

        return {
            // section1Products,
            // section2Products,
            // section3Products,
            // section4Products,
            // featuredProducts,
            athletes,
            latestNews,
            instagramPosts,
            newsActiveSlide,
            showVideoModal,
            products,
            // productsSection,
            slideNews,
            scrollToProducts,
            handleMouseMove,
            handleMouseLeave,
            subscribeNewsletter,
        };
    },
};
</script>

<style scoped>
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
    opacity: 0;
}

.delay-200 {
    animation-delay: 0.2s;
}

/* Estilos para las transiciones y animaciones */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Estilos para el efecto 3D de las tarjetas */
.perspective {
    perspective: 1000px;
}
.transform-style-3d {
    transform-style: preserve-3d;
}

/* Estilos para truncar texto */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Estilo para el aspect ratio de videos e imágenes */
.aspect-w-16 {
    position: relative;
    padding-bottom: 56.25%;
}
.aspect-h-9 {
    position: relative;
}
.aspect-w-16 > *,
.aspect-h-9 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

/* Estilo para el aspect-square */
.aspect-square {
    position: relative;
    padding-bottom: 100%;
}
.aspect-square > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

/* Animación para el botón de bounce */
@keyframes bounce {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}
.animate-bounce {
    animation: bounce 1s infinite;
}

/* Efecto de subrayado animado en los títulos */
h2 span span {
    transform: scaleX(0);
    transition: transform 0.6s;
}
h2:hover span span {
    transform: scaleX(1);
}

/* Animación will-change para mejorar el rendimiento */
.will-change-transform {
    will-change: transform;
}

@keyframes hologram {
    0%,
    100% {
        transform: translateY(0) scale(1);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-10px) scale(1.02);
        opacity: 1;
    }
}

.animate-hologram-effect {
    animation: hologram 6s ease-in-out infinite;
}
</style>
