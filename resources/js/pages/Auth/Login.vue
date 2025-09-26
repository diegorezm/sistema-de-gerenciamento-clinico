<script setup lang="ts">
import { login } from '@/actions/App/Http/Controllers/Auth/AuthController';
import AppLayout from '@/layouts/AppLayout.vue';
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
    <AppLayout>
        <section class="mx-auto mt-16 max-w-md rounded bg-white p-6 shadow-md">
            <div class="mb-6 flex items-center justify-center gap-2">
                <img :src="Logo" class="size-8" />
                <h1 class="text-2xl font-bold">Entrar</h1>
            </div>
            <form @submit.prevent="submit" class="space-y-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input v-model="form.email" type="email" id="email" required class="mt-1 block w-full rounded border p-2" />
                    <span v-if="form.errors.email" class="text-sm text-red-600">
                        {{ form.errors.email }}
                    </span>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium">Senha</label>
                    <input v-model="form.password" type="password" id="password" required class="mt-1 block w-full rounded border p-2" />
                    <span v-if="form.errors.password" class="text-sm text-red-600">
                        {{ form.errors.password }}
                    </span>
                </div>

                <!-- Remember Me -->
                <label class="flex items-center space-x-2 text-sm">
                    <input type="checkbox" v-model="form.remember" />
                    <span>Lembrar</span>
                </label>

                <!-- Submit -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded bg-blue-600 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                >
                    Entrar
                </button>

                <p class="text-center text-sm text-gray-600">
                    Não tem conta?
                    <a href="/register" class="text-blue-600">Cadastrar</a>
                </p>
            </form>
        </section>
    </AppLayout>
</template>
