<script setup lang="ts">
import { ref, watch } from 'vue'
import { useColorMode } from "@vueuse/core";
import ToggleSwitch from 'primevue/toggleswitch';

const mode = useColorMode({ disableTransition: false })
const isDark = ref(mode.value === 'dark')

watch(isDark, (dark) => {
    mode.value = dark ? 'dark' : 'light';
})
</script>

<template>
    <ToggleSwitch v-model="isDark">
        <template #handle="{ checked }">
            <i :class="['!text-xs pi', { 'pi-moon': checked, 'pi-sun': !checked }]" />
        </template>
    </ToggleSwitch>
</template>
