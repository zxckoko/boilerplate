import { h } from 'vue';
import { ColumnDef } from '@tanstack/vue-table';
import DropdownAction from '@/components/datatable/datatable-dropdown.vue';
import DataTableColumnHeader from '@/components/datatable/datatable-header.vue';
import { Checkbox } from '@/components/ui/checkbox';

export const UserColumns: ColumnDef<Users>[] = [
// export const columns = [
    {
        id: 'select',
        header: ({ table }) => h(Checkbox, {
            'modelValue': table.getIsAllPageRowsSelected(),
            'onUpdate:modelValue': (value: boolean) => table.toggleAllPageRowsSelected(!!value),
            'ariaLabel': 'Select all',
        }),
        cell: ({ row }) => h(Checkbox, {
            'modelValue': row.getIsSelected(),
            'onUpdate:modelValue': (value: boolean) => row.toggleSelected(!!value),
            'ariaLabel': 'Select row',
        }),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: 'name',
        // header: () => h('div', { class: 'text-left font-medium' }, 'Name'),
        header: ({ column }) => (
            h(DataTableColumnHeader, {
                column: column,
                title: 'Name'
            })
        ),
        cell: ({ row }) => {
            return h('div', { class: 'text-left' }, row.getValue('name'))
        },
    },
    {
        accessorKey: 'email',
        header: ({ column }) => (
            h(DataTableColumnHeader, {
                column: column,
                title: 'Email Address'
            })
        ),
        cell: ({ row }) => {
            return h('div', { class: 'text-left' }, row.getValue('email'))
        },
    },
    {
        accessorKey: 'address_1',
        header: ({ column }) => (
            h(DataTableColumnHeader, {
                column: column,
                title: 'Address 1'
            })
        ),
        cell: ({ row }) => {
            return h('div', { class: 'text-left' }, row.getValue('address_1'))
        },
    },
    {
        accessorKey: 'address_2',
        header: ({ column }) => (
            h(DataTableColumnHeader, {
                column: column,
                title: 'Address 2'
            })
        ),
        cell: ({ row }) => {
            return h('div', { class: 'text-left' }, row.getValue('address_2'))
        },
    },
    {
        id: 'actions',
        enableHiding: false,
        header: ({ column }) => (
            h(DataTableColumnHeader, {
                column: column,
                title: 'Actions'
            })
        ),
        cell: ({ row }) => {
            // "columns.ts" file is model specific
            const record = row.original

            return h('div', { class: 'relative' }, h(DropdownAction, {
                record,
                onExpand: row.toggleExpanded,
            }))
        },
    },
]
