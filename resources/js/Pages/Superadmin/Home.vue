<template>


    <div class="w-full space-y-8 p-2">


        <div class="relative overflow-x-auto ">
            <table class="w-full rounded border border-slate-200  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="caption-top text-center round-sm-b p-2 bg-slate-700 border border-slate-200">
                    <Link class="bg-gray-100 rounded p-1">Voir toute la liste des clés générées</Link>
                </caption>
                <thead class="text-xs text-gray-900 dark:text-gray-400">
                    <tr class="text-center whitespace-nowrap">
                        <th scope="col" class="px-6 py-3">
                            N.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clés d'accès
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quota d'espace
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Durée de vie
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="key in keys.data"
                        class="bg-white dark:bg-gray-800 text-center whitespace-nowrap"
                    >
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ key.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ key.key }}	
                        </td>
                        <td class="px-6 py-4">
                            {{ key.disk_space }} MO
                        </td>
                        <td class="px-6 py-4">
                            {{ key.lifetime }} jours 
                        </td>
                        <td class="px-6 py-4">
                            {{ key.user_id == null ? 'libre' : 'occupée' }}
                        </td>
                        
                        <td class="px-6 py-4">
                            <Link class="p-2 rounded-sm text-center text-white bg-blue-600 hover:opacity-100">
                                modifier
                            </Link>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full border border-slate-200 rounded text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="caption-top text-center round-sm-b p-2 bg-slate-700 border border-slate-200">
                    <Link class="bg-gray-100 rounded p-1">Voir toute la liste des administrateurs</Link>
                </caption>
                
                <thead class="text-xs text-gray-900  dark:text-gray-400 w-full">
                    <tr class="text-center whitespace-nowrap">
                        <th scope="col" class="px-6 py-3">
                            N.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nom & prénoms
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rôle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clé du compte
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="admin in admins.data"
                        class="bg-white dark:bg-gray-800 text-center whitespace-nowrap"
                    >
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ admin.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ admin.name }}	
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.role }}
                        </td>
                        <td class="px-6 py-4">
                            clé n°2
                        </td>
                        <td class="px-6 py-4">
                            <Link class="p-2 rounded-sm text-center text-white bg-blue-600 hover:opacity-100">
                                modifier
                            </Link>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full border border-slate-200 rounded text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <caption class="caption-top text-center round-sm-b p-2 bg-slate-700 border border-slate-200">
                    <Link class="bg-gray-100 rounded p-1">Voir toute la liste des membres</Link>
                </caption>
                <thead class="text-xs text-gray-900  dark:text-gray-400 w-full">
                    <tr 
                        
                        class="text-center"
                    >
                        <th scope="col" class="px-6 py-3">
                            N.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nom & prénoms
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rôle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Associé à
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="member in members.data"
                        class="bg-white dark:bg-gray-800 text-center"
                    >
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
                            {{ member.role }}
                        </td>
                        <td class="px-6 py-4">
                            Genius Network
                        </td>
                        
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import ModalItem from '@/Components/modals/ModalItem.vue';
import Input from '@/Components/forms/Input.vue';
import SubmitButton from '@/Components/forms/SubmitButton.vue';
import Select from '@/Components/forms/Select.vue';
import Note from '@/Components/Note.vue';
import { CheckCheck, Copy } from 'lucide-vue-next';
defineOptions({
    layout: SuperAdminLayout
})

defineProps({
    members: Object,
    admins: Object,
    keys: Object
})
</script>

<style scoped>
table {
    border-radius: 100px;
    border-radius: 100px;
}
</style>