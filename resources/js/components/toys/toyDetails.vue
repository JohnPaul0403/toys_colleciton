<script setup lang="ts">
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from '@/components/ui/carousel';
import type { Toy } from '@/types';

defineProps<{
    toy: Toy;
    images: string[];
}>();

const formatPrice = (value: number) =>
    Number(value).toLocaleString(undefined, {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    });
</script>

<template>
    <div class="flex flex-col gap-6">
        <div
            v-if="images.length === 1"
            class="toy-image-frame relative aspect-4/3 w-full overflow-hidden"
        >
            <img :src="images[0]" :alt="toy.name" class="size-full object-cover" />
        </div>

        <Carousel
            v-else
            class="w-full"
            :opts="{ loop: true }"
        >
            <CarouselContent>
                <CarouselItem
                    v-for="image in images"
                    :key="image"
                >
                    <div class="toy-image-frame relative aspect-4/3 w-full overflow-hidden">
                        <img :src="image" :alt="toy.name" class="size-full object-cover" />
                    </div>
                </CarouselItem>
            </CarouselContent>

            <CarouselPrevious
                class="toy-carousel-nav -left-4 top-1/2 -translate-y-1/2"
                variant="ghost"
            />

            <CarouselNext
                class="toy-carousel-nav -right-4 top-1/2 -translate-y-1/2"
                variant="ghost"
            />
        </Carousel>

        <div class="flex flex-col gap-4">
            <h1 class="text-2xl leading-tight font-bold text-[#e6db74]">
                {{ toy.title || toy.name }}
            </h1>

            <span
                class="w-fit border-2 px-2 py-0.5 text-base font-bold text-[#272822]"
                style="
                    border-color: #fdfbe8 #9d9200 #9d9200 #fdfbe8;
                    background-color: #e6db74;
                "
            >
                {{ formatPrice(toy.price) }}
            </span>

            <div
                v-if="toy.description"
                class="tiptap ProseMirror toy-details text-foreground text-sm leading-relaxed"
                v-html="toy.description"
            />
        </div>
    </div>
</template>