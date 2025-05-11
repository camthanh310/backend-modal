<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import type { Link as PaginationLink } from '@/types/data-table';
import { Link } from '@inertiajs/vue3';

interface Props {
    links: PaginationLink;
}

defineProps<Props>();
</script>

<template>
    <div class="flex items-center justify-end space-x-2 py-4">
        <div class="text-muted-foreground flex-1 text-sm">
            <!-- {{ table.getFilteredSelectedRowModel().rows.length }} of {{ table.getFilteredRowModel().rows.length }} row(s) selected. -->
        </div>
        <div class="space-x-2">
            <Button variant="outline" size="sm" as-child :disabled="!links.prev">
                <Link v-if="links.prev" :href="links.prev">Previous</Link>
                <span class="cursor-not-allowed" v-else>Previous</span>
            </Button>
            <Button variant="outline" size="sm" as-child :disabled="!links.next">
                <Link v-if="links.next" :href="links.next">Next</Link>
                <span class="cursor-not-allowed" v-else> Next </span>
            </Button>
        </div>
    </div>
</template>
