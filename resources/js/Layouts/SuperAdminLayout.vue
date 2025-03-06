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

                    <li>
                        <Link href="/nouvelle-clee" class="flex gap-2 items-center text-white">
                        <Key color="#2563eb" />
                        <span>Générer une clé</span>
                        </Link>
                    </li>

                    <li>
                        <Link href="/mes-cles" class="flex gap-2 items-center text-white">
                        <BookKey color="#2563eb" />
                        <span>Mes clés d'accès</span>
                        </Link>
                    </li>
                    
                </ul>
            </div>

            <div>
                <ul class="flex flex-col gap-2 ml-2">

                    <li>
                        <Link href="/parametres" class="flex gap-2 items-center text-white">
                        <Settings color="#2563eb" />
                        <span :class="useIsComponent('Settings') ? styles : ''">Paramètres</span>
                        </Link>
                    </li>
                    <li>
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
                        <Link href="logout" as="button" method="post" class="flex gap-2 items-center text-white">
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
                            <li>{{ user.name }}</li>
                            <li class="text-lightGray">{{ user.role }}</li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="bg-white mt-2">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { useIsComponent } from '@/composables/isComponent';
import ProfilePicture from '@/Components/ProfilePicture.vue';
import { useSearchModalStore } from '@/stores/searchModal';
import {
    LayoutGrid,
    Settings,
    Trash2Icon,
    LogOut,
    Menu,
    Search,
    FolderClosed,
    UsersRound,
    History,
    Key,
    BookKey,
} from 'lucide-vue-next';

const user = usePage().props.auth.user

const searchModal = useSearchModalStore()

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
