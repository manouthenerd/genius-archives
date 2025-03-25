<template>
    <Modal 
        class="w-full"
        v-show="! searchModal.isClosed"
        @close-event="searchModal.closeModal()"
        title="Barre de recherche">
        
        <ModalItem class="w-full">
            <Input class="my-2" type="search" name="search" id="search"
                placeholder="Nom du dossier ou fichier..." />

        </ModalItem>

    </Modal>
</template>

<script setup>
import Modal from './Modal.vue';
import ModalItem from './ModalItem.vue';
import Input from '../forms/Input.vue';
import { useSearchModalStore } from '@/stores/searchModal';

const searchModal = useSearchModalStore()
</script>