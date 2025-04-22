<template>

<Head title="Mes membres"/>
<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom & prénoms
                </th>
                <th scope="col" class="px-6 py-3">
                    Adresse email
                </th>
                <th scope="col" class="px-6 py-3">
                    Quota d'espace
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
        
            <tr 
                v-for="member in members"
                class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ member.id }}
                </th>
                <td class="px-6 py-4">
                    {{ member.name }}
                </td>
                <td class="px-6 py-4">
                    {{ member.email }}
                </td>
                <td class="px-6 py-4">
                    {{ member.disk_space }} Go
                </td>
                <td class="flex items-center px-6 py-4">
                    <Link 
                        :href="`/mes-membres/${member.id}/edit`" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Modifier
                    </Link>
                    <Link 
                        as="button" 
                        method="post" 
                        :href="`/members/${member.id}`" 
                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        Supprimer
                    </Link>
                </td>
            </tr>

        </tbody>
    </table>

    <p v-if="! members.length" class="w-full text-center text-slate-700 mt-4">
        Aucun membre n'a été ajouté !
    </p>
</div>

</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineOptions({
    layout: MainLayout
})

defineProps({
    members: Array
})
</script>