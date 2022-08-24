<script setup>
import TodoCheckbox from "@/Components/Todo/TodoCheckbox.vue";

const props = defineProps({
    items: {
        type: Array
    }
});
</script>

<template>
    <div class="flex justify-center">
        <ul>
            <li v-for="item in items" :key="item.id">
                <TodoCheckbox :label="item.name" v-model:checked="item.is_checked" />
            </li>
        </ul>
    </div>
</template>
