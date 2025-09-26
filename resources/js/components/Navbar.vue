<script setup lang="ts">
import { ref } from 'vue';
import Logo from '../../images/logo.svg';

const links = ref([
    {
        title: 'Principal',
        href: '/',
    },
    {
        title: 'Sobre',
        href: '/#sobre',
    },
    {
        title: 'Funcionalidades',
        href: '/#funcionalidades',
    },
    {
        title: 'Planos',
        href: '/#planos',
    },
    {
        title: 'Contato',
        href: '/#contato',
    },
]);
</script>

<template>
    <header class="bg-white px-4 py-2 shadow">
        <nav class="flex items-center justify-between">
            <div>
                <a href="/">
                    <img :src="Logo" class="size-9" alt="SGC" />
                </a>
            </div>
            <ul class="flex gap-1">
                <li v-for="link in links" :key="link.title">
                    <Link href="link.href" class="btn btn-sm btn-ghost">
                        {{ link.title }}
                    </Link>
                </li>
            </ul>
            <div class="space-x-1">
                <a href="/login" class="btn btn-sm btn-primary"> Entrar </a>
                <a href="/register" class="btn btn-sm btn-outline"> Cadastrar </a>
            </div>
        </nav>
    </header>
</template>
