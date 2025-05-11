<script lang="ts" setup>
import AppDataTable from '@/components/DataTables/AppDataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { DataTableProps } from '@/types/data-table';
import { Head } from '@inertiajs/vue3';

interface Props {
    users: DataTableProps<User>;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users List',
        href: '/users',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Users list" />

        <AppDataTable :resource="users" primary-key="id" />
    </AppLayout>
</template>
