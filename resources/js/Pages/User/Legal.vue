<template>
  <UserLayouts>
  <div class="min-h-screen bg-gray-50 text-gray-800 px-6 py-12 max-w-5xl mx-auto space-y-12">
    <!-- Header -->
    <header class="text-center">
      <h1 class="text-4xl font-bold text-blue-600 mb-2">Información Legal</h1>
      <p class="text-sm text-gray-500">Última actualización: 18 de mayo de 2025</p>
    </header>

    <!-- Secciones legales -->
    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Términos y Condiciones</h2>
      <p class="text-sm leading-relaxed">
        Al acceder a nuestro sitio web o realizar una compra en Hoop Storm, aceptas nuestros términos de uso. Nos reservamos el derecho a modificar estos términos en cualquier momento sin previo aviso.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Política de Privacidad</h2>
      <p class="text-sm leading-relaxed">
        Respetamos tu privacidad. Solo recopilamos la información necesaria para procesar tus pedidos y mejorar tu experiencia. No compartimos tus datos con terceros sin tu consentimiento.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Devoluciones y Reembolsos</h2>
      <p class="text-sm leading-relaxed">
        Tienes 30 días desde la recepción del pedido para devolver un producto. El artículo debe estar sin usar, con etiquetas y en su empaque original. Para iniciar el proceso, contáctanos a devoluciones@hoopstorm.com.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Gestión de Pedidos</h2>
      <p class="text-sm leading-relaxed">
        Puedes revisar, modificar o cancelar tu pedido desde tu cuenta antes del envío. Una vez procesado, recibirás un número de seguimiento por correo electrónico.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Política de Cookies</h2>
      <p class="text-sm leading-relaxed">
        Este sitio utiliza cookies para ofrecerte una mejor experiencia. Al navegar, aceptas el uso de cookies según nuestra política. Puedes ajustar tus preferencias en cualquier momento desde tu navegador.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Reportar Falsificación</h2>
      <p class="text-sm leading-relaxed">
        Si encuentras productos falsificados usando nuestro nombre o logotipo, por favor notifícanos a legal@hoopstorm.com. Estamos comprometidos con la autenticidad.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-pink-600 mb-4">Esclavitud Moderna</h2>
      <p class="text-sm leading-relaxed">
        Hoop Storm está comprometida con prácticas éticas y el respeto a los derechos humanos. No toleramos ninguna forma de esclavitud moderna o trabajo forzoso en nuestra cadena de suministro.
      </p>
    </section>

   



  </div>
  
  </UserLayouts>
<Footer />
</template>

<script setup>
// No se requiere lógica JS en esta página estática
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import Footer from "../User/Layouts/Footer.vue";
import UserLayouts from "./Layouts/UserLayouts.vue";
</script>

<style scoped>
/* Estilo mínimo adicional si deseas personalizar títulos o márgenes */
</style>
