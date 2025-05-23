<template>
    <Transition>
        <FileUploadModal :file="filePreview" />
    </Transition>
    <div class="z-0">
        <SectionHead title="Ajouter un nouveau document" />
        <button @click="previewFile(form.file)"
            class="flex justify-center items-center fixed top-[20rem] right-1 p-1 bg-blue-300 rounded-full">
            <FileUp />
            <span class="relative -top-2 bg-orange-500 p-1">{{ uploadCounter }}</span>
        </button>
        <div class="m-4 flex gap-2 justify-center">
            <div>
                <form @submit.prevent="submit" class="max-w-[600px] space-y-4 mx-4 p-4 rounded-sm"
                    enctype="multipart/form-data">
                    <div class="w-full">
                        <label for="title">Titre du document</label>
                        <div>
                            <Input v-model="form.title" name="title" id="title" class="w-full focus:ring-1 rounded-sm"
                                placeholder="Rapport de fin d'année" />
                        </div>
                    </div>

                    <div class="w-full space-y-2">
                        <Note
                            text="Le nom d'origine de chaque fichier sera remplacé par le titre que vous avez entré au dessus 🔝" />
                    </div>


                    <div class="w-full">
                        <label for="content">Ranger dans le dossier:</label>
                        <div class="w-full">
                            <select v-model="form.folder"
                                class="rounded-sm outline-none focus:outline-none border-slate-200 w-full">
                                <option 
                                    v-for="folder in folders" 
                                    :value="folder.id"
                                    :key="folder.id"
                                >
                                    {{ folder.name }}
                                    <i class="text-xs italic">(dossier {{ folder.access_level }})</i>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full">
                        <label for="file">Fichier à téléverser</label>
                        <div class="flex justify-between items-center">
                            <Input 
                                @input="form.file = $event.target.files[0]" type="file" 
                                name="archive"
                                id="archive"
                                class="w-2/3 focus:ring-1 rounded bg-black text-white py-2 px-2 border-none" />
                            <button @click.prevent="removeUploadedFile" class="w-1/3flex justify-center">
                                <Trash class="stroke-red-600" />
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-2 space-x-2 items-center">
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        </progress>
                        <span v-if="form.progress" class="text-black mt-2">
                            {{ form.progress.percentage }}%
                        </span>
                    </div>
                    <div class="w-full">
                        <div class="w-full space-y-2">
                        <Note
                            text="Les fichiers sont automatiquement cryptés pour une question de sécurité" />
                            </div>

                        <Button 
                            :disabled="form.processing"
                            v-if="fileUploadModal.isClosed" 
                            class="w-full mt-2">
                            <template class="mt-[7px]" v-if="!form.processing">Enregistrer</template>
                            <Loader v-if="form.processing" class="animate-spin" />
                        </Button>
                        
                    </div>

                </form>
            </div>

        </div>
    </div>

</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SectionHead from '@/Components/SectionHead.vue';
import Note from '@/Components/Note.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Input from "@/Components/forms/Input.vue"
import { Loader, Trash, FileUp } from 'lucide-vue-next';
import { useFileUploadModalStore } from '@/stores/fileUploadModal';
import FileUploadModal from '@/Components/modals/FileUploadModal.vue';
import { computed, onMounted, ref } from 'vue';
import Button from '@/Components/forms/Button.vue';
import { useAlertStore } from '@/stores/alert';

defineOptions({
    layout: MainLayout
})

defineProps({
    folders: Array
})

let archive = null;

const alert = useAlertStore()

onMounted(() => archive = document.querySelector('#archive'))

const uploadCounter = computed(() => form.file ? 1 : 0)

const removeUploadedFile = () => {
    if(form.file) {
        form.file = ""
        archive.value = ""
    }

    return null;
}

const fileUploadModal = useFileUploadModalStore()

const form = useForm({
    title: "",
    file: "",
    folder: "",
})

const filePreview = ref(null);

// Fonction pour prévisualiser le fichier
const previewFile = (file) => {
    
    if(! file) {
        return null;
    }
    const reader = new FileReader();
    
    reader.onload = () => {
        filePreview.value = reader.result; // Mettre à jour l'URL du fichier
    };
    
    reader.readAsDataURL(file); // Lire le fichier en tant que URL de données

    fileUploadModal.openModal()
};


const submit = () => {
    alert.setMessage('Fichier ajouté avec succès🎉')
    form.post(usePage().url, {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            archive.value = ''
            alert.showAlert()
        },
    })
}
</script>

<style scoped>
form {
    margin: 0 auto;
}

input,
textarea,
select {
    border: 1.2px solid #94a3b8;
}

span {
    position: relative;
    top: -6px;
    height: 15px;
    width: 16px;
    /* text-align: center; */
    justify-content: center;
    display: flex;
    align-items: center;
    border-radius: 100%;
}
</style>