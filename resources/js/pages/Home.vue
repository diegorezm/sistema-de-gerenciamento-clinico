<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue"
import DoctorImage from "../../images/doctor.jpg"
import Logo from "../../images/logo.svg"

const links = ref([
    {
        title: "Principal",
        href: "/"
    },
    {
        title: "Sobre",
        href: "/#sobre"
    },
    {
        title: "Funcionalidades",
        href: "/#funcionalidades"
    },
    {
        title: "Planos",
        href: "/#planos"
    },
    {
        title: "Contato",
        href: "/#contato"
    },
])
</script>

<template>

    <Head title="Bem-vindo!">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <header class="bg-white px-4 py-2 shadow">
        <nav class="flex justify-between items-center">
            <div>
                <a href="/">
                    <img :src="Logo" class="size-9" alt="SGC">
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
                <a href="/login" class="btn btn-sm btn-primary">
                    Entrar
                </a>
                <a href="/register" class="btn btn-sm btn-outline">
                    Registrar
                </a>
            </div>
        </nav>
    </header>

    <section class="w-full  mt-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center">
            <!-- Texto -->
            <div class="flex-1 text-center md:text-left px-6 md:px-12 py-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    A nova forma de <br />gerenciar sua clínica
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Organize consultas, pacientes e equipe em um só lugar.
                    Simples, rápido e eficiente para o seu dia a dia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#agendar" class="btn btn-lg btn-primary">
                        Experimente grátis
                    </a>
                    <a href="#saiba-mais" class="btn btn-outline btn-lg">
                        Saiba mais
                    </a>
                </div>
            </div>

            <!-- Imagem -->
            <div class="flex-1">
                <img :src="DoctorImage" alt="Médico" class="w-full h-[650px] object-cover object-center" />
            </div>
        </div>
    </section>
</template>
