<template>


    <div class="w-full space-y-8 p-2 h-full z-0 grid">


        <div class="relative overflow-x-auto ">
            <table class="w-full rounded border border-slate-200  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="caption-top text-center round-sm-b p-2 bg-slate-700 border border-slate-200">
                    <Link href="/access-keys" class="bg-gray-100 rounded p-1">Voir toute la liste des clés générées</Link>
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
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-if="access_key.id"
                        class="bg-white dark:bg-gray-800 text-center whitespace-nowrap"
                    >
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{access_key ? access_key.id : ''}}
                        </th>
                        <td class="px-6 py-4">
                            {{access_key ? access_key.key : ''}}	
                        </td>
                        <td class="px-6 py-4">
                            {{access_key ? access_key.disk_space : ''}} Go
                        </td>
                        <td class="px-6 py-4">
                            {{access_key ? access_key.user_id == null ? 'libre' : 'occupée' : ''}}
                        </td>
                        
                        <td class="px-6 py-4">
                            <Link :href="`/access-keys/${access_key ? access_key.id : ''}`" class="p-2 rounded-sm text-center text-white bg-blue-600 hover:opacity-100">
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
                    <Link href="/admins" class="bg-gray-100 rounded p-1">Voir toute la liste des administrateurs</Link>
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
                        v-if="admin"
                        class="bg-white dark:bg-gray-800 text-center whitespace-nowrap"
                    >
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{admin ? admin.id : ''}}
                        </th>
                        <td class="px-6 py-4">
                            {{admin ? admin.name : ''}}	
                        </td>
                        <td class="px-6 py-4">
                            {{admin ? admin.email : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{admin ? admin.role : ''}}
                        </td>
                        <td class="px-6 py-4">
                            <Link 
                                class="text-blue-500 font-bold"
                                :href="`/access-keys/${admin ? admin.access_key : ''}`"
                            >
                                {{admin ? admin.access_key : ''}}
                            </Link>
                        </td>
                        <td v-if="admin.name" class="px-6 py-4">
                            <Link class="p-2 rounded-sm text-center text-white bg-red-600 hover:opacity-100">
                                supprimer
                            </Link>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full border border-slate-200 rounded text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <caption class="caption-top text-center round-sm-b p-2 bg-slate-700 border border-slate-200">
                    <Link href="/members" class="bg-gray-100 rounded p-1">Voir toute la liste des membres</Link>
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
                        v-show="member"
                        class="bg-white dark:bg-gray-800 text-center"
                    >
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{member ? member.id : ''}}
                        </th>
                        <td class="px-6 py-4">
                            {{member ? member.name : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{member ? member.email : ''}}
                        </td>
                        <td class="px-6 py-4">
                            {{member ? member.role : ''}}
                        </td>
                        <td class="px-6 py-4">
                                {{member ? member.admin : ''}}
                        </td>

                        <td v-show="member.name" class="px-6 py-4">
                            <Link class="p-2 rounded-sm text-center text-white bg-red-600 hover:opacity-100">
                                supprimer
                            </Link>
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

defineOptions({
    layout: SuperAdminLayout
})

defineProps({
    member: Object,
    admin: Object,
    access_key: Object
})
</script>

<style scoped>
table {
    border-radius: 100px;
    border-radius: 100px;
}
</style>