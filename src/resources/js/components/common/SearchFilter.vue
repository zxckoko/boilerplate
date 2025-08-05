<template>
    <div class="flex items-center">
        <div class="flex w-full rounded shadow">
            <InputGroup>
                <InputGroupAddon>
                    <i class="pi pi-filter"></i>
                </InputGroupAddon>

                <Select v-model="form.trashed"
                        :options="options"
                        optionLabel="name"
                        optionValue="value"
                        placeholder="Filter"
                        class="">
                </Select>

                <InputText type="text" v-model="form.search" class="rounded shadow" />

                <InputGroupAddon>
                    <Button @click="reset()" icon="pi pi-undo" severity="secondary" label=""/>
                </InputGroupAddon>
            </InputGroup>
        </div>

    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { router, usePage, useForm } from "@inertiajs/vue3";
import { watchThrottled } from '@vueuse/core';
import Select from 'primevue/select';
import InputText from 'primevue/inputtext';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import Button from 'primevue/button';


const props = defineProps({
    filters: Object,
});

const page = usePage();
const form = useForm({
    search: props.filters.search,
    trashed: props.filters.trashed,
});

const options = ref([
    { name: 'With trashed', value: 'with' },
    { name: 'Only trashed', value: 'only' },
]);

watchThrottled(form,
    (form) => {
        let data = ((form.search?.length === 0 || form.search == null) && form.trashed == null)
            ? {}
            : {'search': form.search, 'trashed': form.trashed };
        router.get(page.url.split('?')[0], data,{ preserveState: true });
    },
    { throttle: 500 }
)

const reset = () => {
    form.reset();
}
</script>
