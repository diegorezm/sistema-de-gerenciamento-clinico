<script setup lang="ts">
import { AlertTriangle, CheckCircle, Info, XCircle } from 'lucide-vue-next';
import { computed, ref, watchEffect } from 'vue';

const props = defineProps<{
    message: string;
    type?: 'success' | 'error' | 'info' | 'warning';
    duration?: number;
}>();

const visible = ref(true);

watchEffect((onCleanup) => {
    if (props.duration !== 0) {
        const timer = setTimeout(() => (visible.value = false), props.duration ?? 3000);
        onCleanup(() => clearTimeout(timer));
    }
});

const toastStyleClass = computed(() => {
    switch (props.type) {
        case 'success':
            return 'bg-green-50 border-green-500 text-green-700';
        case 'error':
            return 'bg-red-50 border-red-500 text-red-700';
        case 'warning':
            return 'bg-yellow-50 border-yellow-500 text-yellow-700';
        default:
            return 'bg-blue-50 border-blue-500 text-blue-700';
    }
});
const icon = computed(() => {
    switch (props.type) {
        case 'success':
            return CheckCircle;
        case 'error':
            return XCircle;
        case 'warning':
            return AlertTriangle;
        default:
            return Info;
    }
});
</script>

<template>
    <transition
        enter-active-class="transform transition ease-out duration-300"
        enter-from-class="translate-y-2 opacity-0"
        enter-to-class="translate-y-0 opacity-100"
        leave-active-class="transform transition ease-in duration-200"
        leave-from-class="translate-y-0 opacity-100"
        leave-to-class="translate-y-2 opacity-0"
    >
        <div v-if="visible" class="flex w-80 items-center gap-2 rounded-md border-l-4 px-4 py-3 shadow-md" :class="toastStyleClass">
            <component :is="icon" class="h-5 w-5 shrink-0" />

            <!-- Message -->
            <span class="flex-1 text-sm text-gray-800">
                {{ message }}
            </span>
        </div>
    </transition>
</template>
