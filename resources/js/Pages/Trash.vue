<template>

    <Head title="Corbeille" />
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">

                    <th scope="col" class="px-6 py-3">
                        <Database />
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
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
                <tr
                    v-for="deleted_folder in deleted_folders"
                    class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <Folder fill="#fccb00" />
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ deleted_folder.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ deleted_folder.deleted_at }}
                    </td>
                    <td class="px-6 py-4">
                        Moi
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <Link 
                            as="button"
                            method="delete"
                            :href="`/restore/${deleted_folder.id}`" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Restaurer
                        </Link>
                        
                        <Link as="button" method="delete" href="/"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        Supprimer définitivement
                        </Link>
                    </td>
                </tr>
                <tr
                    v-for="deleted_member in deleted_members"
                    class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <UserCircle class="fill-slate-200" />
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ deleted_member.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ dateFormater.dateOnly(deleted_member.deleted_at) }} à {{ dateFormater.timeOnly(deleted_member.deleted_at) }}
                    </td>
                    <td class="px-6 py-4">
                        Moi
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <Link 
                            as="button"
                            method="delete"
                            :href="`/restore/${deleted_member.id}`" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Restaurer
                        </Link>

                        <Link as="button" method="delete" href="/"
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
import { Database, Folder, UserCircle } from 'lucide-vue-next';
import { useCarbonDateFormater } from '@/composables/carbon-date-formater';

defineOptions({
    layout: MainLayout
})

const props = defineProps({
    deleted_members: Array,
    deleted_folders: Array
})

const dateFormater = useCarbonDateFormater()

</script>