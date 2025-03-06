<template>
    
    <Modal @close-event="createMemberModal.closeModal()" v-show="createMemberModal.isClosed == false" title="Ajouter un nouveau membre">
        <Head title="Ajouter un membre"/>
            <div class="max-w-[450px] flex">
                <form class="space-y-4">
                    <ModalItem>
                        <label for="identifier">Identifiant ou Email</label>
                        <Input name="identifier" id="identifier" placeholder="Entrer l'ID ou l'email" />
                    </ModalItem>

                    <ModalItem>
                        <label for="password">Mot de passe</label>
                        <Input name="password" id="password" placeholder="Entrer le mot de passe" />
                    </ModalItem>

                    <ModalItem>
                        <label for="role">Rôle du nouveau membre</label>
                        <select id="role" name="role"
                            class="rounded-sm outline-none focus:outline-none border-slate-200 ">
                            <option value="admin">administrateur</option>
                            <option value="user">utilisateur</option>
                        </select>
                        <Note class="mt-2" text="Un membre avec le rôle 'administrateur' detient toutes les autorisations sauf restriction." />
                    </ModalItem>

                    <ModalItem class="space-y-2">
                        <label>Définition des autorisations</label>
                            <label for="access" class="flex items-center gap-1">
                                <input type="checkbox" name="access" id="access">
                                Peut accéder aux dossiers privés
                            </label>
                            <label for="can-create" class="flex items-center gap-1">
                                <input type="checkbox" name="can-create" id="can-create">
                                Peut créer d'autres membres.
                            </label>
                            <label for="can-edit" class="flex items-center gap-1">
                                <input type="checkbox" name="can-edit" id="can-edit">
                                Peut supprimer son compte.
                            </label>
                            <label for="can-edit" class="flex items-center gap-1">
                                <input type="checkbox" name="can-edit" id="can-edit">
                                Peut modifier son profil <i>(photo, ID et mot de passe.)</i>
                            </label>
                            
                    </ModalItem>

                    <ModalItem>
                        <Link href="#" as="button" class="bg-blue-500 rounded-sm p-2 text-white flex justify-center items-center font-bold">
                            Ajouter 
                            <span>
                                <UserRoundPlus color="#fff" size="15px"/>
                            </span>
                        </Link>
                    </ModalItem>
                    
                </form>
            </div>
    </Modal>
</template>

<script setup>
import Input from '@/Components/forms/Input.vue';
import Modal from '@/Components/modals/Modal.vue';
import ModalItem from '@/Components/modals/ModalItem.vue';
import Note from '@/Components/Note.vue';
import { Link, Head } from '@inertiajs/vue3';
import { UserRoundPlus } from 'lucide-vue-next';
import { useCreateMemberModal } from '@/stores/createMemberModal';

const createMemberModal = useCreateMemberModal()
</script>