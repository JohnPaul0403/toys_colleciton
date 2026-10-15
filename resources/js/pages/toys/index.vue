<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import ToyCard from '@/components/toys/toyCard.vue';
import { Toy } from '@/types';

defineProps<{
    toys: Toy[];
    images: string[];
}>()
</script>

<template>
    <Head title="Toy Collection | Toys" />
    <section class="space-y-6">
        <div>
            show toys
        </div>

        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto p-4">
            <div
                v-if="toys.length"
                class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
            >
                <ToyCard
                    v-for="(toy, index) in toys"
                    :admin="false"
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
                No toys yet. Soon we will be available!
            </div>
        </div>

        <!-- Your toys -->
    </section>
</template>
