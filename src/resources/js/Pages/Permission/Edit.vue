<template>
    <Head title="Edit Permission" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Edit Permission
            </h2>
        </template>

        <div class="max-w-full m-8">
            <Form @submit="form.patch(route('permissions.update', permission.id))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <InputText type="text" placeholder="Permission" v-model="form.name" autofocus />
                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <Button type="submit" severity="primary" label="Submit" />
            </Form>
            <Form @submit="form.delete(route('permissions.destroy', permission.id))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <Button type="submit" severity="danger" label="Delete Role" variant="simple" outlined />
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

const props = defineProps({
    permission: Object
});

const form = useForm({
    name: props.permission.name,
});
</script>
