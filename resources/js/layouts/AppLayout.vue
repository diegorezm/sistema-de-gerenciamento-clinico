<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const page = usePage();
const flash = computed(() => page.props.flash ?? {});

watch(
    () => flash.value,
    (newVal) => {
        if (newVal?.success) {
            console.log('✅ SUCCESS:', newVal.success);
        }
        if (newVal?.error) {
            console.error('❌ ERROR:', newVal.error);
        }
    },
    { deep: true },
);
</script>

<template>
    <Navbar />
    <div>
        <div v-if="flash.success" class="mb-2 bg-green-100 p-2 text-green-800">
            {{ flash.success }}
        </div>

        <div v-if="flash.error" class="mb-2 bg-red-100 p-2 text-red-800">
            {{ flash.error }}
        </div>

        <slot />
    </div>
</template>
