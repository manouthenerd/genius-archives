import { defineStore } from "pinia"

export const useModalStore = defineStore('modal', {
    state: () => {
        return {
            isClosed: true
        }
    },

    actions: {
        openModal() {
            this.isClosed = false
        }, 

        closeModal() {
            this.isClosed = true
        }
    }
})

