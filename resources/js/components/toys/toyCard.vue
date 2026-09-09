<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Card, CardContent } from '@/components/ui/card';
import { show } from '@/routes/admintoys';
import type { Toy } from '@/types';

type Props = {
    toy: Toy;
    image?: string | null;
};

withDefaults(defineProps<Props>(), {
    image: null,
});

const formatPrice = (value: number) =>
    Number(value).toLocaleString(undefined, {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    });
</script>

<template>
    <Card class="overflow-hidden">
        <div
            class="relative aspect-[4/3] overflow-hidden border-2 bg-[#171814]"
            style="border-color: #171814 #75715e #75715e #171814"
        >
            <img
                v-if="image"
                :src="image"
                :alt="toy.name"
                class="size-full object-cover"
            />
            <template v-else>
                <PlaceholderPattern />
                <div
                    class="absolute inset-0 grid place-items-center text-sm text-[#75715e] italic"
                >
                    No image
                </div>
            </template>
        </div>

        <CardContent class="flex flex-col gap-3 p-4">
            <div class="flex items-start justify-between gap-3">
                <h3
                    class="min-w-0 flex-1 text-lg leading-tight font-bold text-[#e6db74]"
                >
                    {{ toy.title || toy.name }}
                </h3>
                <span
                    class="shrink-0 border-2 px-2 py-0.5 text-sm font-bold text-[#272822]"
                    style="
                        border-color: #fdfbe8 #9d9200 #9d9200 #fdfbe8;
                        background-color: #e6db74;
                    "
                >
                    {{ formatPrice(toy.price) }}
                </span>
            </div>

            <p class="text-foreground text-sm">
                {{ toy.name }}
            </p>

            <div
                class="flex items-center justify-between border-t-2 pt-2"
                style="border-top-color: #49483e"
            >
                <span
                    v-if="toy.sold"
                    class="border-2 px-2 py-0.5 text-xs font-bold text-[#f8f8f2]"
                    style="
                        border-color: #ff8fc2 #6f0f33 #6f0f33 #ff8fc2;
                        background-color: #f92672;
                    "
                >
                    SOLD OUT
                </span>
                <span
                    v-else
                    class="border-2 px-2 py-0.5 text-xs font-bold text-[#272822]"
                    style="
                        border-color: #c8f27a #5a7d18 #5a7d18 #c8f27a;
                        background-color: #a6e22e;
                    "
                >
                    AVAILABLE
                </span>
                <Link :href="show(toy.id).url" class="text-sm">
                    View &raquo;
                </Link>
            </div>
        </CardContent>
    </Card>
</template>
