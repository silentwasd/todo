<script setup>
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import {reactive, watchEffect} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['renamed']);

const props = defineProps({
    item: {
        type: Object
    }
});

const state = reactive({
    name: ''
});

watchEffect(async () => {
    state.name = props.item.name;
});

async function rename() {
    const response = await fetch(`/todo/rename/${props.item.id}`, {
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

    props.item.name = state.name;
    emit('renamed');
}
</script>

<template>
    <div class="flex gap-3 w-full">
        <Input v-model="state.name" class="flex-1 px-3" />
        <Button @click="rename">Rename</Button>
    </div>
</template>
