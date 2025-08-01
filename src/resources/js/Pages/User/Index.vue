<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">Users</h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <div class="flex items-center justify-between mb-6">
                <p>Search and Filter placeholder</p>
                <Button v-if="can('users.create')" as="a" type="button" severity="primary" label="Create User" :href="route('users.create')" />
            </div>

            <Message v-if="$page.props.flash.message" :life=3000 severity="success" icon="pi pi-check" class="mb-6">
                {{ $page.props.flash.message }}
            </Message>

            <table class="table-auto w-full mb-6 border-collapse border border-gray-600">
                <thead class="bg-white dark:bg-gray-800">
                <tr class="text-left font-bold">
                    <th class="border border-gray-600 p-4">Name</th>
                    <th class="border border-gray-600 p-4">Email</th>
                    <th class="border border-gray-600 p-4">Roles</th>
                    <th class="border border-gray-600 p-4">Address #1</th>
                    <th class="border border-gray-600 p-4" colspan="2">Updated By</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-900 dark:hover:bg-gray-900 focus-within:bg-gray-900">
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex items-center p-2 gap-2 focus:text-indigo-500" :href="route('users.edit', user.id)">
                            {{ user.name }}<i class="pi pi-trash text-secondary" v-if="user.deleted_at_formatted"></i>
                        </Link>
                        <span v-else class="flex items-center p-2">
                            {{ user.name }}<i class="pi pi-trash text-secondary" v-if="user.deleted_at_formatted"></i>
                        </span>
                    </td>
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex items-center p-2" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.email }}
                        </Link>
                        <span v-else class="flex items-center p-2">
                            {{ user.email }}
                        </span>
                    </td>
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex flex-wrap items-center p-2" :href="route('users.edit', user.id)" tabindex="-1">
                            <div v-for="role in user.roles">
                                <Badge v-if="role.name === administratorName" severity="danger"  class="m-1">{{ role.name }}</Badge>
                                <Badge v-else-if="role.name === guestName" severity="success"  class="m-1">{{ role.name }}</Badge>
                                <Badge v-else severity="info"  class="m-1">{{ role.name }}</Badge>
                            </div>
                        </Link>
                        <div v-else>
                            <div v-for="role in user.roles">
                                <Badge v-if="role.name === administratorName" severity="danger"  class="m-1">{{ role.name }}</Badge>
                                <Badge v-else-if="role.name === guestName" severity="success"  class="m-1">{{ role.name }}</Badge>
                                <Badge v-else severity="info"  class="m-1">{{ role.name }}</Badge>
                            </div>
                        </div>
                    </td>
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex items-center p-2" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.address_1 }}
                        </Link>
                        <span v-else class="flex items-center p-2">
                            {{ user.address_1 }}
                        </span>
                    </td>
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex items-center p-2" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.updated_by.name + " @ " + user.updated_at_formatted }}
                        </Link>
                        <span v-else class="flex items-center p-2">
                            {{ user.updated_by.name + " @ " + user.updated_at_formatted }}
                        </span>
                    </td>
                    <td class="border-t">
                        <Link v-if="can('users.edit')" class="flex items-center p-2" :href="route('users.edit', user.id)" tabindex="-1">
                            <i class="pi pi-angle-double-right w-8 h-8 text-sky-400"></i>
                        </Link>
                        <span v-else class="flex items-center p-2">
                            <i class="pi pi-ban w-8 h-8 text-secondary"></i>
                        </span>
                    </td>
                </tr>
                <tr v-if="users.data.length === 0">
                    <td class="border-t" colspan="4">No users found... Try again!</td>
                </tr>
                </tbody>
            </table>

            <Pagination :links="users.links" class="mb-6"/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from "@inertiajs/vue3";
import Message from "primevue/message";
import Button from "primevue/button";
import Badge from "primevue/badge";
import { can } from "@/lib/can";
</script>

<script lang="ts">
import Pagination from "@/components/common/Pagination.vue";
export default {
    components: {
        Pagination,
    },
    props: {
        users: Object,
    },
}

// MD5:3858f62230ac3c915f300c664312c63f
const administratorName = 'Administrator';
const guestName = 'Guest';
</script>
