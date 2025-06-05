<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Iniciar sesión" />

        <div class="max-w-md mx-auto mt-10 space-y-6 bg-gray-900 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-white">Iniciar Sesión</h1>

            <div v-if="status" class="text-sm text-green-400 bg-green-900 border border-green-600 p-2 rounded">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- Email -->
                <div>
                    <InputLabel for="email" value="Correo electrónico" class="text-gray-300" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full bg-gray-800 text-white border border-gray-700"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError :message="form.errors.email" class="mt-1 text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <InputLabel for="password" value="Contraseña" class="text-gray-300" />
                    <TextInput
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="mt-1 block w-full bg-gray-800 text-white border border-gray-700"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <div class="text-sm mt-1">
                        <button type="button" class="text-blue-400 hover:underline" @click="showPassword = !showPassword">
                            {{ showPassword ? 'Ocultar' : 'Mostrar' }} contraseña
                        </button>
                    </div>
                    <InputError :message="form.errors.password" class="mt-1 text-red-400" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <Checkbox id="remember" v-model:checked="form.remember" />
                    <label for="remember" class="ms-2 text-sm text-gray-300">Recordarme</label>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row sm:justify-between items-center mt-4 gap-2">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-blue-400 hover:underline"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                    <Link :href="route('register')" class="text-sm text-gray-400 hover:underline">
                        ¿No tienes cuenta? Regístrate
                    </Link>
                </div>

                <PrimaryButton class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white" :disabled="form.processing">
                    Iniciar sesión
                </PrimaryButton>
            </form>
        </div>
    </GuestLayout>
</template>


