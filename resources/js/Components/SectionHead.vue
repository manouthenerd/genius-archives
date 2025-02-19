<template>
    <p class="p-1 inline-table text-sm bg-black text-white font-bold">{{ title }}</p>
</template>

<script setup>

defineProps({
    title: {
        type: String,
        required: true
    }
})
</script>