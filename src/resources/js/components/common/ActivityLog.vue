<template>
    <div v-if="activities.length !== 0">
        <fieldset class="border border-2 px-4 my-4">
            <legend class="border text-xs text-gray-400 py-1 px-1 mb-2 ml-2">
                <div class="flex items-center gap-2">
                    <span>Audit Log</span><i class="pi pi-book text-indigo-400"></i>
                </div>
            </legend>

            <div v-for="activity in activities">
                <div class="p-2">
                    <span v-if="activity.properties.length !== 0">
                        {{ activity.properties }}
                    </span>
                    <span v-else>{{ activity.description }}</span>
                    [<span class="text-xs text-emerald-400">{{ activity.event }}</span>]
                    [<span class="text-xs text-indigo-400">{{ activity.created_by?.name + " @ " + activity.created_at_formatted }}</span>]
                </div>
            </div>
        </fieldset>
    </div>
</template>

<script lang="ts" setup>
const props = defineProps({
    activities: Object,
});
</script>
