<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">Roles</h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <div class="flex items-center justify-between mb-6">
                <p>Search and Filter placeholder</p>
                <Button v-if="can('roles.create')" as="a" type="button" severity="primary" label="Create Role" :href="route('roles.create')" />
            </div>

            <Message v-if="$page.props.flash.message" :life=3000 severity="success" icon="pi pi-check" class="mb-6">
                {{ $page.props.flash.message }}
            </Message>

            <table class="table-auto w-full mb-6 border-collapse border border-gray-600">
                <thead class="bg-white dark:bg-gray-800">
                    <tr class="text-left font-bold">
                        <th class="border border-gray-600 p-4">Name</th>
                        <th class="border border-gray-600 p-4">Permissions</th>
                        <th class="border border-gray-600 p-4">Created By</th>
                        <th class="border border-gray-600 p-4" colspan="2">Updated By</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                    <tr v-for="role in roles.data" :key="role.id" class="hover:bg-gray-900 dark:hover:bg-gray-900 focus-within:bg-gray-900">
                        <td class="border-t">
                            <Link v-if="can('roles.edit')" class="flex items-center p-2 gap-2 focus:text-indigo-500" :href="route('roles.edit', role.id)">
                                {{ role.name }}<i class="pi pi-trash text-secondary" v-if="role.deleted_at_formatted"></i>
                            </Link>
                            <span v-else class="flex items-center p-2">
                                {{ role.name }}<i class="pi pi-trash text-secondary" v-if="role.deleted_at_formatted"></i>
                            </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('roles.edit')" class="flex flex-wrap items-center p-2" :href="route('roles.edit', role.id)" tabindex="-1">
                                <Badge
                                    v-for="permission in role.permissions"
                                    severity="info"
                                    class="m-1"
                                >
                                    {{ permission.name }}
                                </Badge>
                            </Link>
                            <div v-else class="flex flex-wrap items-center p-2">
                                <Badge
                                    v-for="permission in role.permissions"
                                    severity="info"
                                    class="m-1"
                                >
                                    {{ permission.name }}
                                </Badge>
                            </div>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('roles.edit')" class="flex items-center p-2" :href="route('roles.edit', role.id)" tabindex="-1">
                                {{ role.created_by.name + " @ " + role.created_at_formatted }}
                            </Link>
                            <span v-else class="flex items-center p-2">
                                {{ role.created_by.name + " @ " + role.created_at_formatted }}
                            </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('roles.edit')" class="flex items-center p-2" :href="route('roles.edit', role.id)" tabindex="-1">
                                {{ role.updated_by.name + " @ " + role.updated_at_formatted }}
                            </Link>
                            <span v-else class="flex items-center p-2">
                                {{ role.updated_by.name + " @ " + role.updated_at_formatted }}
                            </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('roles.edit')" class="flex items-center p-2" :href="route('roles.edit', role.id)" tabindex="-1">
                                <i class="pi pi-angle-double-right w-8 h-8 text-sky-400"></i>
                            </Link>
                            <span v-else class="flex items-center p-2">
                                <i class="pi pi-ban w-8 h-8 text-secondary"></i>
                            </span>
                        </td>
                    </tr>
                    <tr v-if="roles.data.length === 0">
                        <td class="border-t" colspan="4">No roles found... Try again!</td>
                    </tr>
                </tbody>
            </table>

            <Pagination :links="roles.links" class="mb-6"/>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from "@inertiajs/vue3";
import { ChevronsRight } from "lucide-vue-next";
import Message from "primevue/message";
import Badge from 'primevue/badge';
import Pagination from "@/components/common/Pagination.vue";
import Button from "primevue/button";
import { can } from "@/lib/can";
</script>

<script lang="ts">
export default {
    components: {
        Pagination,
    },
    props: {
        roles: Object,
        created_by: Object,
        updated_by: Object,
    },
}
</script>
