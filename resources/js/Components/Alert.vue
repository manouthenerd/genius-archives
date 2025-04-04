<template>
    <div id="alert-box" class="grid m-2 fixed top-0 right-0 p-1 w-56 border bg-[#D7EDAE] rounded-sm space-y-4 z-[999]"
        :class="alert.status ? 'to-right' : 'from-left'">
        <div class="flex justify-between">
            <span class="font-bold p-1 text-brandColor shadow">Notification</span>
            <button @click="alert.hideAlert()"  class="shadow rounded inline-block px-2">X</button>
        </div>
        <div class="space-y-2">
            <p>{{ alert.message }}</p>
            <p>
                <slot />
            </p>
        </div>
        <progress ref="progress" :value="alert.timer" max="100" role="progressbar" class="h-1 rounded-lg bg-gray-100">
        </progress>
    </div>

</template>

<script setup>
import { useAlertStore } from "@/stores/alert.js"

const props = defineProps({
    message: String,
})

const alert = useAlertStore()


</script>

<style scoped>
.from-left {
    transform: translateY(-150%);
    transition: transform .4s ease;
}

.to-right {
    transform: translateY(0);
    transition: transform .4s ease;
}
</style>