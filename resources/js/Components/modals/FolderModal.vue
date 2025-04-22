<template>
    <Modal
        v-show="! foldersModalStore.isClosed"
        @close-event="foldersModalStore.closeModal()"
        title="Créer un nouveau dossier"
    >
        <form @submit.prevent="submit" class="space-y-4">
            <ModalItem>
            <label for="folder">Nom du dossier</label>
            <Input 
                name="folder" 
                id="folder" 
                v-model="folderForm.name"
                placeholder="Entrer le nom du dossier" 
            />
            <Error :message="folderForm.errors.name"/>
        </ModalItem>

        <ModalItem>
            <label for="visibiliy">Visibilité</label>
            <select id="visibility" name="visibility" v-model="folderForm.visibility"
                class="rounded-sm outline-none focus:outline-none border-slate-200 ">
                <option value="public">Public</option>
                <option value="private">Privé</option>
            </select>
            <Error :message="folderForm.errors.visibility"/>
        </ModalItem>

        <ModalItem>
            <label for="access">Niveau d'accès</label>
            <select id="access" name="access" v-model="folderForm.access_level"
                class="rounded-sm outline-none focus:outline-none border-slate-200 ">
                <option value="public">Public</option>
                <option value="private">Privé</option>
            </select>
            <Note class="mt-2" :text="folderAccessText" />
            <Error :message="folderForm.errors.access_level"/>
        </ModalItem>

        <ModalItem>
            <Button>
                <span v-if="! folderForm.processing">Créer</span>
                <Loader v-if="folderForm.processing" class="animate-spin"/>
            </Button>
        </ModalItem>
    </form>
    </Modal>
</template>

<script setup>
import Note from '../Note.vue';
import Modal from './Modal.vue';
import Input from '../forms/Input.vue';
import ModalItem from './ModalItem.vue';
import { computed, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useFoldersModalStore } from '@/stores/foldersModal';
import Button from '../forms/Button.vue';
import { Loader } from 'lucide-vue-next';
import Error from '../forms/Error.vue';
import { useAlertStore } from '@/stores/alert';

// Initialisation du formulaire avec des valeurs par défaut
const folderForm = useForm({
    name: "",
    access_level: "public",
    visibility: "public",
})

const alert = useAlertStore()

// Contenu des notes explicatives pour les niveaux d'accès
const noteContent = reactive({
    public: "\"Niveau public\": le contenu du dossier sera accessible aux autres membres.",
    private: "\"Niveau privé\": le contenu du dossier sera inaccessible aux autres membres.",
})

// Calcul pour afficher le texte explicatif en fonction du niveau d'accès
const folderAccessText = computed(() => {
    return folderForm.access_level == 'public' ? noteContent.public : noteContent.private
})

const foldersModalStore = useFoldersModalStore()

const submit = () => {
    folderForm.post('/folders', {
        onSuccess: () => {
            folderForm.reset('name')
            alert.setMessage('Dossier créé avec succès !🎉')
            alert.showAlert()
        }
    })
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>