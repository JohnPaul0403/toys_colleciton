<script setup lang="ts">
import { Toy } from '@/types';

defineProps<{
    toy: Toy;
    images: string[];
}>()
</script>

<template>
    <Head title="Toy Collection | Toy" />
    <section class="space-y-6">
        <div>
            show toy
        </div>

        <!-- Your toys -->
    </section>
</template>
