<template>
    <AuthenticatedLayout>
        <div class="grid">
            <div id="charts" class="px-2 bg-army overflow-x-scroll overflow-auto flex flex-wrap gap-4 justify-between items-center min-h-10">
                <Tag title="Mix" href="#" :counter="100" />
                <Tag title="PDF" href="#" :counter="22" />
                <Tag title="EXCEL" href="#" :counter="22" />
                <Tag title="WORD" href="#" :counter="22" />
            </div>
            <!-- Charts -->
            <div  class="mt-8">
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

<style scoped>

#charts::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
#charts {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>