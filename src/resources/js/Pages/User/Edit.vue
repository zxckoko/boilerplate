<template>
    <Head :title="form.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">Users</Link>
                <span class="text-indigo-400 font-medium">//</span>
                {{ form.name }}
                <Button v-if="$page.props.auth.impersonator === null" as="a" :href="route('impersonate', user.id)">
                    <UserRoundCog />
                </Button>
            </h1>
            <ModelTimestamps :modelObject="user" />
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Form @submit="form.patch(route('users.update', user.id))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <FloatLabel variant="in">
                    <InputText class="w-full" id="name" type="text" v-model="form.name" autofocus />
                    <label for="name">Name</label>
                </FloatLabel>
                <FloatLabel variant="in">
                    <InputText class="w-full" id="email " type="text" v-model="form.email" />
                    <label for="email">Email Address</label>
                </FloatLabel>
                <FloatLabel variant="in">
                    <InputText class="w-full" id="address_1" type="text" v-model="form.address_1" />
                    <label for="address_1">Address #1</label>
                </FloatLabel>
                <FloatLabel variant="in">
                    <InputText class="w-full" id="address_2" type="text" v-model="form.address_2" />
                    <label for="address_2">Address #2</label>
                </FloatLabel>

                <fieldset class="border border-2 p-2" :disabled="canEditUserRoles">
                    <legend class="border text-xs text-gray-400 py-1 px-1 mb-2 ml-2">
                        <div class="flex items-center gap-2">
                            <span>Roles</span><i v-if="canEditUserRoles" class="pi pi-ban text-secondary"></i>
                        </div>
                    </legend>
                    <div class="w-full grid grid-cols-2 items-center gap-4">
                        <div v-for="role of roles" :key="role" class="flex gap-2">
                            <Checkbox v-model="form.roles" :inputId="role" :value="role" />
                            <label class="cursor-pointer" :for="role">{{ role }}</label>
                        </div>
                    </div>
                </fieldset>

                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" icon="pi pi-save" label="Submit" />
            </Form>

            <ConfirmDeleteDialog
                v-if="user.deleted_at === null && can('users.destroy')"
                :record="route('users.destroy', user.id)"
            />

            <ConfirmRestoreDialog
                v-if="user.deleted_at !== null && can('restoreRecord')"
                :record="route('users.restore', user.id)"
            />

            <ActivityLog :activities="activities" />
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Form } from '@primevue/forms';
import { UserRoundCog } from "lucide-vue-next";
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import FloatLabel from 'primevue/floatlabel';
import Checkbox from "primevue/checkbox";

import ConfirmDeleteDialog from "@/components/common/ConfirmDeleteDialog.vue";
import ConfirmRestoreDialog from "@/components/common/ConfirmRestoreDialog.vue";
import ModelTimestamps from "@/components/common/ModelTimestamps.vue";
import ActivityLog from "@/components/common/ActivityLog.vue";
import { can } from "@/lib/can";

const canEditUserRoles = ! can('editUserRoles');

const props = defineProps({
    user: Object,
    userRoles: Array,
    roles: Array,
    activities: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    address_1: props.user.address_1,
    address_2: props.user.address_2,
    roles: props.userRoles || [],
});
</script>
