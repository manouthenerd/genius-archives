<template>
    <div class="grid">
        <div id="charts"
            class="px-2 bg-army overflow-x-scroll overflow-auto flex flex-nowrap gap-4  items-center min-h-10">
            <template v-for="file in files_by_extension">
                <Tag :title="file.file_type" href="#" :counter="file.total" />
            </template>
        </div>
        <!-- Charts -->
        <div class="mt-8 bg-contain bg-no-repeat bg-center">
            <SectionHead title="Statistiques de vos archives" />

            <div class="flex flex-wrap space-y-2 justify-around items-center">
                <div v-show="files_by_extension.length" style="width: 250px; height: 250px;" class="my-4">
                    <canvas id="first-canvas"></canvas>
                </div>
                <div v-if="! files_by_extension.length" class="p-2 rounded max-[896px]:w-full grid justify-items-center space-y-2 w-[320px] h-[312px] bg-[#ffffff40]">
                    <Folder />
                    <p class="font-bold text-[12px]">Vous n'avez pas encore ajouté d'archives</p>
                    <p class="grid text-center">
                        <span> Commencé en cliquant sur</span>
                        <span><i>«Nouvelle archive»</i></span>
                    </p>
                    <div>
                        <Link href="/nouvelle-archive" class="bg-[#215C91] text-center text-white p-1 rounded">
                        + Ajouter une nouvelle archive
                        </Link>
                    </div>
                </div>
                
                <div v-show="userExists() && members_disk_space.length" style="width: 250px; height: 250px;" class="my-4">
                    <canvas id="second-canvas"></canvas>
                </div>
                <div v-if="! members_disk_space.length && userExists()" class="bg-[#ffffff40] p-2 max-[896px]:w-full rounded grid place-content-center content-start w-[320px] h-[312px]">
                    <div class="bg-[content-box] p-2 space-y-2 rounded grid place-content-center">
                        <div class="donut-container">
                            <div class="donut-ring"></div>
                            <div class="donut-center-text">Aucune donnée<br>pour l'instant</div>
                        </div>
                        <p class="font-bold text-[12px]">Vous n'avez pas encore ajouté de membres</p>
                        <p class="grid text-center">
                            <span> Commencé en cliquant sur</span>
                            <span><i>«Ajouter un nouveau membre»</i></span>
                        </p>
                        <div>
                            <button @click="memberModal.openModal" class="bg-[#215C91] text-center text-white p-1 rounded">
                            + Ajouter un nouveau membre
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History -->
            <div v-show="userExists()" class="mt-2">
                <SectionHead title="Résumé de votre historique" />
                <div class="h-[200px] overflow-y-scroll p-2 rounded-md bg-white shadow-inner shadow-lightGray">
                    <div class="h-full">
                        <p class="text-left  rounded-md flex justify-end ">
                            <span class="flex items-center font-bold shadow-lg">
                                <img src="/icons/cpu.svg" alt="memory icon">: {{ user_disk_space ?? '200' }} Go d'espace
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
                                    <tr v-for="member_history in members_history"
                                        class="flex justify-between items-center p-2 mt-2 border rounded-sm">
                                        <td>
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                        </td>
                                        <td>{{ member_history.name }}</td>
                                        <td>{{ translateMemberStatus(member_history.status) }}</td>
                                        <td><i>{{ statusTime(member_history.status, member_history) }}</i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
import { onMounted } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import Folder from "@/Components/Folder.vue";
import { useCreateMemberModalStore } from "@/stores/createMemberModal";

defineOptions({
    layout: MainLayout
})

const props = defineProps({
    files_by_extension: Array,
    members_disk_space: Array,
    user_disk_space: Number,
    members_history: Array
})

const memberModal = useCreateMemberModalStore()

const userExists = () => usePage().props.auth.user.name;

const translateMemberStatus = (status) => status == 'offline' ? 'hors-ligne' : 'en ligne'

const statusTime = (status, history) => status == 'offline' ? history.logout_at : history.login_at

onMounted(() => {
    const firstCanvas = document.querySelector("#first-canvas");
    const secondCanvas = document.querySelector("#second-canvas");

    const file_type_data = {
        labels: props.files_by_extension ? props.files_by_extension.map(file => file.file_type) : ['Aucune archive ajoutée'],
        datasets: [{
            label: "Nombre de fichiers",
            data: props.files_by_extension ? props.files_by_extension.map(file => file.total) : '',
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
        labels: props.members_disk_space ? props.members_disk_space.map(member => `${member.disk_space} Mo`) : ['Aucun ajoutée'],
        datasets: [{
            label: "Membre total",
            data: props.members_disk_space ? props.members_disk_space.map(member => member.total) : '',
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

}
)
</script>

<style scoped>
#charts::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#charts {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

.donut-container {
    position: relative;
    width: 152px;
    height: 152px;
    justify-self: center;
}

.donut-ring {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: conic-gradient(#D1D5DB 0% 100%,
            white 100% 100%);
    mask: radial-gradient(farthest-side, transparent 55%, white 55%);
    -webkit-mask: radial-gradient(farthest-side, transparent 55%, white 55%);
}

.donut-center-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Arial', sans-serif;
    font-size: 12px;
    color: #6B7280;
    text-align: center;
    width: 120px;
}
</style>