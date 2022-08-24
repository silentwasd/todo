<script setup>
import TodoCheckbox from "@/Components/Todo/TodoCheckbox.vue";
import Button from "@/Components/Button.vue";
import {usePage} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['removed']);

const props = defineProps({
    item: {
        type: Object
    }
});

async function onCheckedUpdate(value) {
    const response = await fetch(`/todo/update/${props.item.id}`, {
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
        console.error(`Something wrong with updating todo item #${props.item.id}!`);
        console.error(response.statusText);
    }
}

async function remove() {
    const response = await fetch(`/todo/remove/${props.item.id}`, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            _token: usePage().props.value.csrf_token
        })
    });

    if (!response.ok) {
        console.error(`Something wrong with removing todo item #${props.item.id}!`);
        console.error(response.statusText);
        return;
    }

    emit('removed', props.item);
}
</script>

<template>
    <div class="flex mb-4 items-center justify-between item">
       <TodoCheckbox :label="item.name"
                     v-model:checked="item.is_checked"
                     @update:checked="onCheckedUpdate" />


        <div class="flex actions">
            <Button class="bg-rose-600 hover:bg-rose-800" @click="remove">Remove</Button>
        </div>
    </div>
</template>

<style>
.item .actions {
    transition: opacity .5s;
    opacity: 0;
    visibility: hidden;
}

.item:hover .actions {
    transition: opacity .5s;
    opacity: 1;
    visibility: visible;
}
</style>
