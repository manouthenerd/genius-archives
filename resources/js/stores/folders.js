import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useFolderStore = defineStore('folders', () => {

    const folders = ref(0)    
    
    const totalFolders = computed( () => {
        return folders.value
    })

    function incrementFolders() {
        return folders.value++
    }

    return {
        folders,
        totalFolders,
        incrementFolders
    }
})