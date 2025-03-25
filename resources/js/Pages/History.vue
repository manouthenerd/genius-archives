<template>
        <Head title="Historique"/>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="whitespace-nowrap">
                
                <th scope="col" class="px-6 py-3">
                    <input type="checkbox" name="checked" id="checked">
                </th>
                <th scope="col" class="px-6 py-3">
                   Membre
                </th>
                <th scope="col" class="px-6 py-3">
                    Adresse email
                </th>
                <th scope="col" class="px-6 py-3">
                    Adresse IP
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Début de session
                </th>
                <th scope="col" class="px-6 py-3">
                    Fin de session
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr 
                v-for="member_history in members_history"
                class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <input type="checkbox" :value="member_history.session_id" :name="member_history.session_id" :id="member_history.session_id">
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ member_history.name }}
                </th>
                <td class="px-6 py-4">
                    {{ member_history.email }}
                </td>
                <td class="px-6 py-4">
                    {{ member_history.ip_address }}
                </td>
                <td class="px-6 py-4">
                    {{ member_history.status == 'online' ? 'en ligne' : 'hors-ligne' }} 
                </td>
                <td class="px-6 py-4">
                    {{ member_history.login_at }}
                </td>
                <td class="px-6 py-4">
                    {{ member_history.logout_at ?? 'session active' }}
                </td>
                <td class="px-6 py-4">
                   
                </td>
               
            </tr>

        </tbody>
    </table>
</div>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SectionHead from '@/Components/SectionHead.vue';
import { Unplug } from 'lucide-vue-next';
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: MainLayout
})

defineProps({
    members_history: Array
})
</script>