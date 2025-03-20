<template>
    <button 
        :disabled
        type="submit"
        class="flex justify-center items-center rounded-sm outline-none focus:outline-none border-slate-200 bg-blue-500  text-white font-bold p-2 ">
            <slot/>
        </button>
</template>

<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false
    }
})

</script>