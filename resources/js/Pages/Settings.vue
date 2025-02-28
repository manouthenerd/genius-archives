<template>

    <AuthenticatedLayout>
        <Head title="Paramètres"/>
        <section class="bg-white mt-8">
            <div class="flex flex-wrap items-center justify-between ">
                <SectionHead title="Informations du profil" />
                <Link v-show="useIsUrl('/parametres')" href="/parametres/edit"
                    class="bg-blue-400 hover:bg-blue-500 transition-colors font-bold text-white p-2 rounded-md self-center">
                Editer le profil
                </Link>
            </div>
            <div class="flex max-w-[400px]">
                <form class="space-y-2" enctype="multipart/form-data" action="/settings" method="post">

                    <div class="mt-4 flex p-2">

                        <div class="flex items-center gap-2 ">

                            <div class="flex ">
                                <ProfilePicture firstname="Emmanuel" lastname="KACOU" />

                                <!-- Visible if not edit page -->
                                <ul class="ml-2">
                                    <li v-show="useIsUrl('/parametres')">Manouthenerd</li>
                                    <li v-show="useIsUrl('/parametres/edit')">
                                        <label for="username" class="flex gap-1">
                                            <input
                                                class="bg-white border-x-0 border-t-0 p-0 w-full rounded-sm focus:outline-0 border border-gray-300 outline-none"
                                                type="text" name="username" id="username" value="Manouthenerd"
                                                autocomplete="username">
                                            <img src="/icons/edit.svg" alt="edit icon">
                                        </label>
                                    </li>
                                    <li class="text-lightGray">Administrateur</li>
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
                                    <input
                                        class="bg-[beige] w-full rounded-sm focus:outline-none border border-gray-300"
                                        type="text" name="email" id="email" disabled value="contact@example.com">
                                </div>
                            </div>

                            <div class="mt-3">
                                <Link v-if="useIsUrl('/parametres')" class="text-[#00349E] font-bold italic" href="/parametres/edit">
                                    Changer de mot de passe
                                </Link>
                            </div>

                            <div v-if="useIsUrl('/parametres/edit')" class="space-y-4 mt-8">
                                <SectionHead class="text-[10px] rounded-sm bg-[#00349E]" title="Changer de mot de passe" />

                                <div class="mt-4">
                                    <label for="current_password">Mot de passe actuel</label>
                                    <div>
                                        <input
                                            class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                            type="password" name="current_password" id="current_password"
                                            placeholder="Entrer votre mot de pase actuel"
                                        >
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="password">Nouveau mot de passe</label>
                                    <div>
                                        <input
                                            class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                            type="password" name="password" id="password"
                                            placeholder="Entrer le nouveau mot de passe"
                                        >
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="confirmation_password">Confirmer le nouveau mot de passe</label>
                                    <div>
                                        <input
                                            class="bg-[#fffefe] w-full rounded-sm focus:outline-none border border-gray-300"
                                            type="password" name="confirmation_password" id="confirmation_password"
                                            placeholder="Veuillez confirmer le mot de passe"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <Link 
                                    v-show="useIsUrl('/parametres')" 
                                    as="button" href="/settings" 
                                    method="delete"
                                    class="text-red-600 p-1 rounded-sm font-bold flex gap-1"
                                >
                                    Supprimer le compte
                                    <img src="/icons/delete-forever.svg" alt="deletion icon">
                                </Link>

                                <input 
                                    v-show="useIsUrl('/parametres/edit')" 
                                    type="submit"
                                    value="Enregistrer les modifications"
                                    class="bg-blue-400 hover:bg-blue-500 transition-colors font-bold text-white p-2 rounded-md mb-2">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </section>
    </AuthenticatedLayout>

</template>

<script setup>
import { Link, Head } from '@inertiajs/vue3';
import SectionHead from '@/Components/SectionHead.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useIsUrl } from '@/composables/isUrl';
import ProfilePicture from '@/Components/ProfilePicture.vue';

console.log(useIsUrl('/parametres'))
</script>