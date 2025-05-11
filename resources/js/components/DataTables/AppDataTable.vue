<script lang="ts" setup generic="TData">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import type { DataTableProps, Item } from '@/types/data-table';
import AppPagination from './AppPagination.vue';
import ActionColumn from './Columns/ActionColumn.vue';
import AvatarColumn from './Columns/AvatarColumn.vue';
import TextColumn from './Columns/TextColumn.vue';

interface Props {
    resource: DataTableProps<TData>;
    primaryKey?: string;
}

const props = defineProps<Props>();

function getRowItem(item: Item) {
    if (props.primaryKey) {
        return props.primaryKey;
    }

    if (item.id) {
        return item.id;
    }

    return item;
}
</script>

<template>
    <div class="mx-4">
        <div class="w-full">
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead v-for="column in resource.columns" :key="column.accessorKey">
                                <template v-if="!column.notVisibled">
                                    {{ column.header }}
                                </template>

                                <span v-else class="sr-only">
                                    {{ column.header }}
                                </span>
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="resource.response.data.length">
                            <TableRow v-for="item in resource.response.data" :key="getRowItem(item)">
                                <TableCell v-for="column in resource.columns" :key="column.accessorKey">
                                    <TextColumn v-if="column.format === 'TextColumn'" :item="item[column.accessorKey]" />
                                    <AvatarColumn v-if="column.format === 'AvatarColumn'" :item="item[column.accessorKey]" :fallback-name="item" />
                                    <ActionColumn v-if="column.format === 'ActionColumn'" :item="item[column.accessorKey]" />
                                </TableCell>
                            </TableRow>
                        </template>

                        <TableRow v-else>
                            <TableCell :colspan="resource.columns.length" class="h-24 text-center"> No results. </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>

            <AppPagination v-if="resource.response.links" :links="resource.response.links" />
        </div>
    </div>
</template>
