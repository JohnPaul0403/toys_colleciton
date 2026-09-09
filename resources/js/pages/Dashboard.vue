<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import ToyCard from '@/components/toys/toyCard.vue';
import { create } from '@/routes/admintoys';
import { dashboard } from '@/routes';
import type { Toy } from '@/types';

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
    toys: Toy[];
    images: string[];
}>();
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
        <div
            class="cursor-pointer border-2 bg-[#1e1f1c] p-4 text-center font-bold text-[#e6db74] hover:bg-[#3e3d32]"
            style="border-color: #49483e #171814 #171814 #49483e"
            @click="router.visit(create().url)"
        >
            Create a new toy post
        </div>

        <div
            v-if="toys.length"
            class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        >
            <ToyCard
                v-for="(toy, index) in toys"
                :key="toy.id"
                :toy="toy"
                :image="images[index]"
            />
        </div>

        <div
            v-else
            class="border-2 border-dashed bg-[#1e1f1c] p-8 text-center text-[#75715e]"
            style="border-color: #49483e"
        >
            No toys yet. Create the first one above!
        </div>
    </div>
</template>
