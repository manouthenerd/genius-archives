<template>
    <label class="flex flex-col gap-2 w-8" id="navbar-button">
        <input class="peer hidden" type="checkbox" @click="toggleNavbarPosition"/>
        <div
            class="rounded-2xl h-[3px] w-1/2 bg-black duration-500 peer-checked:rotate-[225deg] origin-right peer-checked:-translate-x-[12px] peer-checked:-translate-y-[1px]">
        </div>
        <div class="rounded-2xl h-[3px] w-full bg-black duration-500 peer-checked:-rotate-45"></div>
        <div
            class="rounded-2xl h-[3px] w-1/2 bg-black duration-500 place-self-end peer-checked:rotate-[225deg] origin-left peer-checked:translate-x-[12px] peer-checked:translate-y-[1px]">
        </div>
    </label>
</template>

<script setup>

import { ref } from 'vue'

const clicked = ref(false)

const toggleNavbarPosition = () => {

    const aside = document.querySelector('aside')

    aside.classList.toggle('toggle')

    clicked.value = !clicked.value
}
</script>

<style scoped>
@media screen and (min-width: 520px) {

#navbar-button {
    display: none;
}
}
</style>