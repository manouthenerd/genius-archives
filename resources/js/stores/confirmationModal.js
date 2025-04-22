import { defineStore } from "pinia"
import { computed, ref } from "vue"

export const useConfirmationModal = defineStore('confirmationModalStore', () => { 

    const isClosed = ref(true)

    const openModal = () => {
        isClosed.value = false
    }

    const closeModal = () => {
        isClosed.value = true
    }

    const request_url = ref("")

    const setRequestUrl = (url) => request_url.value = url

    const getRequestUrl = computed(() => request_url.value)

    return {
        isClosed,
        openModal,
        closeModal,
        request_url,
        setRequestUrl,
        getRequestUrl
    }
})