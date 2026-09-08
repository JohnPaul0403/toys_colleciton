<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import {
    Bold,
    Code,
    Code2,
    Heading1,
    Heading2,
    Heading3,
    Italic,
    List,
    ListOrdered,
    Minus,
    Redo2,
    Strikethrough,
    TextQuote,
    Undo2,
} from '@lucide/vue';
import { EditorContent, useEditor } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import { computed, onUnmounted, ref, type Component } from 'vue';
import Admin from '@/actions/App/Http/Controllers/Admin';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { Toy } from '@/types';

type Props = {
    toy?: Toy;
    mode?: 'create' | 'edit';
};

const props = withDefaults(defineProps<Props>(), {
    toy: undefined,
    mode: 'create',
});

const form = useForm({
    title: props.toy?.title ?? '',
    name: props.toy?.name ?? '',
    description: props.toy?.description ?? '',
    sold: props.toy?.sold ?? false,
    price: props.toy?.price ?? 0,
});

const editorRef = ref(0);

const editor = useEditor({
    extensions: [StarterKit],
    content: form.description,
    onUpdate: ({ editor }) => {
        form.description = editor.getHTML();
    },
    onTransaction: () => {
        editorRef.value++;
    },
});

onUnmounted(() => {
    editor.value?.destroy();
});

const isActive = (type: string, attributes = {}) =>
    computed(() => {
        editorRef.value;
        return editor.value?.isActive(type, attributes) ?? false;
    });

type ToolbarButton = {
    icon: Component;
    title: string;
    active?: ReturnType<typeof isActive>;
    disabled?: () => boolean;
    run: () => void;
};

const canUndo = computed(() => {
    editorRef.value;
    return editor.value?.can().undo() ?? false;
});

const canRedo = computed(() => {
    editorRef.value;
    return editor.value?.can().redo() ?? false;
});

const toolbar: ToolbarButton[][] = [
    [
        {
            icon: Undo2,
            title: 'Undo',
            disabled: () => !canUndo.value,
            run: () => editor.value?.chain().focus().undo().run(),
        },
        {
            icon: Redo2,
            title: 'Redo',
            disabled: () => !canRedo.value,
            run: () => editor.value?.chain().focus().redo().run(),
        },
    ],
    [
        {
            icon: Bold,
            title: 'Bold',
            active: isActive('bold'),
            run: () => editor.value?.chain().focus().toggleBold().run(),
        },
        {
            icon: Italic,
            title: 'Italic',
            active: isActive('italic'),
            run: () => editor.value?.chain().focus().toggleItalic().run(),
        },
        {
            icon: Strikethrough,
            title: 'Strikethrough',
            active: isActive('strike'),
            run: () => editor.value?.chain().focus().toggleStrike().run(),
        },
        {
            icon: Code,
            title: 'Inline code',
            active: isActive('code'),
            run: () => editor.value?.chain().focus().toggleCode().run(),
        },
    ],
    [
        {
            icon: Heading1,
            title: 'Heading 1',
            active: isActive('heading', { level: 1 }),
            run: () =>
                editor.value?.chain().focus().toggleHeading({ level: 1 }).run(),
        },
        {
            icon: Heading2,
            title: 'Heading 2',
            active: isActive('heading', { level: 2 }),
            run: () =>
                editor.value?.chain().focus().toggleHeading({ level: 2 }).run(),
        },
        {
            icon: Heading3,
            title: 'Heading 3',
            active: isActive('heading', { level: 3 }),
            run: () =>
                editor.value?.chain().focus().toggleHeading({ level: 3 }).run(),
        },
    ],
    [
        {
            icon: List,
            title: 'Bullet list',
            active: isActive('bulletList'),
            run: () => editor.value?.chain().focus().toggleBulletList().run(),
        },
        {
            icon: ListOrdered,
            title: 'Ordered list',
            active: isActive('orderedList'),
            run: () => editor.value?.chain().focus().toggleOrderedList().run(),
        },
    ],
    [
        {
            icon: TextQuote,
            title: 'Quote',
            active: isActive('blockquote'),
            run: () => editor.value?.chain().focus().toggleBlockquote().run(),
        },
        {
            icon: Code2,
            title: 'Code block',
            active: isActive('codeBlock'),
            run: () => editor.value?.chain().focus().toggleCodeBlock().run(),
        },
        {
            icon: Minus,
            title: 'Horizontal rule',
            run: () => editor.value?.chain().focus().setHorizontalRule().run(),
        },
    ],
];

