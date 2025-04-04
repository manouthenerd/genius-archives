<template>


    <div class="w-full space-y-8 p-2">

        <div class="relative overflow-x-auto">
            <table
                class="w-full rounded border border-slate-200  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white font-bold dark:text-gray-400 bg-slate-600">
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
                            Membres
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dossiers
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Archives
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date de création
                        </th>

                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(admin, index) in admins"
                        class="bg-white dark:bg-gray-800 text-center whitespace-nowrap">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ admin.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.members }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.folders }}
                        </td>
                        <td class="px-6 py-4">
                            {{ admin.archives }}
                        </td>
                        <!-- <td class="px-6 py-4">
                            {{ admin.used_disk_space }} / {{ admin.total_disk_space }}
                        </td> -->
                        <td class="px-6 py-4">
                            {{ dateFormat.dateOnly(admin.created_at) }} à {{ dateFormat.timeOnly(admin.created_at) }}
                        </td>
                        <td class="px-6 py-4">
                            <Link as="button" method="delete" :href="`admins/${admin.id}`"
                                class="p-2 rounded-sm text-center text-white bg-red-600 hover:opacity-100">
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
import { useCarbonDateFormater } from '@/composables/carbon-date-formater';

defineOptions({
    layout: SuperAdminLayout
})

defineProps({
    admins: Object,
})


const dateFormat = useCarbonDateFormater()
</script>

<style scoped>
table {
    border-radius: 100px;
    border-radius: 100px;
}
</style>