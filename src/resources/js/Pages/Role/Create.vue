<template>
    <Head title="Create Role" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('roles.index')">Roles</Link>
                <span class="text-indigo-400 font-medium">//</span>
                Create {{ form.name }}
            </h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Form @submit="form.post(route('roles.store'))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <FloatLabel variant="in">
                    <InputText class="w-full" id="name" type="text" v-model="form.name" autofocus />
                    <label for="name">Name</label>
                </FloatLabel>

                <div class="w-full grid grid-cols-2 items-center gap-4">
                    <div v-for="permission of permissions" :key="permission" class="flex gap-2">
                        <Checkbox v-model="form.permissions" :inputId="permission" :value="permission" />
                        <label class="cursor-pointer" :for="permission">{{ permission }}</label>
                    </div>
                </div>

                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" icon="pi pi-save" label="Submit" />
            </Form>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Form, FormField } from '@primevue/forms';
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Checkbox from 'primevue/checkbox';
import FloatLabel from "primevue/floatlabel";

defineProps({
    permissions: Array
});

const form = useForm({
    name: null,
    permissions: [],
});
</script>
