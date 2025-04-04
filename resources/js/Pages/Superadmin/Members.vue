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
                        <!-- <th scope="col" class="px-6 py-3">
                            Membres total
                        </th> -->
                        <th scope="col" class="px-6 py-3">
                            Date de création
                        </th>

                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="member in members" class="bg-white dark:bg-gray-800 text-center whitespace-nowrap">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ member.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ member.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ member.email }}
                        </td>
                        <!-- <td class="px-6 py-4">
                            {{ member.members }}
                        </td>
                        <td class="px-6 py-4">
                            {{ member.folders }}
                        </td> -->
                        <!-- <td class="px-6 py-4">
                            {{ member.archives }}
                        </td> -->
                        <td class="px-6 py-4">
                            {{ dateFormat.dateOnly(member.created_at) }} à {{ dateFormat.timeOnly(member.created_at) }}
                        </td>
                        <td class="px-6 py-4">
                            <Link as="button" method="delete" :href="`admins/${member.id}`"
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
    members: Array,
})


const dateFormat = useCarbonDateFormater()
</script>

<style scoped>
table {
    border-radius: 100px;
    border-radius: 100px;
}
</style>