<template>
    <p class="text-xs">Created by: {{ modelObject.created_by.name + ", " + modelObject.created_at_formatted }}</p>
    <p class="text-xs">Updated by: {{ modelObject.updated_by.name + ", " + modelObject.updated_at_formatted }}</p>
</template>

<script lang="ts" setup>
const props = defineProps({
    modelObject: Object,
});
</script>
