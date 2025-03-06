<template>
    <p class="bg-yellow-500 size-[50px] flex justify-center items-center rounded-full font-bold capitalize">
        {{ userInitial() }}
    </p>
</template>

<script setup>
const props = defineProps({
    name: String
})

const userInitial = () => {

    const [first, last] = props.name ? props.name.split(' ') : "Guest User".split(' ')

    const userInitial = first[0] + last[0]

    return userInitial
}
</script>