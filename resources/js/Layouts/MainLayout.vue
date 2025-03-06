<template>

    <Head title="L'archive du futur" />
    <div class="flex h-screen gap-2">
        <aside
            class="h-screen flex justify-between flex-col rounded-sm min-w-[215px] border-none bg-[#1c2434] shadow-lg shadow-black">
            <div id="brand" class="text-white text-center text-[18px] rounded-sm font-bold uppercase bg-blue-600">
                <p class="flex items-center gap-1">
                    <span class="bg-white text-blue-600">GENIUS ARCHIVES</span>
                    <FolderClosed color="#fff" />
                </p>
            </div>

            <div>
                <ul class="flex flex-col gap-4 ml-2">
                    <li>
                        <Link href="/" class="flex gap-2 items-center text-white">
                        <LayoutGrid color="#2563eb" />
                        <span :class="useIsComponent('Home') ? styles : ''">Dashboard</span>
                        </Link>
                    </li>
                    <li class="flex flex-col">

                        <details>

                            <summary class="flex gap-2 items-center text-white"
                                :class="useIsComponent('Archives') ? styles : ''">
                                <FolderArchive color="#2563eb" />
                                Mes archives
                                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960"
                                    width="30px" fill="#fff">
                                    <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                                </svg>
                            </summary>

                            <ul class="flex flex-col items-center gap-2 text-white">
                                <li>
                                    <button type="button" @click.prevent="foldersModalStore.openModal()"
                                        class="flex items-center">
                                        <FolderPlus class="text-slate-300" />
                                        Nouveau dossier
                                    </button>

                                </li>
                            </ul>
                        </details>


                    </li>

                    <li>
                        <Link href="/nouvelle-archive" class="flex gap-2 items-center text-white">
                        <FileText color="#2563eb" />
                        <span :class="useIsComponent('CreateArchive') ? styles : ''">Nouvelle archive</span>
                        </Link>
                    </li>

                    <li v-show="isAdmin">
                        <button @click="createMemberModal.openModal()" class="flex gap-2 items-center text-white">
                            <UserRoundPlus color="#2563eb" />
                            <span>Ajouter un membre </span>
                        </button>
                    </li>
                    <li v-show="isAdmin">
                        <Link href="/mes-membres" class="flex gap-2 items-center text-white">
                        <UsersRound color="#2563eb" />
                        <span>Mes membres</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div>
                <ul class="flex flex-col gap-2 ml-2">
                    <li v-show="isAdmin">
                        <Link href="/historique" class="flex gap-2 items-center text-white">
                        <History color="#2563eb" />
                        <span :class="useIsComponent('Historique') ? styles : ''">Historique</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/parametres" class="flex gap-2 items-center text-white">
                        <Settings color="#2563eb" />
                        <span :class="useIsComponent('Settings') ? styles : ''">Paramètres</span>
                        </Link>
                    </li>
                    <li v-show="isAdmin">
                        <Link href="/corbeille" class="flex gap-2 items-center text-white">
                        <Trash2Icon color="#2563eb" />
                        <span>Corbeille</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="mb-4">
                <ul class="flex flex-col gap-2 ml-2">
                    <li>
                        <Link href="/logout" as="button" method="post" class="flex gap-2 items-center text-white">
                        <LogOut color="#dc2626 " />
                        <span class="text-red-600">Se déconnecter</span>
                        </Link>
                    </li>

                    <li class="text-[5px]">
                        <pre
                            class="text-white text-center">Copyright © {{ date }} - coding by Leplusbio225 AKA TheN👾rd</pre>
                    </li>

                </ul>
            </div>
        </aside>

        <div class="px-4 h-screen overflow-scroll rounded-sm w-full size-[50%] bg-[whitesmoke] shadow-lg shadow-black">
            <header class="sticky top-0 z-999">
                <div class="flex flex-wrap-reverse gap-4 justify-between items-center bg-white p-2">
                    <div class="flex gap-2 items-center">
                        <button @click="resize">
                            <Menu size="35px" />
                        </button>
                        <div class="ml-4 bg-gray-200 border-none ring-2 ring-slate-300 shadow-inner rounded-md">
                            <button type="submit" class="h-[40px] text-[14px] w-full flex items-center"
                                @click="searchModal.openModal()">
                                RECHERCHE
                                <Search size="14" color="#5f6368" />
                            </button>
                        </div>
                    </div>


                    <div class="flex gap-4 items-center">

                        <input @click="rotate" id="theme-button" type="image" src="/icons/light.svg" />

                        <ProfilePicture :name="user.name" />
                        <ul>
                            <li>{{ user.name ?? 'anonymous' }}</li>
                            <li class="text-lightGray">{{ user.role ?? 'guest-user' }}</li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="bg-white mt-2">
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
import { computed, ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { useIsComponent } from '@/composables/isComponent';
import ProfilePicture from '@/Components/ProfilePicture.vue';
import FolderModal from '@/Components/modals/FolderModal.vue';
import SearchModal from '@/Components/modals/SearchModal.vue';
import CreateMember from '@/Pages/Member/CreateMember.vue';
import { useSearchModalStore } from '@/stores/searchModal';
import { useFoldersModalStore } from '@/stores/foldersModal';
import { useCreateMemberModal } from '@/stores/createMemberModal';
import {
    Bell,
    LayoutGrid,
    Settings,
    Trash2Icon,
    FolderArchive,
    FileText,
    UserRoundPlus,
    FolderPlus,
    LogOut,
    Menu,
    Search,
    FolderClosed,
    UsersRound,
    History,
} from 'lucide-vue-next';

const user = usePage().props.auth.user

const foldersModalStore = useFoldersModalStore()
const searchModal = useSearchModalStore()
const createMemberModal = useCreateMemberModal()

const date = ref(new Date().getFullYear())

const styles = "text-blue-600 font-bold"

const resize = () => {
    const aside = document.querySelector('aside')

    aside.classList.toggle('w-[300px]')
}

const rotate = () => {
    const aside = document.querySelector('#theme-button')

    aside.classList.toggle('rotate-button')
}

const isAdmin = computed(() => {
    return user.role == 'administrateur'
})


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
    color: #2563eb;
}

.rotate-button {
    transition: all .5s;
    transform: rotate(360deg)
}

/* Vue transition */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
