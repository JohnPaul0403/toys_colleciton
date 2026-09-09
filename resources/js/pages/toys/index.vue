<script setup lang="ts">
import { Toy } from '@/types';

defineProps<{
    toys: Toy[];
    images: string[];
}>()
</script>

<template>
    <Head title="Toy Collection | Toy" />
    <section class="space-y-6">
        <div>
            show toys
        </div>

        <!-- Your toys -->
    </section>
</template>
