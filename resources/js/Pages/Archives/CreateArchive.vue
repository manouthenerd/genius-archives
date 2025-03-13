<template>
    <Transition>
        <FileUploadModal :file="filePreview" />
    </Transition>
    <div class="">
        <SectionHead title="Ajouter un nouveau document" />

        <div class="m-4 flex gap-2 justify-center">
            <div>
                <form 
                    @submit.prevent="submit" 
                    class="max-w-[600px] space-y-4 mx-4 p-4 rounded-sm"
                    enctype="multipart/form-data"
                >
                    <div class="w-full">
                        <label for="title">Titre du document</label>
                        <div>
                            <Input v-model="file.title" name="title" id="title" class="w-full focus:ring-1 rounded-sm"
                                placeholder="Rapport de fin d'année" />
                        </div>
                    </div>

                    <div class="w-full space-y-2">
                        <label for="key">Clé de décryptage</label>
                        <div>
                            <Input v-model="file.decryption_key" name="key" id="key"
                                class="w-full focus:ring-1 rounded-sm" placeholder="Entrer la clé de décryptage" />
                        </div>
                        <Note
                            text="Tous les fichiers sont cryptés. Il vous serait impossible d'accéder à un fichier sans la clé de décryptage" />
                    </div>

                    <div class="w-full">
                        <label for="content">Contexte ou description</label>
                        <div>
                            <textarea v-model="file.content" name="content" id="content"
                                class="w-full field-sizing-content focus:ring-1 rounded-sm resize-y"
                                placeholder="Un résumé ou une brève description du contenu et de la finalité du document"></textarea>
                        </div>
                    </div>

                    <div class="w-full">
                        <label for="content">Ranger dans le dossier:</label>
                        <div class="w-full">
                            <select v-model="file.folder"
                                class="rounded-sm outline-none focus:outline-none border-slate-200 w-full">
                                <option value="Site ATTINGUIE">
                                    Entrepôt ATTINGUIE (8)
                                </option>
                                <option value="usine Daloa">
                                    Usine Daloa (4)
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full">
                        <label for="file">Fichier à téléverser</label>
                        <div class="flex justify-between items-center">
                            <Input 
                                @input="file.doc = $event.target.files[0]" 
                                type="file" 
                                name="archive" 
                                id="archive"
                                class="w-2/3 focus:ring-1 rounded bg-black text-white py-2 px-2 border-none" />
                            <button class="w-1/3flex justify-center">
                                <Trash class="stroke-red-600" />
                            </button>
                        </div>
                    </div>
                    <div class="w-full">
                        
                            <Button class="w-full">
                                <span v-if="! file.processing">Enregistrer</span>
                                <Loader v-if="file.processing" class="animate-spin"/>
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
import { Loader, Trash } from 'lucide-vue-next';
import { useFileUploadModalStore } from '@/stores/fileUploadModal';
import FileUploadModal from '@/Components/modals/FileUploadModal.vue';
import { ref } from 'vue';
import Button from '@/Components/forms/Button.vue';

defineOptions({
    layout: MainLayout
})

const fileUploadModal = useFileUploadModalStore()

const file = useForm({
    title: null,
    doc: null,
    folder: null,
    content: null,
    decryption_key: null
})


const filePreview = ref(null);

const handleFileChange = (event) => {

    file.doc = event.target.files[0]; // Récupérer le fichier sélectionné

    if (file.doc) {
        previewFile(file.doc); // Prévisualiser le fichier
        fileUploadModal.openModal()
    }

};

// Fonction pour prévisualiser le fichier
const previewFile = (file) => {
    const reader = new FileReader();

    reader.onload = () => {
        filePreview.value = reader.result; // Mettre à jour l'URL du fichier
    };

    reader.readAsDataURL(file); // Lire le fichier en tant que URL de données
};


const submit = () => {
    file.post(usePage().url, {
        forceFormData: true
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
</style>