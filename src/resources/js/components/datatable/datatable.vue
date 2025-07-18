<script setup lang="ts" generic="TData, TValue">
import { h, ref } from 'vue';
import { valueUpdater } from '@/lib/utils';
import { Input } from '@/components/ui/input';
import DataTablePagination from '@/components/datatable/datatable-pagination.vue';
import DataTableColumnToggle from "@/components/datatable/datatable-column-toggle.vue";

import type {
    ColumnDef,
    ColumnFiltersState,
    SortingState,
    ExpandedState,
} from '@tanstack/vue-table';

import {
    FlexRender,
    getCoreRowModel,
    getPaginationRowModel,
    getFilteredRowModel,
    getSortedRowModel,
    getExpandedRowModel,
    useVueTable,
} from '@tanstack/vue-table';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

const props = defineProps<{
    columns: ColumnDef<TData, TValue>[]
    data: TData[]
}>()

const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const rowSelection = ref({})
const expanded = ref<ExpandedState>({})

const table = useVueTable({
    get data() { return props.data },
    get columns() { return props.columns },
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getExpandedRowModel: getExpandedRowModel(),
    onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
    onRowSelectionChange: updaterOrValue => valueUpdater(updaterOrValue, rowSelection),
    onExpandedChange: updaterOrValue => valueUpdater(updaterOrValue, expanded),
    state: {
        get sorting() { return sorting.value },
        get columnFilters() { return columnFilters.value },
        get rowSelection() { return rowSelection.value },
        get expanded() { return expanded.value },
    },
})
</script>

<template>
    <!-- Reference, filtering docs: https://tanstack.com/table/v8/docs/guide/filters   -->
    <div class="flex justify-normal items-center py-4">
        <Input class="max-w-sm" placeholder="Filter emails..."
               :model-value="table.getColumn('email')?.getFilterValue() as string"
               @update:model-value=" table.getColumn('email')?.setFilterValue($event)" />

        <DataTableColumnToggle :table="table" />
    </div>

    <div class="bg-white dark:bg-gray-800 border rounded-md py-2">
        <Table>
            <TableHeader>
                <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                    <TableHead v-for="header in headerGroup.headers" :key="header.id">
                        <FlexRender
                            v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                            :props="header.getContext()"
                        />
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="table.getRowModel().rows?.length">
                    <template v-for="row in table.getRowModel().rows" :key="row.id">
                        <TableRow :data-state="row.getIsSelected() ? 'selected' : undefined">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="row.getIsExpanded()">
                            <TableCell :colspan="row.getAllCells().length">
                                {{ JSON.stringify(row.original) }}
                            </TableCell>
                        </TableRow>
                    </template>
                </template>
                <template v-else>
                    <TableRow>
                        <TableCell :colspan="columns.length" class="h-24 text-center">
                            No results... Try again!
                        </TableCell>
                    </TableRow>
                </template>
            </TableBody>
        </Table>
    </div>
    <div class="bg-white dark:bg-gray-800 border rounded-md py-2">
        <DataTablePagination :table="table" />
    </div>
</template>
