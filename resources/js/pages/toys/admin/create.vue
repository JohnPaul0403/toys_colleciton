<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ToyForm from '@/components/toys/toyForm.vue';
import { create } from '@/routes/admintoys';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'New Toy',
                href: create(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Create Toy" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
        <ToyForm mode="create" />
    </div>
</template>
