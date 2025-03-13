import { defineStore } from "pinia"
import { ref } from "vue"

export const useFileUploadModalStore = defineStore('fileUpload', () => { 

    const isClosed = ref(true)

    const openModal = () => {
        isClosed.value = false
    }

    const closeModal = () => {
        isClosed.value = true
    }

    return {
        isClosed,
        openModal,
        closeModal
    }
})