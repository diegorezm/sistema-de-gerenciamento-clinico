<script setup lang="ts">
import { User } from '@/types';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Logo from '../../images/logo.svg';

const { user } = defineProps<{
    user?: User;
}>();

const links = ref([
    { title: 'Principal', href: '/' },
    { title: 'Sobre', href: '/#sobre' },
    { title: 'Funcionalidades', href: '/#funcionalidades' },
    { title: 'Planos', href: '/#planos' },
    { title: 'Contato', href: '/#contato' },
]);
</script>

<template>
    <header class="bg-white px-4 py-2 shadow">
        <nav class="flex items-center justify-between">
            <!-- Logo -->
            <div>
                <a href="/">
                    <img :src="Logo" class="size-9" alt="SGC" />
                </a>
            </div>

            <!-- Navigation -->
            <ul class="flex gap-1">
                <li v-for="link in links" :key="link.title">
                    <Link :href="link.href" class="btn btn-sm btn-ghost">
                        {{ link.title }}
                    </Link>
                </li>
            </ul>

            <!-- Auth Buttons -->
            <template v-if="!user">
                <div class="space-x-1">
                    <Link href="/login" class="btn btn-sm btn-primary">Entrar</Link>
                    <Link href="/register" class="btn btn-sm btn-outline">Cadastrar</Link>
                </div>
            </template>

            <template v-else>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700">Olá, {{ user?.name }}</span>
                    <Link href="/logout" method="post" as="button" class="btn btn-sm btn-outline"> Sair </Link>
                </div>
            </template>
        </nav>
    </header>
</template>
