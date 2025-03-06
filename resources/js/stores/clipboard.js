import { defineStore } from "pinia";
import { ref } from "vue";

export const useClipboard = defineStore('clipboard', () => {

    const status = ref(false)

    const copyToClipboard = (el, e) => {
        console.log(e.target)
        if(el.length) {
            navigator.clipboard.writeText(el)
            status.value = true
    
            setTimeout(() => {
                status.value = false
            }, 1500);
        }

        return null
    }

    return {
        status,
        copyToClipboard
    }
})