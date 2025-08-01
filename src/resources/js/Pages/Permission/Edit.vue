<template>
    <Head :title="form.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('roles.index')">Permissions</Link>
                <span class="text-indigo-400 font-medium">//</span>
                {{ form.name }}
            </h1>
            <ModelTimestamps :modelObject="permission" />
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Form @submit="form.patch(route('permissions.update', permission.id))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <FloatLabel variant="in">
                    <InputText class="w-full" id="name" type="text" v-model="form.name" autofocus />
                    <label for="name">Name</label>
                </FloatLabel>

                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" icon="pi pi-save" label="Submit" />
            </Form>

            <ConfirmDeleteDialog
                v-if="permission.deleted_at === null && can('permissions.destroy')"
                :record="route('permissions.destroy', permission.id)"
            />

            <ConfirmRestoreDialog
                v-if="permission.deleted_at !== null && can('restoreRecord')"
                :record="route('permissions.restore', permission.id)"
            />

            <ActivityLog :activities="activities" />
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Form } from '@primevue/forms';
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import FloatLabel from "primevue/floatlabel";

import ConfirmDeleteDialog from "@/components/common/ConfirmDeleteDialog.vue";
import ConfirmRestoreDialog from "@/components/common/ConfirmRestoreDialog.vue";
import ModelTimestamps from "@/components/common/ModelTimestamps.vue";
import ActivityLog from "@/components/common/ActivityLog.vue";
import { can } from "@/lib/can";

const props = defineProps({
    permission: Object,
    activities: Object,
});

const form = useForm({
    name: props.permission.name,
});
</script>
