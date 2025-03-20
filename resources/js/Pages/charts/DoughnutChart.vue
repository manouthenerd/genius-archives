<template>


</template>

<script setup>
onMounted( () => {
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