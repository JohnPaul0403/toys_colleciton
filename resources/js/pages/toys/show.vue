<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ToyDetails from '@/components/toys/toyDetails.vue';
import { toys } from '@/routes';
import type { Toy } from '@/types';

defineProps<{
    toy: Toy;
    images: string[];
}>();
</script>

<template>
    <Head :title="toy.name" />

    <section class="space-y-6">
        <div class="flex items-center justify-between gap-4">
            <Link :href="toys()" class="text-sm text-[#66d9ef]">
                &laquo; Back to toys
            </Link>

            <span
                class="min-w-0 flex-1 truncate text-right text-xl font-bold text-[#e6db74]"
            >
                {{ toy.name }}
            </span>
        </div>

        <ToyDetails :toy="toy" :images="images" />
    </section>
</template>