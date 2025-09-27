<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <Navbar :user="user" />
    <slot />
</template>
