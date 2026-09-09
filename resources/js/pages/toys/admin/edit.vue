<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ToyForm from '@/components/toys/toyForm.vue';
import type { Toy } from '@/types';

defineProps<{
    toy: Toy;
    images: string[];
}>();
</script>

<template>
    <Head title="Edit Toy" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
        <ToyForm :toy="$props.toy" mode="edit" />
    </div>
</template>
