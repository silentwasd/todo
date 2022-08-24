<script setup>
import TodoCheckbox from "@/Components/Todo/TodoCheckbox.vue";
import TodoNewItem from "@/Components/Todo/TodoNewItem.vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";

const props = defineProps({
    items: {
        type: Array
    }
});

const state = reactive({
    items: []
});

state.items = props.items.slice();

async function onCheckedUpdate(id, value) {
    const response = await fetch(`/todo/update/${id}`, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            value,
            _token: usePage().props.value.csrf_token
        })
    });

    if (!response.ok) {
        console.error(`Something wrong with updating todo item #${id}!`);
        console.error(response.statusText);
    }
}

function onNewItem(item) {
    state.items.push(item);
}
</script>

<template>
    <div class="flex justify-center py-10">
        <div class="flex flex-col w-400 gap-3">
            <TodoNewItem @added="onNewItem" />

            <ul>
                <li v-for="item in state.items" :key="item.id">
                    <TodoCheckbox :label="item.name"
                                  v-model:checked="item.is_checked"
                                  @update:checked="onCheckedUpdate(item.id, $event)" />
                </li>
            </ul>
        </div>
    </div>
</template>
