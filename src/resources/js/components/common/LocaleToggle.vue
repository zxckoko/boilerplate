<template>
    <Select v-model="form.locale"
            :options="locales"
            optionLabel="name"
            optionValue="value"
            placeholder="Locale"
            class=""
            checkmark>
    </Select>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { watchThrottled } from "@vueuse/core";
import { loadLocaleMessages } from '@/i18n';
import Select from "primevue/select";

const page = usePage();

const form = useForm({
    locale: page.props.locale || 'en',
});

const locales = ref(page.props.locales.map(element => {
        return { name: element, value: element };
    })
);

watchThrottled(form,
    (form) => {
        loadLocaleMessages(form.locale);
        router.get(route('locale', form.locale), {},{ preserveState: true });
    },
    { throttle: 500 }
)
</script>
