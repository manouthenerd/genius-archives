<template>
    <Modal>
        <div class="grid w-full">
            <SectionHead title="Ajouter un nouveau dossier" />
            <div class="max-w-[450px]">
                <form>
                    <ModalItem>
                        <label for="folder">Nom du dossier</label>
                        <Input name="folder" id="folder" placeholder="Entrer le nom du dossier" />
                    </ModalItem>

                    <ModalItem>
                        <label for="folder">Niveau d'accès</label>
                        <select id="access" name="access"
                            class="rounded-sm outline-none focus:outline-none border-slate-200 ">
                            <option value="public">Public</option>
                            <option value="private">Privé</option>
                        </select>
                        <Note class="mt-2" :text="folderAccessText" />
                    </ModalItem>

                    <Transition name="fade">
                        <ModalItem>
                            <label for="password">Code de verrouillage</label>

                            <div class="flex justify-between">
                                <Input class="w-[75%]" id="password" name="password" placeholder="Entrer le code ici" />
                                <Input type="image" class="border-slate-500 bg-slate-300 rounded "
                                    src="/icons/generate-password.svg" alt="icon for password genenration" />
                            </div>
                            <Note class="mt-2" text="Ce code vous permettra d'accéder à ce dossier" />

                        </ModalItem>
                    </Transition>

                    <ModalItem>
                        <Link href="#" as="button" class="bg-blue-500 rounded-sm p-2 text-white text-center font-bold">
                        Créer
                        </Link>
                    </ModalItem>
                </form>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from './Modal.vue';
</script>