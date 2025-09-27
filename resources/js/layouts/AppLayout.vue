<script setup lang="ts">
import Toast from '@/components/Toast.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const page = usePage();
const flash = computed(() => page.props.flash ?? {});
const toasts = ref<{ message: string; type: 'success' | 'error' }[]>([]);

watch(
    () => flash.value,
    (newVal) => {
        if (newVal?.success) {
            toasts.value.push({ message: newVal.success, type: 'success' });
        }
        if (newVal?.error) {
            toasts.value.push({ message: newVal.error, type: 'error' });
        }
    },
    { deep: true },
);
</script>

<template>
    <div>
        <div class="fixed inset-x-0 top-5 z-[9999] flex flex-col items-center space-y-2">
            <Toast v-for="(toast, i) in toasts" :key="i" :message="toast.message" :type="toast.type" :duration="3000" />
        </div>

        <slot />
    </div>
</template>
