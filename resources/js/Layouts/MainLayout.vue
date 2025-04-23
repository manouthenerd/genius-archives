<template>

    <Head title="L'archive du futur" />
    <Alert />
    <ConfirmationModal :message="message" />

    <div class="flex h-screen gap-2">
        <aside
            class="h-screen min-w-[215px] overflow-auto flex justify-between flex-col rounded-sm border-none bg-[#1c2434] shadow-lg shadow-black transition-[width,min-width,position] duration-300 ease-in-out">
            <div id="brand" class="text-white text-center text-[18px] rounded-sm font-bold uppercase bg-white">
                <a href="/" class="flex items-center gap-1">
                    <img class="h-[100px] w-full object-cover" src="/image/logo-genius.png" alt="App logo">
                </a>
            </div>

            <div class="small-moving">
                <ul class="flex flex-col gap-4 ml-2">
                    <li>
                        <Link href="/" class="flex gap-2 items-center text-white">
                        <LayoutGrid color="#0074B8" />
                        <span :class="useIsComponent('Home') ? styles : ''">Dashboard</span>
                        </Link>
                    </li>
                    <li class="flex flex-col">

                        <!-- <details :open="resize.navbarIsResized">

                            <summary class="flex gap-2 items-center text-white"
                                :class="useIsComponent('Archives') ? styles : ''">
                                <FolderArchive color="#0074B8" />

                                <span>Mes Dossiers</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960"
                                    width="30px" fill="#fff">
                                    <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                                </svg>
                            </summary>

                            <ul class="flex flex-col items-center gap-2 text-white">
                                <li v-if="user">
                                    <ul class="text-[14px] text-slate-300">
                                        <li class="dropdown"
                                            v-for="folder in user_folders" :title="folder.name">
                                            <Link :href="'/folders/' + folder.id"
                                                class=" overflow-hidden whitespace-nowrap inline-block text-ellipsis w-[145px]">
                                            {{ folder.name }}
                                            </Link>
                                        </li>
                                    </ul>
                                </li>

                                <li v-if="member">
                                    <ul class="text-[14px] text-slate-300">
                                        <li class="dropdown"
                                            v-for="folder in member_folders" :title="folder.name">
                                            <Link :href="'/folders/' + folder.id"
                                                class=" overflow-hidden whitespace-nowrap inline-block text-ellipsis w-[145px]">
                                            {{ folder.name }}
                                            </Link>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" @click.prevent="foldersModalStore.openModal()"
                                        class="flex items-center">
                                        <FolderPlus size="20" class="text-slate-300"
                                             />

                                        <span>Nouveau dossier</span>
                                    </button>

                                </li>
                            </ul>
                        </details> -->

                        <div>
                            <div @click="toggleOpen" class="flex gap-2 items-center text-white cursor-pointer"
                                :class="useIsComponent('Archives') ? styles : ''">
                                <FolderArchive color="#0074B8" />
                                <span>Mes Dossiers</span>
                                <ChevronUp />
                            </div>

                            <transition name="slide-fade">
                                <div v-show="isOpen" class="overflow-hidden">
                                    <ul class="flex flex-col items-center gap-2 text-white">
                                        <li v-if="user">
                                            <ul class="text-[14px] text-slate-300">
                                                <li class="dropdown" v-for="folder in user_folders"
                                                    :title="folder.name">
                                                    <Link :href="'/folders/' + folder.id"
                                                        class=" overflow-hidden whitespace-nowrap inline-block text-ellipsis w-[145px]">
                                                    {{ folder.name }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>

                                        <li v-if="member">
                                            <ul class="text-[14px] text-slate-300">
                                                <li class="dropdown" v-for="folder in member_folders"
                                                    :title="folder.name">
                                                    <Link :href="'/folders/' + folder.id"
                                                        class=" overflow-hidden whitespace-nowrap inline-block text-ellipsis w-[145px]">
                                                    {{ folder.name }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <button type="button" @click.prevent="foldersModalStore.openModal()"
                                                class="flex items-center">
                                                <FolderPlus size="20" class="text-slate-300" />

                                                <span>Nouveau
                                                    dossier</span>
                                            </button>

                                        </li>
                                    </ul>
                                </div>
                            </transition>
                        </div>


                    </li>

                    <li>
                        <Link href="/nouvelle-archive" class="flex gap-2 items-center text-white">
                        <FileText color="#0074B8" />
                        <span :class="useIsComponent('CreateArchive') ? styles : ''">Nouvelle archive</span>
                        </Link>
                    </li>

                    <li v-show="isAdmin">
                        <button @click="createMemberModal.openModal()" class="flex gap-2 items-center text-white">
                            <UserRoundPlus color="#0074B8" />
                            <span>Ajouter un membre </span>
                        </button>
                    </li>
                    <li v-show="isAdmin">
                        <Link href="/mes-membres" class="flex gap-2 items-center text-white">
                        <UsersRound color="#0074B8" />
                        <span>Mes membres</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="small-moving">
                <ul class="flex flex-col gap-2 ml-2">
                    <li v-show="isAdmin">
                        <Link href="/historique" class="flex gap-2 items-center text-white">
                        <History color="#0074B8" />
                        <span :class="useIsComponent('Historique') ? styles : ''">Historique</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/parametres" class="flex gap-2 items-center text-white">
                        <Settings color="#0074B8" />
                        <span :class="useIsComponent('Settings') ? styles : ''">Paramètres</span>
                        </Link>
                    </li>
                    <li v-show="isAdmin">
                        <Link href="/corbeille" class="flex gap-2 items-center text-white">
                        <Trash2Icon color="#0074B8" />
                        <span>Corbeille</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="small-moving mb-4">
                <ul class="flex flex-col gap-2 ml-2">
                    <li>
                        <Link href="/logout" as="button" method="post" class="flex gap-2 items-center text-white">
                        <LogOut color="#dc2626 " />
                        <span class="to-hide text-red-600">Se déconnecter</span>
                        </Link>
                    </li>

                    <li class="text-[5px]">
                        <pre
                            class="text-white text-center">Copyright © {{ date }} - coding by Leplusbio225 AKA TheN👾rd</pre>
                    </li>

                </ul>
            </div>
        </aside>

        <div
            class="px-4 h-screen overflow-scroll rounded-sm w-full size-[50%] bg-gradient-to-r from-slate-100 to-orange-50 via-blue-100 shadow-lg shadow-black">
            <header class="sticky top-0 z-999">
                <div id="wrapper" class="flex flex-wrap-reverse gap-4 justify-between items-center bg-white p-2">
                    <div class="flex gap-2 items-center">
                        <button id="navbar-button" @click="toggleNavbarPosition()">
                            <Menu size="35px" />
                        </button>
                        <div v-show="false"
                            class="ml-4 bg-gray-200 border-none ring-2 ring-slate-300 shadow-inner rounded-md">
                            <button type="submit" class="h-[40px] text-[14px] w-full flex items-center"
                                @click="searchModal.openModal()">
                                RECHERCHE
                                <Search size="14" color="#5f6368" />
                            </button>
                        </div>
                    </div>


                    <div class="flex gap-4 items-center">

                        <ProfilePicture :name="user.name ?? member.name" />
                        <ul>
                            <li>{{ user.name ?? member.name }}</li>
                            <li class="text-lightGray">{{ user.role ?? member.role }}</li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="bg-white mt-[20px] bg-gradient-to-r from-slate-100 to-orange-50 via-blue-100">
                <Transition>
                    <FolderModal />
                </Transition>
                <Transition>
                    <SearchModal />
                </Transition>
                <Transition>
                    <CreateMember />
                </Transition>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, onUnmounted } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { useIsComponent } from '@/composables/isComponent';
import ProfilePicture from '@/Components/ProfilePicture.vue';
import FolderModal from '@/Components/modals/FolderModal.vue';
import SearchModal from '@/Components/modals/SearchModal.vue';
import CreateMember from '@/Pages/Member/CreateMember.vue';
import { useSearchModalStore } from '@/stores/searchModal';
import { useFoldersModalStore } from '@/stores/foldersModal';
import { useCreateMemberModalStore } from '@/stores/createMemberModal';
import Alert from '@/Components/Alert.vue';
import ConfirmationModal from '@/Components/modals/ConfirmationModal.vue';
import { useAlertStore } from '@/stores/alert';

import {
    LayoutGrid,
    Settings,
    Trash2Icon,
    FolderArchive,
    FileText,
    UserRoundPlus,
    FolderPlus,
    ChevronUp,
    LogOut,
    Menu,
    Search,
    UsersRound,
    History,
} from 'lucide-vue-next';

const user = usePage().props.auth.user
const member = usePage().props.auth.member

const user_folders = usePage().props.auth.user_folders;
const member_folders = usePage().props.auth.member_folders;

const foldersModalStore = useFoldersModalStore()
const searchModal = useSearchModalStore()
const createMemberModal = useCreateMemberModalStore()

const date = ref(new Date().getFullYear())

const styles = "text-[#0074B8] font-bold"

const alert = useAlertStore();

const isAdmin = computed(() => {
    return user.role == 'administrateur'
})

const toggleNavbarPosition = () => {
    const aside = document.querySelector('aside')

    aside.classList.toggle('toggle')

}

const message = "Voulez-vous vraiment supprimer ce dossier ainsi que tout le contenu ?"

onUnmounted(() => alert.hideAlert())

const isOpen = ref(true)

const toggleOpen = () => {
    isOpen.value = !isOpen.value
}

</script>

<style scoped>
#brand {
    text-shadow: 1px 1px 1px #000;
    letter-spacing: 0, 106rem;
}

a,
li button {
    transition: all .5s;
}

a:hover,
li button:hover {
    color: #0074B8;
}


.rotate-button {
    transition: all .5s;
    transform: rotate(360deg)
}

.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
    max-height: 1000px;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    max-height: 0;
}

.toggle {
    left: 0;
}


@media screen and (max-width: 520px) {

    aside {
        transition: all .5s ease;
        z-index: 999;
        position: fixed;
        left: -230px;
    }

}

@media screen and (min-width: 520px) {

    #navbar-button {
        display: none;
    }
}

@media screen and (max-width: 600px) {

    #wrapper {
        flex-direction: row-reverse;
    }
}
</style>
