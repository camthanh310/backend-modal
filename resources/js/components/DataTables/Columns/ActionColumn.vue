<script lang="ts" setup generic="TValue">
import { Button } from '@/components/ui/button';
import { Action } from '@/types/data-table';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    item: TValue;
}>();

const actions = computed(() => props.item as Action[]);
</script>

<template>
    <div class="flex space-x-1">
        <template v-for="(action, $index) in actions" :key="$index">
            <Button v-if="action.actionType === 'url'" variant="link" as-child>
                <Link :href="action.action as string">{{ action.label }}</Link>
            </Button>
            <Button v-if="action.actionType === 'modal'" variant="link">Edit with modal</Button>
        </template>
    </div>
</template>
