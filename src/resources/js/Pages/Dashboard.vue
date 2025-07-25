<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Switch } from '@/components/ui/switch';
import { UserColumns } from '@/components/users/columns.ts';
import DataTable from '@/components/datatable/datatable.vue';
import { cn } from '@/lib/utils';
import { BellRing, Check, ChevronsRight } from 'lucide-vue-next';

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

// defineProps({ users: Object })

const notifications = [
    {
        title: 'Your call has been confirmed.',
        description: '1 hour ago',
    },
    {
        title: 'You have a new message!',
        description: '1 hour ago',
    },
    {
        title: 'Your subscription is expiring soon!',
        description: '2 hours ago',
    },
];
</script>

<script lang="ts">
import Pagination from '@/components/common/Pagination.vue';

export default {
    components: {
        Pagination,
    },
    props: {
        users: Object,
    },
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Card :class="cn('w-[380px]', $attrs.class ?? '')">
                    <CardHeader>
                        <CardTitle>Notifications</CardTitle>
                        <CardDescription>You have 3 unread messages.</CardDescription>
                    </CardHeader>
                    <CardContent class="grid gap-4">
                        <div class=" flex items-center space-x-4 rounded-md border p-4">
                            <BellRing />
                            <div class="flex-1 space-y-1">
                                <p class="text-sm font-medium leading-none">
                                    Push Notifications
                                </p>
                                <p class="text-sm text-muted-foreground">
                                    Send notifications to device.
                                </p>
                            </div>
                            <Switch />
                        </div>
                        <div>
                            <div
                                v-for="(notification, index) in notifications" :key="index"
                                class="mb-4 grid grid-cols-[25px_minmax(0,1fr)] items-start pb-4 last:mb-0 last:pb-0"
                            >
                                <span class="flex h-2 w-2 translate-y-1 rounded-full bg-sky-500" />
                                <div class="space-y-1">
                                    <p class="text-sm font-medium leading-none">
                                        {{ notification.title }}
                                    </p>
                                    <p class="text-sm text-muted-foreground">
                                        {{ notification.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button class="w-full">
                            <Check class="mr-2 h-4 w-4" /> Mark all as read
                        </Button>
                    </CardFooter>
                </Card>

                <div class="my-4 rounded-md shadow overflow-x-auto">
                    <table class="table-auto">
                        <thead class="bg-white dark:bg-gray-800">
                            <tr class="text-left font-bold">
                                <th class="pb-4 pt-6 px-6">Name</th>
                                <th class="pb-4 pt-6 px-6">Email Address</th>
                                <th class="pb-4 pt-6 px-6">Address #1</th>
                                <th class="pb-4 pt-6 px-6" colspan="2">Address #2</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700">
                            <tr v-for="organization in users.data" :key="organization.id" class="hover:bg-gray-900 dark:hover:bg-gray-900 focus-within:bg-gray-900">
                                <td class="border-t">
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/organizations/${organization.id}/edit`">
                                        {{ organization.name }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link class="flex items-center px-6 py-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                                        {{ organization.email }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link class="flex items-center px-6 py-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                                        {{ organization.address_1 }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link class="flex items-center px-6 py-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                                        {{ organization.address_2 }}
                                    </Link>
                                </td>
                                <td class="w-px border-t">
                                    <Link class="flex items-center px-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                                        <ChevronsRight class="block w-6 h-6 fill-gray-400" />
                                    </Link>
                                </td>
                            </tr>
                            <tr v-if="users.data.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">No users found... Try again!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :links="users.links" />

<!--                <div class="container py-10 mx-auto">-->
<!--                    <DataTable :columns="UserColumns" :data="users" />-->
<!--                </div>-->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
