<template>
    <Modal @close-event="searchModal.closeModal()" :class="{ 'hidden': searchModal.isClosed }"
        title="Barre de recherche">
        <ModalItem class="w-full">
            <Input class="my-2" type="text" name="search" id="search"
                placeholder="Nom du dossier ou fichier..." />

            <ModalItem class="rounded-sm min-h-36 bg-white border border-slate-200">

            </ModalItem>
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