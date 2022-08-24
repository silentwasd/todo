<script setup>
import TodoCheckbox from "@/Components/Todo/TodoCheckbox.vue";

const props = defineProps({
    items: {
        type: Array
    },
    csrf_token: {
        type: String
    }
});

async function onCheckedUpdate(id, value) {
    const response = await fetch(`/todo/update/${id}`, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            value,
            _token: props.csrf_token
        })
    });

    if (!response.ok) {
        console.error(`Something wrong with updating todo item #${id}!`);
        console.error(response.statusText);
        return;
    }

    console.log(await response.json());
}
</script>

<template>
    <div class="flex justify-center">
        <ul>
            <li v-for="item in items" :key="item.id">
                <TodoCheckbox :label="item.name"
                              v-model:checked="item.is_checked"
                              @update:checked="onCheckedUpdate(item.id, $event)" />
            </li>
        </ul>
    </div>
</template>
