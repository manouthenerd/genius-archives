<template>
    <Modal 
        v-show="! fileUpload.isClosed"
        @close-event="fileUpload.closeModal()"
        title="Visualisation du fichier">
        <ModalItem class="max-w-[400px] h-[300px]">
            <iframe 
                :src="file" 
                :type
                class="w-full h-[300px] p-2 rounded-sm border"
            ></iframe>
        </ModalItem>
    </Modal>
</template>

<script setup>
import Modal from './Modal.vue';
import ModalItem from './ModalItem.vue';
import { useFileUploadModalStore } from '@/stores/fileUploadModal';

const fileUpload = useFileUploadModalStore()

defineProps({
    file: String,
    type: String
})
</script>