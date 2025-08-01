<template>
    <p class="text-xs">Created by: {{ modelObject.created_by.name + ", " + modelObject.created_at_formatted }}</p>
    <p class="text-xs">Updated by: {{ modelObject.updated_by.name + ", " + modelObject.updated_at_formatted }}</p>
    <p v-if="modelObject.deleted_at_formatted" class="text-xs text-rose-400">
        Deleted by: {{ modelObject.deleted_by.name + ", " + modelObject.deleted_at_formatted }}
    </p>
</template>

<script lang="ts" setup>
const props = defineProps({
    modelObject: Object,
});
</script>
