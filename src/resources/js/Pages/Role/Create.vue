<template>
    <Head title="Create Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Create Role
            </h2>
        </template>

        <div class="max-w-full m-8">
            <Form @submit="form.post(route('roles.store'))" class="flex flex-col space-y-4 max-w-1/3 my-2">
                <InputText type="text" placeholder="Role" v-model="form.name" autofocus />
                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>

                <div v-for="permission of permissions" :key="permission" class="flex items-center gap-2">
                    <Checkbox v-model="form.permissions" :inputId="permission" name="permission" :value="permission" />
                    <label class="cursor-pointer" :for="permission">{{ permission }}</label>
                </div>

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
import Checkbox from 'primevue/checkbox';

defineProps({
    permissions: Array
});

const form = useForm({
    name: null,
    permissions: [],
});
</script>
