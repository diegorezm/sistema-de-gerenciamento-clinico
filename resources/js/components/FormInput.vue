<script setup lang="ts">
import { defineEmits } from 'vue';

// Props only for "extra" stuff
defineProps<{
    id: string;
    label: string;
    modelValue: string;
    error?: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void;
}>();
</script>

<template>
    <div>
        <label :for="id" class="block text-sm font-medium">
            {{ label }}
        </label>

        <!-- We inherit all attributes and listeners -->
        <input
            v-bind="$attrs"
            :id="id"
            :value="modelValue"
            @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
            class="mt-1 block w-full rounded border p-2"
        />

        <span v-if="error" class="text-sm text-red-600">
            {{ error }}
        </span>
    </div>
</template>
