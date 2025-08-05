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
            <h1 class="text-2xl font-bold">Dashboard</h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Card :class="cn('mb-8 w-[380px]', $attrs.class ?? '')">
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

            <table class="table-auto w-full mb-6 border-collapse border border-gray-600">
                <thead class="bg-white dark:bg-gray-800">
                <tr class="text-left font-bold">
                    <th class="border border-gray-600 p-4">Name</th>
                    <th class="border border-gray-600 p-4">Email</th>
                    <th class="border border-gray-600 p-4">Address #1</th>
                    <th class="border border-gray-600 p-4">Address #2</th>
                    <th class="border border-gray-600 p-4">Created By</th>
                    <th class="border border-gray-600 p-4" colspan="2">Updated By</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-900 dark:hover:bg-gray-900 focus-within:bg-gray-900">
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="route('users.edit', user.id)">
                            {{ user.name }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.email }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.address_1 }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.address_2 }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.created_by.name + " @ " + user.created_at_formatted }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.updated_by.name + " @ " + user.updated_at_formatted }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-4" :href="route('users.edit', user.id)" tabindex="-1">
                            <ChevronsRight class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="users.data.length === 0">
                    <td class="border-t" colspan="4">No users found... Try again!</td>
                </tr>
                </tbody>
            </table>

            <Pagination :links="users.links" class="mb-6"/>

<!--                <div class="container py-10 mx-auto">-->
<!--                    <DataTable :columns="UserColumns" :data="users" />-->
<!--                </div>-->
        </div>
    </AuthenticatedLayout>
</template>
