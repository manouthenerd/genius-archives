<template>
    <Modal
        :class="{'hidden' : foldersModalStore.isClosed}" 
        @close-event="foldersModalStore.closeModal()"
        title="Créer un nouveau dossier"
    >
        <ModalItem>
            <label for="folder">Nom du dossier</label>
            <Input 
                name="folder" 
                id="folder" 
                v-model="folderForm.name"
                placeholder="Entrer le nom du dossier" 
            />
        </ModalItem>

        <ModalItem>
            <label for="folder">Niveau d'accès</label>
            <select id="access" name="access" v-model="folderForm.access"
                class="rounded-sm outline-none focus:outline-none border-slate-200 ">
                <option value="public">Public</option>
                <option value="private">Privé</option>
            </select>
            <Note class="mt-2" :text="folderAccessText" />
        </ModalItem>

        <Transition name="fade">
            <ModalItem v-show="isPrivate">
                <label for="password">Code de verrouillage</label>

                <div class="flex justify-between">
                    <Input 
                        class="w-[75%]"
                        id="password" 
                        name="password" 
                        v-model="folderForm.password"
                        placeholder="Entrer le code ici" 
                    />
                    <Input 
                        @click="generate()"
                        type="image" 
                        class="border-slate-500 bg-slate-300 rounded "
                        src="/icons/generate-password.svg" alt="icon for password genenration" />
                </div>
                <Note class="mt-2" text="Ce code vous permettra d'accéder à ce dossier" />

            </ModalItem>
        </Transition>

        <ModalItem>
            <Link href="#" as="button":disabled="folderForm.processing"
                class="bg-blue-500 rounded-sm p-2 text-white text-center font-bold">
            Créer
            </Link>
        </ModalItem>
    </Modal>
</template>

<script setup>
import Note from '../Note.vue';
import Modal from './Modal.vue';
import Input from '../forms/Input.vue';
import ModalItem from './ModalItem.vue';
import { computed, reactive } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import { GeneratePassword } from "js-generate-password";
import { useFoldersModalStore } from '@/stores/foldersModal';

// Initialisation du formulaire avec des valeurs par défaut
const folderForm = useForm({
    name: "",
    access: "public",
    password: ""
})

// Calcul pour vérifier si l'accès est privé
const isPrivate = computed(() => {
    return folderForm.access === "private"
})

// Fonction pour générer un mot de passe aléatoire
function generate() {
    folderForm.password = GeneratePassword({
        length: 14,
        symbols: true,
    });
}

// Contenu des notes explicatives pour les niveaux d'accès
const noteContent = reactive({
    public: "\"Niveau public\": le contenu du dossier sera accessible aux autres membres.",
    private: "\"Niveau privé\": le contenu du dossier sera restreint et inaccessible aux autres membres.",
})

// Calcul pour afficher le texte explicatif en fonction du niveau d'accès
const folderAccessText = computed(() => {
    return folderForm.access == 'public' ? noteContent.public : noteContent.private
})

const foldersModalStore = useFoldersModalStore()
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