<template>
    <input 
        @click="$emit('click-event')"
        :value
        type="submit"
        class="rounded-sm outline-none focus:outline-none border-slate-200 bg-blue-500 opacity-85 hover:opacity-100 text-white font-bold p-2 ">
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        default: 'text'
    },
    value: {
        type: String
    }
    
})

</script>