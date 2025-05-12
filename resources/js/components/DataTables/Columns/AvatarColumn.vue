<script lang="ts" setup generic="TValue">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import type { DataItem } from '@/types/data-table';

defineProps<{
    item: TValue;
    fallbackName: DataItem;
}>();

function getFallbackName(item: DataItem) {
    if (item.name) {
        return item.name;
    }
    if (item.username) {
        return item.username;
    }

    return item;
}
</script>

<template>
    <Avatar>
        <AvatarImage v-if="item" :src="item as string" :alt="getFallbackName(item)" />
        <AvatarFallback>{{ getFallbackName(item) }}</AvatarFallback>
    </Avatar>
</template>
