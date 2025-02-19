<template>
    <Link :href class="flex rounded-md shadow-sm gap-1 p-1 items-center h-[25px] bg-[lightGray]">
    {{ title }}
    <img src="/icons/tag.svg" alt="tag icon">
    <span
        class="flex justify-center text-[14px] items-center min-h-[20px] min-w-[20px] rounded-full bg-[darkOrange]">{{ counter }}</span>
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
        required: true
    },
    counter: {
        type: Number,
        required: true
    },
    href: {
        type: String,
        required: true
    }
})
</script>

<style scoped>

a {
    box-shadow: 1px 1px 1px #000;
}
</style>