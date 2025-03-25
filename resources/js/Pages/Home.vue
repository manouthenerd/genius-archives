<template>
        <div class="grid">
            <div id="charts"
                class="px-2 bg-army overflow-x-scroll overflow-auto flex flex-nowrap gap-4  items-center min-h-10">
                <template v-for="file in files_by_extension">
                    <Tag :title="file.file_type" href="#" :counter="file.total" />
                </template>
            </div>
            <!-- Charts -->
            <div class="mt-8">
                <SectionHead title="Statistiques de vos archives" />
                <div id="charts" class="flex justify-around flex-wrap gap-4">
                    <div style="width: 250px; height: 250px;" class="my-4">
                        <canvas id="first-canvas"></canvas>
                    </div>
                    <div style="width: 250px; height: 250px;" class="my-4">
                        <canvas id="second-canvas"></canvas>
                    </div>
                    <!-- <div style="width: 250px; height: 250px;" class="my-4">
                        <canvas id="last-canvas"></canvas>
                    </div> -->
                </div>
            </div>

            <!-- History -->
            <div class="mt-2">
                <SectionHead title="Résumé de votre historique" />
                <div class="h-[200px] overflow-y-scroll p-2 rounded-md bg-white shadow-inner shadow-lightGray">
                    <div class="h-full">
                        <p class="text-left  rounded-md flex justify-end">
                            <span class="flex items-center font-bold shadow-lg">
                                <img src="/icons/cpu.svg" alt="memory icon">: {{ user_disk_space  ?? '200' }} Go d'espace
                            </span>
                        </p>
                        <div class="space-y-2">
                            <table class="table-auto w-full space-y-2 mt-2">
                                <thead class="w-full">
                                    <tr class="flex justify-between items-center">
                                        <th>Profil</th>
                                        <th>Pseudo</th>
                                        <th>Status</th>
                                        <th>Période</th>
                                    </tr>
                                </thead>
                                <tbody class="w-full">
                                    <tr class="flex justify-between items-center p-2 mt-2 border rounded-sm">
                                        <td>
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                        </td>
                                        <td>Jhon Doe</td>
                                        <td>Actif</td>
                                        <td><i>Depuis 5min</i></td>
                                    </tr>
                                    <tr class="flex justify-between items-center p-2 mt-2 border rounded-sm">
                                        <td>
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                        </td>
                                        <td>Jhon Doe</td>
                                        <td>Actif</td>
                                        <td><i>Depuis 5min</i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</template>

<script setup>
import Chart from "chart.js/auto";
import Tag from '@/Components/Tag.vue';
import SectionHead from '@/Components/SectionHead.vue';
import { onMounted, reactive } from "vue";
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

defineOptions({
    layout: MainLayout
})

const props = defineProps({
    files_by_extension: Array,
    members_disk_space: Array,
    user_disk_space: Number
})


onMounted( () => {
    const firstCanvas = document.querySelector("#first-canvas");
    const secondCanvas = document.querySelector("#second-canvas");
    const lastCanvas = document.querySelector("#last-canvas");

    const file_type_data = {
        labels: props.files_by_extension.map( file => file.file_type),
        datasets: [{
            label: "Nombre de fichiers",
            data: props.files_by_extension.map( file => file.total),
            backgroundColor: ['#91684A', 'yellowgreen', '#eab308 ', '#161D6F', '#0278AE'],
            borderWidth: 2,
            hoverOffset: 5
        }]
    }

    const file_data_options = {
        responsive: true,
        plugins: {

            title: {
                display: true,
                text: "Mes archives par type",
                color: "#001F3D",
                position: 'bottom',
                align: 'center'
            }
        }
    }

    const members_disk_space_data = {
        labels: props.members_disk_space.map( member => `${member.disk_space} Mo`),
        datasets: [{
            label: "Membre total",
            data: props.members_disk_space.map( member => member.total),
            backgroundColor: [
                '#DDA853', '#27548A', '#210F37', '#ACD3A8', '#522546'
            ],
            borderWidth: 2,
            hoverOffset: 5
        }]
    }

    const members_disk_options = {
        responsive: true,
        plugins: {

            title: {
                display: true,
                text: "Quota d'espace par membre",
                color: "#001F3D",
                position: 'bottom',
                align: 'center'
            }
        }
    }

    new Chart(firstCanvas, {
        type: 'doughnut',
        data: file_type_data,
        options: file_data_options
    })

    new Chart(secondCanvas, {
        type: 'doughnut',
        data: members_disk_space_data,
        options: members_disk_options
    })
    // new Chart(lastCanvas, {
    //     type: 'doughnut',
    //     data: data,
    //     options: options
    // })
}
)
</script>

<style scoped>

#charts::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#charts {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}

img::after {
    content: "";
    width: 20px;
    height: 20px;
    display: inline;
    background-color: blue;
    border-radius: 100%;
}

</style>