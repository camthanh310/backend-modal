<script lang="ts" setup generic="TValue">
defineProps<{
    item: TValue;
}>();
</script>

<template>
    <div>
        {{ item }}
    </div>
</template>
