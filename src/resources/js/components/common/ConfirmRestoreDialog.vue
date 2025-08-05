<template>
    <div class="w-1/3">
        <Divider>//</Divider>
    </div>
    <Button @click="restore(record)" type="button" icon="pi pi-undo" severity="warn" label="Restore"
            variant="simple" class="w-1/3" />
    <ConfirmDialog></ConfirmDialog>
</template>
<script lang="ts" setup>
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from "primevue/useconfirm";
import { router } from "@inertiajs/vue3";
import Button from "primevue/button";
import Divider from "primevue/divider";
const confirm = useConfirm();

const props = defineProps({
    record: String
});

const restore = (record) => {
    confirm.require({
        message: 'Are you sure you want to proceed?',
        header: 'Confirmation',
        accept: () => {
            router.patch(record)
        },
        icon: 'pi pi-undo',
        acceptIcon: 'pi pi-check',
        acceptClass: 'p-button-warn',
        rejectClass: 'p-button-secondary',
    });
}
</script>
