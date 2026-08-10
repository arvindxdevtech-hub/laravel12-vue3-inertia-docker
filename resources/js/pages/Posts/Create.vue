<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
    title: '',
    content: '',
    status: true,
});

const submit = () => {
    form.post('/posts');
};
</script>

<template>
  <AppLayout>
    <div class="p-6">
        <h1 class="mb-6 text-2xl font-bold">Create Post</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label>Title</label>

                <input
                    v-model="form.title"
                    type="text"
                    class="block w-full rounded border p-2"
                />

                <div v-if="form.errors.title" class="text-red-500">
                    {{ form.errors.title }}
                </div>
            </div>

            <div class="mb-4">
                <label>Content</label>

                <textarea
                    v-model="form.content"
                    class="block w-full rounded border p-2"
                ></textarea>

                <div v-if="form.errors.content" class="text-red-500">
                    {{ form.errors.content }}
                </div>
            </div>

            <div class="mb-4">
                <label>
                    <input
                        v-model="form.status"
                        type="checkbox"
                    />

                    Published
                </label>
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="rounded bg-black px-4 py-2 text-white"
            >
                Create Post
            </button>
        </form>
    </div>
    </AppLayout>
</template>