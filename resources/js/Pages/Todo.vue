<script setup>
import TodoCheckbox from "@/Components/Todo/TodoCheckbox.vue";
</script>

<template>
    <div class="flex justify-center">
        <ul>
            <li>
                <TodoCheckbox label="Todo todo" />
            </li>

            <li>
                <TodoCheckbox label="Todo another todo" />
            </li>

            <li>
                <TodoCheckbox label="Todo some todo" />
            </li>
        </ul>
    </div>
</template>
