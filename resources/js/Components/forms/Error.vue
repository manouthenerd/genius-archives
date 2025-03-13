<template>
    <p class="text-xs text-red-600">
        {{ message }}
    </p>
</template>

<script setup>
defineProps({
    message: {
        type: String,
    }
})
</script>