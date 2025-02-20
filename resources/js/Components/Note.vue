<template>
    <p class="w-full p-[2px] rounded text-justify text-nowrap bg-[#ffa5005e] grid">
        <span class="flex items-center text-xs font-bold uppercase"><img src="/icons/danger.svg" alt="danger icon">Note</span>
        <span id="text" class="overflow-scroll scrollbar-hide">
            {{ text }}
        </span>
    </p>
</template>

<script setup>

defineProps({
    text: {
        type: String,
        required: true
    }
})
</script>

<style>
#text::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#text {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>