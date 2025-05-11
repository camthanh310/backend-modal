<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

interface Props {
    user: User;
}

const props = defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: props.user.name,
        href: '/users',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="user.name" />
        <div class="m-5 flex flex-col space-y-4">
            <div class="relative">
                <img :src="props.user.avatar" class="size-28 rounded-full object-cover" />
            </div>
            <div class="flex flex-col space-y-2">
                <span>Email: {{ user.email }}</span>
                <span>Name {{ user.name }}</span>
            </div>
            <div class="space-x-2">
                <Button variant="link" as-child>
                    <Link :href="route('users.edit', { user: user.id })">Edit</Link>
                </Button>
                <Button variant="link">Edit with modal</Button>
            </div>
        </div>
    </AppLayout>
</template>
