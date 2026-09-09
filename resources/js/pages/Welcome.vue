<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/layouts/PublicLayout.vue'
import { Toy } from '@/types'

defineProps<{
    toys: Toy[];
    images: string[];
}>()
</script>

<template>
    <Head title="Toy Collection" />

    <PublicLayout>
        <section class="space-y-6">
            <div>
                <h1 class="text-4xl font-bold text-[#e6db74]">
                    Welcome to the Toy Collection
                </h1>

                <p class="mt-2 text-[#f8f8f2]">
                    A digital archive of vintage and collectible toys,
                    styled like a page straight from 1996.
                </p>
            </div>

            <!-- Your toys -->
        </section>
    </PublicLayout>
</template>
