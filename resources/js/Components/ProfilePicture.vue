<template>
    <p class="bg-yellow-500 size-[50px] flex justify-center items-center rounded-full font-bold capitalize">
        {{ firstname.at(0) + lastname.at(0) }}
    </p>
</template>

<script setup>
defineProps({
    firstname: String,
    lastname: String
})


</script>