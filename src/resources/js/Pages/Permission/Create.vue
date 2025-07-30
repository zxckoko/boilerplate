<template>
    <Head title="Create Permission" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('permissions.index')">Permissions</Link>
                <span class="text-indigo-400 font-medium">//</span>
                Create {{ form.name }}
            </h1>
        </template>

        <div class="max-w-full m-8 mb-0 pb-8">
            <Form @submit="form.post(route('permissions.store'))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <FloatLabel variant="in">
                    <InputText class="w-full" id="name" type="text" v-model="form.name" autofocus />
                    <label for="name">Name</label>
                </FloatLabel>

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
import FloatLabel from "primevue/floatlabel";

const form = useForm({
    name: null,
});
</script>
