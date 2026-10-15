<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ToyDetails from '@/components/toys/toyDetails.vue';
import { dashboard } from '@/routes';
import { destroy, edit } from '@/routes/admintoys';
import type { Toy } from '@/types';

defineProps<{
    toy: Toy;
    images: string[];
}>();
</script>

<template>
    <Head :title="toy.name" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
        <div class="flex items-center justify-between gap-4">
            <Link :href="dashboard()" class="text-sm text-[#66d9ef]">
                &laquo; Back to dashboard
            </Link>

            <span
                class="min-w-0 flex-1 truncate text-right text-xl font-bold text-[#e6db74]"
            >
                {{ toy.name }}
            </span>
        </div>

        <ToyDetails :toy="toy" :images="images" />

        <div
            class="flex items-center gap-3 border-t-2 pt-4"
            style="border-top-color: #49483e"
        >
            <Link
                :href="edit(toy.id).url"
                class="inline-flex items-center border-2 px-3 py-1 text-sm font-bold text-[#272822] hover:opacity-80"
                style="
                    border-color: #fdfbe8 #9d9200 #9d9200 #fdfbe8;
                    background-color: #e6db74;
                "
            >
                Edit
            </Link>

            <Link
                method="delete"
                :href="destroy(toy.id).url"
                class="inline-flex items-center border-2 px-3 py-1 text-sm font-bold text-[#f8f8f2] hover:opacity-80"
                style="
                    border-color: #ff8fc2 #6f0f33 #6f0f33 #ff8fc2;
                    background-color: #f92672;
                "
            >
                Delete
            </Link>
        </div>
    </div>
</template>