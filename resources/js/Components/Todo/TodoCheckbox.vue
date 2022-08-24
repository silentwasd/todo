<script setup>
import {computed, reactive} from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        default: null,
    },
    label: {
        type: String,
        default: 'Checkbox'
    }
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});

const state = reactive({
    componentId: window.chance.guid()
});
</script>

<template>
    <div class="flex items-center">
        <input :id="state.componentId" type="checkbox" :value="value" v-model="proxyChecked"
               class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
        <label :for="state.componentId" class="ml-2 text-xl font-medium text-gray-900 select-none">{{ label }}</label>
    </div>
</template>
