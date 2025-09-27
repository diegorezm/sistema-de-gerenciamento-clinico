<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import DoctorImage from '../../images/doctor.jpg';
</script>

<template>
    <Head title="Bem-vindo!">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <GuestLayout>
        <main class="mt-4 w-full">
            <div class="mx-auto flex max-w-7xl flex-col items-center md:flex-row">
                <!-- Texto -->
                <div class="flex-1 px-6 py-12 text-center md:px-12 md:text-left">
                    <h1 class="mb-6 text-4xl leading-tight font-extrabold text-gray-900 md:text-5xl">A nova forma de <br />gerenciar sua clínica</h1>
                    <p class="mb-8 text-lg text-gray-600">
                        Organize consultas, pacientes e equipe em um só lugar. Simples, rápido e eficiente para o seu dia a dia.
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row md:justify-start">
                        <a href="#agendar" class="btn btn-lg btn-primary"> Experimente grátis </a>
                        <a href="#saiba-mais" class="btn btn-outline btn-lg"> Saiba mais </a>
                    </div>
                </div>

                <!-- Imagem -->
                <div class="flex-1">
                    <img :src="DoctorImage" alt="Médico" class="h-[650px] w-full object-cover object-center" />
                </div>
            </div>
        </main>
    </GuestLayout>
</template>
