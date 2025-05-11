<script lang="ts" setup generic="TValue">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import type { Item } from '@/types/data-table';

defineProps<{
    item: TValue;
    fallbackName: Item;
}>();

function getFallbackName(item: Item) {
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
