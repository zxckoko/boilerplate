<template>
    <Head :title="form.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">Users</Link>
                <span class="text-indigo-400 font-medium">//</span>
                {{ form.name }}
            </h1>
        </template>

        <div class="max-w-full m-8">
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

                <Message v-if="form.errors?.message" severity="error" variant="simple">{{ form.errors.message }}</Message>
                <Button type="submit" severity="primary" label="Submit" />
            </Form>

            <div class="w-1/3">
                <Divider>//</Divider>
            </div>

            <ConfirmDeleteDialog :record="route('users.destroy', user.id)"></ConfirmDeleteDialog>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { Form } from '@primevue/forms';
import Message from 'primevue/message';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';

import Divider from 'primevue/divider';

import ConfirmDeleteDialog from "@/components/common/ConfirmDeleteDialog.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    address_1: props.user.address_1,
    address_2: props.user.address_2,
});
</script>
