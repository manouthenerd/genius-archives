<template>

    <SectionHead title="Modification des informations" />

    <div class="flex justify-center p-4">
        <form @submit.prevent="submit" class="space-y-4 ">
            <ModalItem>
                <label for="email">Nom et prénoms</label>
                <Input v-model="form.name" name="name" id="name" placeholder="Entrer le nom et prénoms"
                    class="rounded-sm outline-none focus:outline-none border-slate-200" />
                <Error :message="form.errors.name" />
            </ModalItem>

            <ModalItem>
                <label for="email">Adresse email</label>
                <Input v-model="form.email" type="email" name="email" id="email" placeholder="Entrer l'adresse email"
                    class="rounded-sm outline-none focus:outline-none border-slate-200" />
                <Error :message="form.errors.email" />
            </ModalItem>

            <ModalItem>
                <label for="disk_space">
                    Quota d'espace associé
                </label>
                <div class="flex justify-between">
                    <Input class="rounded-sm w-[65%] outline-none focus:outline-none border-slate-200"
                        v-model="form.disk_space" type="text" id="disk_space"
                        placeholder="Définir un quota d'espace..." />
                    <select class="w-[30%] rounded-sm outline-none focus:outline-none border-slate-200">
                        <option value="Go">Go</option>
                    </select>

                </div>
                <Error v-if="form.errors.disk_space" :message="form.errors.disk_space" />
            </ModalItem>

            <ModalItem class="space-y-2">
                <label>Définition des autorisations</label>
                <label id="access" class="flex items-center gap-1">
                    <input v-model="form.can_view_private_folder" type="checkbox" name="access" for="access">
                    Peut accéder aux dossiers privés
                </label>

            </ModalItem>

            <ModalItem>
                <Button>
                    <span v-if="!form.processing">Sauvegarder</span>
                    <Loader v-if="form.processing" class="animate-spin" />
                </Button>

            </ModalItem>

        </form>
    </div>
</template>

<script setup>
import ModalItem from '@/Components/modals/ModalItem.vue';
import SectionHead from '@/Components/SectionHead.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Button from '@/Components/forms/Button.vue';
import Error from '@/Components/forms/Error.vue';
import Input from '@/Components/forms/Input.vue';
import { Loader } from 'lucide-vue-next';
import { useForm, usePage } from '@inertiajs/vue3';

defineOptions({
    layout: MainLayout
})

const props = defineProps({
    member: Object
})

const form = useForm(
    {
        name: props.member.name,
        email: props.member.email,
        disk_space: props.member.disk_space,
        can_view_private_folder: props.member.can_view_private_folders,
    }
)

const submit = () => {
    form.patch(usePage().url)
}

</script>