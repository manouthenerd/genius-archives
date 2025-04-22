<template>
    <Modal 
        class="w-full z-[100]" 
        v-show="!confirmationModal.isClosed" 
        @close-event="confirmationModal.closeModal()"
        title="Confirmation de l'action"
    >

        <ModalItem class="w-full">

            <div class="flex w-full justify-end mt-2 gap-2">
                <p class="bg-slate-100 p-1 border rounded shadow text-center">
                    {{ message }}
                </p>
                <div class="space-y-0.5">

                    <Link 
                        as="button" 
                        @click="confirmationModal.closeModal()" 
                        method="post" :href="confirmationModal.getRequestUrl"
                        class="bg-red-300 hover:bg-red-500 transition-colors text-white text-center font-thin rounded-sm outline-none focus:outline-none border-slate-200 p-2">
                    Confirmer
                    </Link>
                    <Button 
                        @click="confirmationModal.closeModal()"
                        class="bg-slate-300 hover:bg-slate-500 transition-colors text-white text-center font-thin">
                        Annuler
                    </Button>
                </div>
            </div>
        </ModalItem>
    </Modal>
</template>

<script setup>
import Modal from './Modal.vue';
import ModalItem from './ModalItem.vue';
import { useConfirmationModal } from '@/stores/confirmationModal';
import Button from '../forms/Button.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    message: String
})

const confirmationModal = useConfirmationModal()
</script>