<script setup>
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import {reactive} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['added']);

const state = reactive({
    name: ''
});

async function add() {
    const response = await fetch('/todo/add', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: state.name,
            _token: usePage().props.value.csrf_token
        })
    });

    if (!response.ok) {
        return;
    }

    const newItem = await response.json();
    emit('added', newItem);
    state.name = '';
}
</script>

<template>
    <div class="flex gap-3 w-full">
        <Input v-model="state.name"
               placeholder="New todo"
               class="flex-1 px-3"
               @keydown.enter="add" />
        <Button @click="add">Add</Button>
    </div>
</template>
