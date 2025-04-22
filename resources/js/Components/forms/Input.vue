<template>
    <input :type 
        required
        v-model="model"
        class="rounded-sm border-none outline-none focus:outline-none border-slate-200">
</template>

<script setup>

const props = defineProps({
    type: {
        type: String,
        default: 'text'
    },
    
    
})

const model = defineModel()
</script>