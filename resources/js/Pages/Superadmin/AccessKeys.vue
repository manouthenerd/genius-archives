<template>


    <div class="relative overflow-x-auto ">
        <table
            class="w-full rounded border border-slate-200  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white font-bold dark:text-gray-400 bg-slate-600">
                <tr class="text-center whitespace-nowrap ">
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
            <tbody xlass="divide-y">
                <tr v-for="key in access_keys.data" :key="key.id" class="bg-white dark:bg-gray-800 text-center">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ key.id }}
                    </th>
                    <td class="px-6 py-4 whitespace-nowrap flex items-center gap-2">
                        {{ key.key }}
                        <Copy 
                            @click="(e) => clipboard.copyToClipboard(key.key, e)" 
                            v-if="clipboard.status == false" 
                            size="15"
                            class="bg-slate-100 rounded" 
                        />
                        <CheckCheck 
                            v-if="clipboard.status" 
                            size="15" 
                            class="bg-slate-100 rounded stroke-green-500" 
                        />
                    </td>
                    <td class="px-6 py-4">
                        {{ key.disk_space }}
                    </td>
                    <td class="px-6 py-4">
                        {{ key.lifetime }} jours
                    </td>
                    <td class="px-6 py-4">
                        {{ key.user_id == null ? 'libre' : 'occupée' }}
                    </td>

                    <td class="px-6 py-4">
                        <Link class="p-2 rounded-sm text-center text-white bg-blue-500">
                        modifier
                        </Link>
                    </td>
                </tr>

            </tbody>
        </table>


    </div>
    <div class="mt-4 space-y-4 ml-4">
        <p class="font-bold text-slate-600">Pagination</p>
        <div class="flex gap-4 items-center text-gray-600">
            <Link v-for="link in access_keys.links" :href="link.url" v-html="link.label"
                :class="{ 'text-blue-500 font-bold': link.active }" />
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { CheckCheck, Copy } from 'lucide-vue-next';
import { useClipboard } from '@/stores/clipboard';

defineOptions({
    layout: SuperAdminLayout
})

defineProps({
    access_keys: Object
})

const clipboard = useClipboard()
</script>

<style scoped>
table {
    scrollbar-width: none;
}
</style>