<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit" class="space-y-6 text-neutral-200 p-8 rounded-xl bg-neutral-900 shadow-xl animate-fade-in">
      <div>
        <h1 class="text-center font-bold ">REGISTRARSE</h1>
        <InputLabel for="name" value="Nombre" class="text-neutral-300" />
        <TextInput
          id="name"
          type="text"
          class="mt-2 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition duration-300"
          v-model="form.name"
          required
          autofocus
        />
        <InputError class="mt-1 text-red-400" :message="form.errors.name" />
      </div>

      <div>
        <InputLabel for="email" value="Email" class="text-neutral-300" />
        <TextInput
          id="email"
          type="email"
          class="mt-2 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition duration-300"
          v-model="form.email"
          required
        />
        <InputError class="mt-1 text-red-400" :message="form.errors.email" />
      </div>

      <div>
        <InputLabel for="password" value="Contraseña" class="text-neutral-300" />
        <TextInput
          id="password"
          type="password"
          class="mt-2 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition duration-300"
          v-model="form.password"
          required
        />
        <InputError class="mt-1 text-red-400" :message="form.errors.password" />
      </div>

      <div>
        <InputLabel for="password_confirmation" value="Confirmar Contraseña" class="text-neutral-300" />
        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-2 block w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition duration-300"
          v-model="form.password_confirmation"
          required
        />
        <InputError class="mt-1 text-red-400" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-between">
        <Link
          :href="route('login')"
          class="text-sm text-neutral-400 hover:text-white transition duration-300"
        >
          ¿Ya estás registrado?
        </Link>

        <PrimaryButton
          class="px-6 py-2 rounded-xl bg-gradient-to-r from-cyan-600 via-indigo-600 to-blue-700 text-white font-semibold shadow-md hover:shadow-cyan-500/40 transition-all duration-300 transform hover:scale-105"
          :disabled="form.processing"
          :class="{ 'opacity-25': form.processing }"
        >
          Crear cuenta
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
