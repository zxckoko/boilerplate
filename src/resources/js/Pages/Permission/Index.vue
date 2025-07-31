<template>
    <Head title="Permissions" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">Permissions</h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <div class="flex items-center justify-between mb-6">
                <p>Search and Filter placeholder</p>
                <Button v-if="can('permissions.create')" as="a" type="button" severity="primary" label="Create Permission" :href="route('permissions.create')" />
            </div>

            <Message v-if="$page.props.flash.message" :life=3000 severity="success" icon="pi pi-check" class="mb-6">
                {{ $page.props.flash.message }}
            </Message>

            <table class="table-auto w-full mb-6 border-collapse border border-gray-600">
                <thead class="bg-white dark:bg-gray-800">
                    <tr class="text-left font-bold">
                        <th class="border border-gray-600 p-4">Name</th>
                        <th class="border border-gray-600 p-4">Created By</th>
                        <th class="border border-gray-600 p-4" colspan="2">Updated By</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700">
                    <tr v-for="permission in permissions.data" :key="permission.id" class="hover:bg-gray-900 dark:hover:bg-gray-900 focus-within:bg-gray-900">
                        <td class="border-t">
                            <Link v-if="can('permissions.edit')" class="flex items-center p-2 focus:text-indigo-500" :href="route('permissions.edit', permission.id)">
                                {{ permission.name }}
                            </Link>
                            <span v-else class="flex items-center p-2">
                            {{ permission.name }}
                        </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('permissions.edit')" class="flex items-center p-2" :href="route('permissions.edit', permission.id)" tabindex="-1">
                                {{ permission.created_by.name + " @ " + permission.created_at_formatted }}
                            </Link>
                            <span v-else class="flex items-center p-2">
                            {{ permission.created_by.name + " @ " + permission.created_at_formatted }}
                        </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('permissions.edit')" class="flex items-center p-2" :href="route('permissions.edit', permission.id)" tabindex="-1">
                                {{ permission.updated_by.name + " @ " + permission.updated_at_formatted }}
                            </Link>
                            <span v-else class="flex items-center p-2">
                            {{ permission.updated_by.name + " @ " + permission.updated_at_formatted }}
                        </span>
                        </td>
                        <td class="border-t">
                            <Link v-if="can('permissions.edit')" class="flex items-center p-2" :href="route('permissions.edit', permission.id)" tabindex="-1">
                                <i class="pi pi-angle-double-right w-8 h-8 text-sky-400"></i>
                            </Link>
                            <span v-else class="flex items-center p-2">
                            <i class="pi pi-ban w-8 h-8 text-secondary"></i>
                        </span>
                        </td>
                    </tr>
                    <tr v-if="permissions.data.length === 0">
                        <td class="border-t" colspan="4">No permissions found... Try again!</td>
                    </tr>
                </tbody>
            </table>
            <Pagination :links="permissions.links" class="mb-6" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from "@inertiajs/vue3";
import Message from "primevue/message";
import Pagination from "@/components/common/Pagination.vue";
import Button from "primevue/button";
import {can} from "@/lib/can";
</script>

<script lang="ts">
export default {
    components: {
        Pagination,
    },
    props: {
        permissions: Object,
        created_by: Object,
        updated_by: Object,
    },
}
</script>
