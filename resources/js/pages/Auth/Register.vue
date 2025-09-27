<script setup lang="ts">
import FormInput from '@/components/FormInput.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';

import { register } from '@/actions/App/Http/Controllers/Auth/AuthController';
import { useForm } from '@inertiajs/vue3';
import Logo from '../../../images/logo.svg';

const form = useForm({
    name: '',
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.submit(register(), {
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <GuestLayout>
        <main class="mx-auto mt-16 w-full max-w-md rounded bg-white p-6 shadow-md">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-center gap-2">
                <img :src="Logo" class="size-8" />
                <h1 class="text-2xl font-bold">Registrar</h1>
            </div>

            <!-- Login Form -->
            <form @submit.prevent="submit" class="space-y-4">
                <FormInput id="name" label="Name" type="text" placeholder="Digite seu nome" v-model="form.name" :error="form.errors.name" />

                <!-- Email -->
                <FormInput id="email" label="Email" type="email" placeholder="Digite seu email" v-model="form.email" :error="form.errors.email" />

                <!-- Password -->
                <FormInput
                    id="password"
                    label="Senha"
                    type="password"
                    placeholder="Digite sua senha"
                    v-model="form.password"
                    :error="form.errors.password"
                />

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded bg-blue-600 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                >
                    Entrar
                </button>

                <!-- Footer -->
                <p class="text-center text-sm text-gray-600">
                    Já tem uma conta?
                    <a href="/login" class="text-blue-600">Entrar</a>
                </p>
            </form>
        </main>
    </GuestLayout>
</template>
