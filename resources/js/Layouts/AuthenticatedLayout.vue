<template>

    <Head title="L'archive du futur" />
    <div class="flex h-screen gap-2">
        <aside
            class="h-screen flex justify-between flex-col rounded-sm w-[215px] border-none bg-[#1c2434] shadow-lg shadow-black">
            <div id="brand" class="text-white text-center text-[18px] rounded-sm font-bold uppercase bg-blue-600">
                <p class="flex items-center gap-1">
                    <span class="bg-white text-blue-600">WEB ARCHIVES</span>
                    <img src="/icons/logo.svg" alt="folder icon">
                </p>
            </div>

            <div>
                <ul class="flex flex-col gap-2 ml-2">
                    <li>
                        <Link href="/" class="flex gap-2 items-center text-white">
                        <img src="/icons/grid.svg">
                        <span :class="useIsComponent('Home') ? styles : ''">Dashboard</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/mes-archives" class="flex gap-2 items-center text-white">
                        <img src="/icons/folder.svg">
                        <span :class="useIsComponent('Archives') ? styles : ''">Mes archives</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/nouvelle-archive" class="flex gap-2 items-center text-white">
                        <img src="/icons/file.svg">
                        <span :class="useIsComponent('CreateArchive') ? styles : ''">Nouvelle archive</span>
                        </Link>
                    </li>
                    <!-- <li>
                        <Link href="/niveau-d-acces" class="flex gap-2 items-center text-white">
                        <img src="/icons/admin.svg">
                        <span>Niveau d'accès <br>des archives</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/creation-de-compte" class="flex gap-2 items-center text-white">
                        <img src="/icons/passkey.svg">
                        <span>Créer un compte </span>
                        </Link>
                    </li> -->
                </ul>
            </div>

            <div>
                <ul class="flex flex-col gap-2 ml-2">
                    <li>
                        <Link href="/parametres" class="flex gap-2 items-center text-white">
                        <img src="/icons/setting.svg">
                        <span :class="useIsComponent('Settings') ? styles : ''">Paramètres</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/corbeille" class="flex gap-2 items-center text-white">
                        <img src="/icons/trash.svg">
                        <span>Corbeille</span>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="mb-4">
                <ul class="flex flex-col gap-2 ml-2">
                    <li>
                        <Link href="/" as="button" method="delete" class="flex gap-2 items-center text-white">
                            <img src="/icons/logout.svg">
                            <span class="text-red-600">Se déconnecter</span>
                        </Link>
                    </li>

                    <li class="text-[5px]">
                        <pre class="text-white text-center">Copyright © {{ date }} - coding by TheN👾rd</pre>
                    </li>
                    
                </ul>
            </div>
        </aside>
        
        <div class="px-4 h-screen overflow-scroll rounded-sm w-full size-[50%] bg-[whitesmoke] shadow-lg shadow-black">
            <header class="sticky top-0 z-999">
                <div class="flex flex-wrap-reverse gap-4 justify-between items-center bg-white p-2">
                    <div class="flex gap-2 items-center">
                        <button @click="resize">
                            <img src="/icons/menu.svg" alt="menu icon">
                        </button>
                        <div class="bg-gray-200 flex items-center justify-between border-none ring-2 ring-blue-600 rounded-md">
                            <input type="search" 
                                name="search" 
                                id="search" 
                                class="rounded-md border-blue-600"
                                placeholder="Titre du document..."
                            >
                            <button type="submit" class="h-[40px]">
                                <img src="/icons/search.svg" alt="search icon">
                            </button>
                        </div>
                    </div>


                    <div class="flex gap-4 items-center"> 
                        <input @click="rotate" id="theme-button" type="image" src="/icons/light.svg"/>

                        <ProfilePicture
                            firstname="Emmanuel"
                            lastname="KACOU"
                        />
                        <ul>
                            <li>Manouthenerd</li>
                            <li class="text-lightGray">Administrateur</li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="bg-white mt-2">
                <slot/>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { useIsComponent } from '@/composables/isComponent';
import ProfilePicture from '@/Components/ProfilePicture.vue';

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

a {
    transition: all .5s;
}

a:hover {
    color: #2563eb;
}

.rotate-button {
    transition: all .5s;
    transform: rotate(360deg)
}
</style>

