import { defineStore } from "pinia";
import { ref } from "vue";

export const useAlertStore = defineStore('alert', () => {

    const status = ref(false)
    const timer  = ref(100)
    const intervalId = ref(null)

    const message = ref("Informations ajoutées avec succès !")

    const setMessage  = (value) => {
        message.value = value
    }

    const showAlert = () => {
        status.value = true

        intervalId.value = setInterval(() => {

            timer.value = timer.value - 1

            if(timer.value == 0) { 
                hideAlert()
            }
        }, 100);
    }

    const hideAlert = () => {
        clearInterval(intervalId.value)
        status.value = false
        timer.value = 100
    }

    return {
        status,
        timer,
        showAlert,
        hideAlert,
        message,
        setMessage
    }
})