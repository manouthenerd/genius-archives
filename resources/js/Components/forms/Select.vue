<template>
    <select v-model="model" class="rounded-sm outline-none focus:outline-none border-slate-200 w-full">
        <slot />
    </select>
</template>

<script setup>
const model = defineModel()
</script>