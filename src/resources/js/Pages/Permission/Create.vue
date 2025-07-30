<template>
    <Head title="Create Permission" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Create Permission
            </h2>
        </template>

        <div class="max-w-full m-8">
            <Form @submit="form.post(route('permissions.store'))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <InputText type="text" placeholder="Role" v-model="form.name" autofocus />
                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" label="Submit" />
            </Form>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Form, FormField } from '@primevue/forms';
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const form = useForm({
    name: null,
});
</script>
