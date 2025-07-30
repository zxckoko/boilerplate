<template>
    <Button @click="destroy(record)" type="button" icon="pi pi-exclamation-circle" severity="danger" label="Delete User" variant="simple" class="w-1/3" outlined />
    <ConfirmDialog></ConfirmDialog>
</template>
<script lang="ts" setup>
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";
import { router } from "@inertiajs/vue3";
import Button from "primevue/button";
const confirm = useConfirm();

const props = defineProps({
    record: String
});

const destroy = (record) => {
    confirm.require({
        message: 'Are you sure you want to proceed?',
        header: 'Confirmation',
        accept: () => {
            router.delete(record)
        },
        icon: 'pi pi-exclamation-circle',
        acceptIcon: 'pi pi-check',
        acceptClass: 'p-button-danger',
        rejectClass: 'p-button-secondary',
    });
}
</script>
