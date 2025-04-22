<template>

    <Head title="Paramètres" />
    <section class="bg-white mt-8">
        <div class="flex flex-wrap items-center justify-between ">
            <SectionHead title="Informations du profil" />
            <Link v-if="useIsUrl('/parametres')" href="/parametres/edit"
                class="bg-blue-400 hover:bg-blue-500 transition-colors font-bold text-white p-2 rounded-md self-center">
            Editer le profil
            </Link>
            <Link v-else="useIsUrl('/parametres/edit')" href="/parametres"
                class="bg-blue-400 hover:bg-blue-500 transition-colors font-bold text-white p-2 rounded-md self-center">
            Revenir en arrière
            </Link>

        </div>
        <div class="flex max-w-[400px]">
            <form @submit.prevent="updateProfile()" class="space-y-2" enctype="multipart/form-data">

                <div class="mt-4 flex p-2">

                    <div class="flex items-center gap-2 ">

                        <div class="flex ">

                            <ProfilePicture v-if="useIsUrl('/parametres')" :name="user.name" />

                            <div v-else>
                                <input @input="updateProfilePicture($event.target.files[0])" id="button" type="file"
                                    hidden accept="image/*">
                                <label for="button" id="uploadButton" class="grid justify-items-center">
                                    <Upload v-if="form.file"
                                        class="stroke-transparent hover:stroke-white transition-colors absolute top-[175px]" />
                                    <img v-if="form.file" for="button" class="size-[50px] rounded-full"
                                        :src="filePreview" alt="profile picture">
                                    <ProfilePicture v-if="!form.file" :name="user.name" />
                                </label>
                            </div>

                            <!-- Visible if not edit page -->
                            <ul class="ml-2">
                                <li v-show="useIsUrl('/parametres')">{{ user.name }}</li>
                                <li v-show="useIsUrl('/parametres/edit')">
                                    <label for="username" class="flex gap-1">
                                        <input v-model="form.username"
                                            class="bg-white border-x-0 border-t-0 p-0 w-full rounded-sm focus:outline-0 border border-gray-300 outline-none"
                                            type="text" name="username" id="username" autocomplete="username">
                                        <img src="/icons/edit.svg" alt="edit icon">
                                    </label>
                                </li>
                                <Error v-if="useIsUrl('/parametres/edit')" :message="form.errors.username"/>
                                <li class="text-lightGray">{{ user.role }}</li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="mt-8 w-full">

                    <SectionHead class="text-[10px] rounded-sm bg-[#00349E]" title="Informations de connexion" />
                    <div class="mt-4 px-2">

                        <div>
                            <label for="password">Adresse email</label>
                            <div>
                                <input class="bg-[beige] w-full rounded-sm focus:outline-none border border-gray-300"
                                    type="text" name="email" id="email" disabled :value="user.email">
                            </div>
                        </div>

                        <div class="mt-3">
                            <Link v-if="useIsUrl('/parametres')" class="text-[#00349E] font-bold italic"
                                href="/parametres/edit">
                            Changer de mot de passe
                            </Link>
                        </div>

                        <div v-if="useIsUrl('/parametres/edit')" class="space-y-4 mt-8">
                            <SectionHead class="text-[10px] rounded-sm bg-[#00349E]" title="Changer de mot de passe" />

                            <div class="mt-4">
                                <label for="current_password">Mot de passe actuel</label>
                                <div>
                                    <input v-model="form.current_password"
                                        class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                        type="password" name="current_password" id="current_password"
                                        placeholder="Entrer votre mot de pase actuel">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="password">Nouveau mot de passe</label>
                                <div>
                                    <input v-model="form.password"
                                        class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                        type="password" name="password" id="password"
                                        placeholder="Entrer le nouveau mot de passe">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="confirmation_password">Confirmer le nouveau mot de passe</label>
                                <div>
                                    <input v-model="form.password_confirmation"
                                        class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                        type="password" name="confirmation_password" id="confirmation_password"
                                        placeholder="Veuillez confirmer le mot de passe">
                                </div>
                                <Error :message="form.errors.password" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <Link v-show="useIsUrl('/parametres')" as="button" href="/settings" method="delete"
                                class="text-red-600 p-1 rounded-sm font-bold flex gap-1">
                            Supprimer le compte
                            <img src="/icons/delete-forever.svg" alt="deletion icon">
                            </Link>

                            <input type="submit" :disabled="isNotUpdated" :class="{ 'grayscale': isNotUpdated }"
                                v-show="useIsUrl('/parametres/edit')" value="Enregistrer les modifications"
                                class="bg-blue-400 hover:bg-blue-500 transition-colors font-bold text-white p-2 rounded-md mb-2">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

</template>

<script setup>
import { Link, Head, usePage, useForm } from '@inertiajs/vue3';
import SectionHead from '@/Components/SectionHead.vue';
import { useIsUrl } from '@/composables/isUrl';
import ProfilePicture from '@/Components/ProfilePicture.vue';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { computed, ref } from 'vue';
import { Upload } from 'lucide-vue-next';
import Error from '@/Components/forms/Error.vue';

const page = usePage()

const user = page.props.auth.user

const username = ref(user.name)

defineOptions({
    layout: SuperAdminLayout
})

const updateProfilePicture = (file) => {
    form.file = file
    previewFile(file)
}

const isNotUpdated = computed(() => {
    return form.username == user.name &&
        form.current_password == "" &&
        form.password == "" &&
        form.password_confirmation == "" &&
        form.file == ""
})

const form = useForm({
    username: username,
    current_password: "",
    password: "",
    password_confirmation: "",
    file: ""
})

const filePreview = ref("")

const previewFile = (file) => {

    if (!file) {
        return null
    }

    const reader = new FileReader()

    reader.readAsDataURL(file)

    reader.onload = () => {
        filePreview.value = reader.result
    }

}

const updateProfile = () => form.put('/parametres/edit')

</script>