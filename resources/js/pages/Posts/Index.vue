<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

interface Post {
    id: number;
    title: string;
    slug: string;
    content: string;
    status: boolean;
}

defineProps<{
    posts: Post[];
}>();

const deletePost = (id: number) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(`/posts/${id}`);
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">
                    Posts
                </h1>

                <Link
                    href="/posts/create"
                    class="rounded bg-black px-4 py-2 text-white"
                >
                    Create Post
                </Link>
            </div>

            <div class="overflow-hidden rounded border">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Title</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="post in posts"
                            :key="post.id"
                            class="border-b"
                        >
                            <td class="p-3">
                                {{ post.id }}
                            </td>

                            <td class="p-3">
                                {{ post.title }}
                            </td>

                            <td class="p-3">
                                {{ post.status ? 'Published' : 'Draft' }}
                            </td>

                            <td class="p-3">
                                <Link :href="`/posts/${post.id}/edit`" class="text-blue-600">Edit</Link>

                                <button type="button" style="color: red; margin-left: 10px;" @click="deletePost(post.id)">Delete</button>
                            </td>
                        </tr>

                        <tr v-if="posts.length === 0">
                            <td
                                colspan="4"
                                class="p-6 text-center"
                            >
                                No posts found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>