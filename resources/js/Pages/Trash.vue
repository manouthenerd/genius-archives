<template>

    <Head title="Corbeille" />
    <SectionHead title="Corbeille"/>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">

                    <th scope="col" class="px-6 py-3">
                        <Database />
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date de suppression
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Supprimé par
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>

                <!-- Folders -->
                <tr
                    v-for="folder in trashed_folders"
                    class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <Folder fill="#fccb00" />
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ folder.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ dateFormater.dateOnly(folder.deleted_at)}} à {{ dateFormater.timeOnly(folder.deleted_at)}}
                    </td>
                    <td class="px-6 py-4">
                        Moi
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <Link 
                            as="button"
                            method="post"
                            :href="`/folders/${folder.id}`" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Restaurer
                        </Link>
                        
                        <Link 
                            as="button" 
                            method="delete" 
                            :href="`/folders/${folder.id}`"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        Supprimer définitivement
                        </Link>
                    </td>
                </tr>

                <!-- Archives -->
                
                <tr
                    v-for="archive in trashed_archives"
                    class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <File class="fill-slate-200" />
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ archive.name + '.' + archive.extension }}
                    </th>
                    <td class="px-6 py-4">
                        {{ dateFormater.dateOnly(archive.deleted_at) }} à {{ dateFormater.timeOnly(archive.deleted_at) }}
                    </td>
                    <td class="px-6 py-4">
                        Moi
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <Link 
                            as="button"
                            method="post"
                            :href="`/archives/${archive.id}/restore`" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Restaurer
                        </Link>

                        <Link 
                            as="button" 
                            method="delete" 
                            :href="`/archives/${archive.id}`"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        Supprimer définitivement
                        </Link>
                    </td>
                </tr>

                <!-- Members -->
                <tr
                    v-for="member in trashed_members"
                    class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <UserCircleIcon class="fill-slate-200" />
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ member.email }}
                    </th>
                    <td class="px-6 py-4">
                        {{ dateFormater.dateOnly(member.deleted_at) }} à {{ dateFormater.timeOnly(member.deleted_at) }}
                    </td>
                    <td class="px-6 py-4">
                        Moi
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <Link 
                            as="button"
                            method="post"
                            :href="`/members/${member.id}/restore`" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Restaurer
                        </Link>

                        <Link as="button" method="delete" :href="`/members/${member.id}`" 
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        Supprimer définitivement
                        </Link>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Database, File, Folder, UserCircle, UserCircle2, UserCircleIcon } from 'lucide-vue-next';
import { useCarbonDateFormater } from '@/composables/carbon-date-formater';
import SectionHead from '@/Components/SectionHead.vue';

defineOptions({
    layout: MainLayout
})

const props = defineProps({
    trashed_members: Array,
    trashed_folders: Array,
    trashed_archives: Array
})

const dateFormater = useCarbonDateFormater()

</script>