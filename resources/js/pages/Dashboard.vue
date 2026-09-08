<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Toy } from '@/types';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

defineProps<{
    toys: Toy[]
}>()
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div
            class="cursor-pointer rounded-lg border p-4 transition-colors hover:bg-muted/50"
            @click="router.visit('admin/toys/create')"
        >Crate toy post</div>
    </div>
</template>
