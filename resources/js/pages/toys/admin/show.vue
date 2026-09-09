
<script setup lang="ts">
import { Toy } from '@/types';

defineProps<{
    toy: Toy
    images: string[];
}>()
</script>

<template>
    <div>
        Show Toy
    </div>
</template>
