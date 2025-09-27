<script setup lang="ts">
import FormInput from '@/components/FormInput.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';

import { login } from '@/actions/App/Http/Controllers/Auth/AuthController';
import { useForm } from '@inertiajs/vue3';
import Logo from '../../../images/logo.svg';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.submit(login(), {
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
                <h1 class="text-2xl font-bold">Entrar</h1>
            </div>

            <!-- Login Form -->
            <form @submit.prevent="submit" class="space-y-4">
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

                <!-- Remember Me -->
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" v-model="form.remember" />
                    <span>Lembrar</span>
                </label>

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
                    Não tem conta?
                    <a href="/register" class="text-blue-600">Cadastrar</a>
                </p>
            </form>
        </main>
    </GuestLayout>
</template>
