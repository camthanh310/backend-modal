<script lang="ts" setup>
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { watchEffect } from 'vue';

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

const form = useForm({
    name: '',
    email: '',
});

watchEffect(() => {
    form.name = props.user.name;
    form.email = props.user.email;
});

function update() {
    form.patch(route('users.update', { user: props.user }));
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="'Edit user - ' + user.name" />

        <form class="m-5" @submit.prevent="update">
            <Card>
                <CardHeader>
                    <CardTitle>Edit User</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="grid w-full items-center gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Name</Label>
                            <Input id="name" placeholder="John Doe" v-model="form.name" />
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <Label for="email">Email</Label>
                            <Input id="email" placeholder="john@doe.com" v-model="form.email" />
                            <InputError :message="form.errors.name" />
                        </div>
                    </div>
                </CardContent>
                <CardFooter class="space-x-2">
                    <Button variant="outline" as-child>
                        <Link :href="route('users.index')">Cancel</Link>
                    </Button>
                    <Button type="submit">
                        <LoaderCircle v-if="form.processing" class="size-4 animate-spin" />
                        Save
                    </Button>
                </CardFooter>
            </Card>
        </form>
    </AppLayout>
</template>
