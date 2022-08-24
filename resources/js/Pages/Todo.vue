<script setup>
import TodoNewItem from "@/Components/Todo/TodoNewItem.vue";
import TodoItem from "@/Components/Todo/TodoItem.vue";
import TodoRenameItem from "@/Components/Todo/TodoRenameItem.vue";
import {reactive} from "vue";

const props = defineProps({
    items: {
        type: Array
    }
});

const state = reactive({
    items: [],
    renameItem: null
});

state.items = props.items.slice();

function onNewItem(item) {
    state.items.push(item);
}

function onItemRemoved(item) {
    state.items.splice(state.items.findIndex(_item => _item.id === item.id), 1);
}
</script>

<template>
    <div class="flex justify-center py-10">
        <div class="flex flex-col w-480 gap-3">
            <TodoNewItem v-show="state.renameItem === null"
                         @added="onNewItem" />

            <TodoRenameItem v-if="state.renameItem !== null"
                            :item="state.renameItem"
                            @renamed="state.renameItem = null" />

            <ul>
                <li v-for="item in state.items" :key="item.id">
                    <TodoItem :item="item"
                              @removed="onItemRemoved"
                              @wantRename="state.renameItem = $event" />
                </li>
            </ul>
        </div>
    </div>
</template>
