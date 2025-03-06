<template>
    <select v-model="model" class="rounded-sm outline-none focus:outline-none border-slate-200">
        <slot />
    </select>
</template>

<script setup>
const model = defineModel()
</script>