const { AdminToysController } = Admin;

const submit = () => {
    if (props.mode === 'edit' && props.toy) {
        form.put(AdminToysController.update.url(props.toy.id));

        return;
    }

    form.post(AdminToysController.store.url());
};
</script>

<template>
    <Card class="flex h-full flex-col">
        <CardHeader>
            <CardTitle class="text-lg font-bold text-[#e6db74]">
                {{ mode === 'edit' ? 'Edit Toy' : 'Create Toy' }}
            </CardTitle>
        </CardHeader>

        <CardContent class="flex flex-1 flex-col">
            <form
                @submit.prevent="submit"
                class="flex h-full flex-grow flex-col gap-4"
                novalidate
            >
                <div class="grid gap-3 md:grid-cols-3">
                    <div class="grid gap-1.5">
                        <Label for="title" class="text-xs">Title</Label>
                        <Input
                            id="title"
                            v-model="form.title"
                            type="text"
                            placeholder="Two-line caption"
                        />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-1.5">
                        <Label for="name" class="text-xs">Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            placeholder="Classic plush bear"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-1.5">
                        <Label for="price" class="text-xs">Price</Label>
                        <Input
                            id="price"
                            v-model="form.price"
                            type="number"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                        />
                        <InputError :message="form.errors.price" />
                    </div>
                </div>

                <div class="flex min-h-0 flex-grow flex-col gap-1.5">
                    <Label class="text-xs">Description</Label>
                    <div
                        class="flex flex-grow flex-col border-2 bg-[#1e1f1c]"
                        style="border-color: #171814 #75715e #75715e #171814"
                    >
                        <div
                            class="flex flex-wrap items-center gap-1 border-b-2 px-2 py-1.5"
                            style="border-bottom-color: #171814"
                            data-slot="tiptap-toolbar"
                        >
                            <template
                                v-for="(group, groupIndex) in toolbar"
                                :key="groupIndex"
                            >
                                <div class="flex items-center gap-1">
                                    <Button
                                        v-for="item in group"
                                        :key="item.title"
                                        type="button"
                                        size="icon"
                                        variant="ghost"
                                        :title="item.title"
                                        :disabled="item.disabled?.() ?? false"
                                        :class="{
                                            'bg-[#e6db74] text-[#272822] hover:bg-[#e6db74]':
                                                item.active?.value,
                                        }"
                                        @click="item.run"
                                    >
                                        <component
                                            :is="item.icon"
                                            class="h-4 w-4"
                                        />
                                    </Button>
                                </div>
                                <span
                                    v-if="groupIndex < toolbar.length - 1"
                                    class="mx-1 h-6 w-px bg-[#3e3d32]"
                                />
                            </template>
                        </div>

                        <div
                            class="text-foreground flex-grow overflow-y-auto px-3 py-2 caret-[#e6db74]"
                        >
                            <EditorContent :editor="editor" />
                        </div>
                    </div>
                    <InputError :message="form.errors.description" />
                </div>

                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div
                        v-if="mode === 'edit'"
                        class="flex items-center gap-2 pb-0.5"
                    >
                        <Checkbox
                            id="sold"
                            v-model="form.sold"
                            class="rounded-none data-[state=checked]:bg-[#e6db74]"
                        />
                        <Label for="sold" class="cursor-pointer">
                            Was it sold?
                        </Label>
                        <InputError :message="form.errors.sold" />
                    </div>

                    <Button
                        type="submit"
                        class="ml-auto"
                        :disabled="form.processing"
                        data-test="toy-submit-button"
                    >
                        {{
                            form.processing
                                ? 'Saving...'
                                : mode === 'edit'
                                  ? 'Update Toy'
                                  : 'Create Toy'
                        }}
                    </Button>
                </div>
            </form>
        </CardContent>
    </Card>
</template>
