<template>
    
    <Modal @close-event="createMemberModal.closeModal()" v-show="createMemberModal.isClosed == false" title="Ajouter un nouveau membre">
        <Head title="Ajouter un membre"/>
            <div class="max-w-[450px] flex">
                <form 
                    @submit.prevent="submit" 
                    class="space-y-2"
                >
                    <ModalItem>
                        <label for="email">Nom et prénoms</label>
                        <Input 
                            v-model="member.name"
                            name="name" 
                            id="name" 
                            placeholder="Entrer le nom et prénoms" 
                        />
                        <Error :message="member.errors.name"/>
                    </ModalItem>

                    <ModalItem>
                        <label for="email">Adresse email</label>
                        <Input 
                            v-model="member.email"
                            type="email" 
                            name="email" 
                            id="email" 
                            placeholder="Entrer l'adresse email" 
                        />
                        <Error :message="member.errors.email"/>
                    </ModalItem>

                    <ModalItem>
                        <label for="password">Mot de passe</label>
                        <Input 
                            type="password"
                            v-model="member.password"
                            name="password" 
                            id="password" 
                            placeholder="Entrer le mot de passe" 
                        />
                        <Error :message="member.errors.password"/>
                    </ModalItem>

                    <ModalItem>
                        <label for="disk_space">
                            Quota d'espace associé
                        </label>
                        <div class="flex justify-between">
                            <Input 
                                v-model="member.disk_space"
                                type="text" 
                                id="disk_space" 
                                min="0" 
                                placeholder="Définir un quota d'espace..."
                                class="w-[65%]" 
                            />
                            <Select class="w-[30%] rounded-sm outline-none focus:outline-none border-slate-200">
                                <option value="Go">Go</option>
                            </Select>
                            
                        </div>
                        <Error
                            v-if="member.errors.disk_space"
                            :message="member.errors.disk_space"
                        />
                     </ModalItem>

                    <ModalItem>
                        <Button>
                            <span v-if="! member.processing">Créer</span>
                            <Loader v-if="member.processing" class="animate-spin"/>
                        </Button>

                    </ModalItem>
                    
                </form>
            </div>
    </Modal>
</template>

<script setup>
import Input from '@/Components/forms/Input.vue';
import Modal from '@/Components/modals/Modal.vue';
import ModalItem from '@/Components/modals/ModalItem.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Loader } from 'lucide-vue-next';
import { useCreateMemberModalStore } from '@/stores/createMemberModal';
import Button from '@/Components/forms/Button.vue';
import Error from '@/Components/forms/Error.vue';

defineProps({status: String})

const createMemberModal = useCreateMemberModalStore()

const member = useForm({
    name: "",
    email: "",
    password: "",
    disk_space: "",
})

const submit = () => {
    
    member.post('/nouveau-membre', {
        onSuccess: () => member.reset()
    })
}
</script>

<style>

</style>