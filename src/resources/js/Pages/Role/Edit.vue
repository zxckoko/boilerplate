<template>
    <Head :title="form.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('roles.index')">Roles</Link>
                <span class="text-indigo-400 font-medium">//</span>
                {{ form.name }}
            </h1>
            <ModelTimestamps :modelObject="role" />
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Form @submit="form.patch(route('roles.update', role.id))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <FloatLabel variant="in">
                    <InputText class="w-full" id="name" type="text" v-model="form.name" autofocus />
                    <label for="name">Name</label>
                </FloatLabel>

                <fieldset class="border border-2 p-2" :disabled="canFoobarData">
                    <legend class="border text-xs text-gray-400 py-1 px-1 mb-2 ml-2">
                        <div class="flex items-center gap-2">
                            <span>Permissions</span><i v-if="canFoobarData" class="pi pi-ban text-secondary"></i>
                        </div>
                    </legend>
                    <div class="w-full grid grid-cols-2 items-center gap-4">
                        <div v-for="permission of permissions" :key="permission" class="flex gap-2">
                            <Checkbox v-model="form.permissions" :inputId="permission" :value="permission" />
                            <label class="cursor-pointer" :for="permission">{{ permission }}</label>
                        </div>
                    </div>
                </fieldset>

                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" icon="pi pi-save" label="Submit" />
            </Form>

            <div v-if="can('roles.destroy')">
                <div class="w-1/3">
                    <Divider>//</Divider>
                </div>

                <ConfirmDeleteDialog :record="route('roles.destroy', role.id)"></ConfirmDeleteDialog>
            </div>

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
import FloatLabel from 'primevue/floatlabel';
import Divider from 'primevue/divider';
import Checkbox from "primevue/checkbox";

import ConfirmDeleteDialog from "@/components/common/ConfirmDeleteDialog.vue";
import ModelTimestamps from "@/components/common/ModelTimestamps.vue";
import ActivityLog from "@/components/common/ActivityLog.vue";
import { can } from "@/lib/can";

const canFoobarData = ! can('foobar');

const props = defineProps({
    role: Object,
    permissions: Array,
    rolePermissions: Array,
    activities: Object,
});

const form = useForm({
    name: props.role.name,
    permissions: props.rolePermissions || [],
});
</script>
