<template>

        <Head title="Dashboard" />
        <div class="grid">
            <div id="charts"
                class="px-2 bg-army overflow-x-scroll overflow-auto flex flex-wrap gap-4 justify-between items-center min-h-10">
                <Tag title="Mix" href="#" :counter="100" />
                <Tag title="PDF" href="#" :counter="22" />
                <Tag title="EXCEL" href="#" :counter="22" />
                <Tag title="WORD" href="#" :counter="22" />
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
                    <div style="width: 250px; height: 250px;" class="my-4">
                        <canvas id="last-canvas"></canvas>
                    </div>
                </div>
            </div>

            <!-- History -->
            <div class="mt-2">
                <SectionHead title="Résumé de votre historique" />
                <div class="h-[200px] overflow-y-scroll p-2 rounded-md bg-white shadow-inner shadow-lightGray">
                    <div class="h-full">
                        <p class="text-left  rounded-md flex justify-end">
                            <span class="flex gap-1 items-center font-bold shadow-lg">
                                <Cpu size="16px" color="#2563eb" />
                                200 Mo utilisée

                            </span>
                        </p>
                        <div class="space-y-2">
                            <table class="table-auto w-full mt-2">
                                <thead class="w-full bg-slate-400 z-[999]">
                                    <tr class="flex justify-between items-center w-full">
                                        <th scope="col" class="w-1/3 ">Profil</th>
                                        <th scope="col" class="w-1/3 ">Pseudo</th>
                                        <th scope="col" class="w-1/3 ">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="w-full">
                                    <Link href="#">
                                    <tr class="flex justify-between items-center p-2  border rounded-sm">
                                        <td class="flex w-1/3 text-center justify-center">
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                            <span class="size-[8px] rounded-full bg-green-400"></span>
                                        </td class="w-1/3 text-center">
                                        <td class="w-1/3 text-center">Jhon Doe</td>
                                        <td class="w-1/3 text-center">en ligne • <i>actuellement</i></td>
                                    </tr>
                                    </Link>

                                    <Link href="#">
                                    <tr class="flex justify-between items-center p-2  border rounded-sm">
                                        <td class="flex w-1/3 text-center justify-center">
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                            <span class="size-[8px] rounded-full bg-green-400"></span>
                                        </td class="w-1/3 text-center">
                                        <td class="w-1/3 text-center">Jhon Doe</td>
                                        <td class="w-1/3 text-center">en ligne • <i>actuellement</i></td>
                                    </tr>
                                    </Link>

                                    <Link href="#">
                                    <tr class="flex justify-between items-center p-2  border rounded-sm">
                                        <td class="flex w-1/3 text-center justify-center">
                                            <img class="size-[50px] rounded-full" src="/image/profile.jpg"
                                                alt="profile picture">
                                            <span class="size-[8px] rounded-full bg-red-400"></span>
                                        </td class="w-1/3 text-center">
                                        <td class="w-1/3 text-center">Jhon Doe</td>
                                        <td class="w-1/3 text-center">hors ligne • <i>il y a 5min</i></td>
                                    </tr>
                                    </Link>
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
import MainLayout from "@/Layouts/MainLayout.vue";
import SectionHead from '@/Components/SectionHead.vue';
import { onMounted } from "vue";
import { Link, Head, router } from "@inertiajs/vue3";
import { Cpu } from "lucide-vue-next";

defineOptions({
    layout: MainLayout
})

onMounted(() => {
    const firstCanvas = document.querySelector("#first-canvas");
    const secondCanvas = document.querySelector("#second-canvas");
    const lastCanvas = document.querySelector("#last-canvas");

    const data = {
        labels: ['PDF', 'Excel', 'Word', 'Image'],
        datasets: [{
            label: "Nombre de fichiers",
            data: [20, 50, 90, 100],
            backgroundColor: ['red', 'skyblue', 'yellowgreen', 'orange', 'green'],
            borderWidth: 2,
            hoverOffset: 5
        }]
    }

    const options = {
        responsive: true,
        plugins: {

            title: {
                display: true,
                text: "Répartitions par format de documents",
                color: "#001F3D",
                position: 'bottom',
                align: 'center'
            }
        }
    }

    new Chart(firstCanvas, {
        type: 'doughnut',
        data: data,
        options: options
    })
    new Chart(secondCanvas, {
        type: 'doughnut',
        data: data,
        options: options
    })
    new Chart(lastCanvas, {
        type: 'doughnut',
        data: data,
        options: options
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

tbody tr {
    background-color: #f1f5f9;
}

tbody tr:hover {
    transition: .5s background-color;
    background-color: #fff;
}
</style>