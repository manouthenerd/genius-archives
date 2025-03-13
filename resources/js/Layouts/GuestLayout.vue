<template>
    <section class="w-full h-screen grid justify-center items-center  bg-black">
        <div id="parent" :class="height" class="flex justify-center  rounded items-center h-[500px] p-2">
            <slot/>
        </div>
    </section>
</template>

<script setup>

defineProps({
    height: {
        type: String,
        default: 'h-[400px]'
    }
})
</script>