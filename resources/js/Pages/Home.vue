<template>
    <AuthenticatedLayout>
        <div class="grid">
            <div class="px-2 bg-army overflow-x-scroll flex justify-between items-center h-10">
                <Tag title="Mix" href="#" :counter="100" />
                <Tag title="PDF" href="#" :counter="22" />
                <Tag title="EXCEL" href="#" :counter="22" />
                <Tag title="WORD" href="#" :counter="22" />
            </div>
            <!-- Charts -->
            <div class="mt-2">
                <SectionHead title="Statistiques de vos archives" />
                <div class="flex justify-around flex-wrap gap-4">
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
                    <div class="h-full bg-[url(/icons/empty.svg)] bg-no-repeat bg-center">
                        <p class="text-left  rounded-md flex justify-end">
                            <span class="flex items-center font-bold shadow-lg">
                                <img src="/icons/cpu.svg" alt="memory icon">: 200 Mo utilisée
                            </span>
                        </p>
                        <div class="space-y-2">
                            <p class="flex gap-1">
                               <img src="/icons/laptop.svg" alt="laptop icon">
                               connexion via un appareil windows • <i>Mardi 03 Févr 2025 21H30 • Côte d'ivoire, Abidjan</i>
                            </p>
                            <p class="flex gap-1">
                               <img src="/icons/phone.svg" alt="laptop icon">
                               connexion via un appareil mobile • <i>Mardi 03 Févr 2025 21H30 • Côte d'ivoire, Abidjan</i>
                            </p>
                            <p class="flex gap-1">
                               <img src="/icons/laptop.svg" alt="laptop icon">
                               connexion via un appareil windows • <i>Mardi 03 Févr 2025 21H30 • Côte d'ivoire, Abidjan</i>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Chart from "chart.js/auto";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Tag from '@/Components/Tag.vue';
import SectionHead from '@/Components/SectionHead.vue';
import { onMounted } from "vue";
import { Link } from "@inertiajs/vue3";

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