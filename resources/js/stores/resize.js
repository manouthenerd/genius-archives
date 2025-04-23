import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useResizeStore = defineStore('resize', () => {

    const isResized = ref(false)

    const navbarIsResized = computed(() => isResized.value)

    const resizeNavbar = () => {
        isResized.value = ! isResized.value
    }

    return {
        isResized,
        navbarIsResized,
        resizeNavbar
    }
}) 