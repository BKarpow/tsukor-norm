<template>
    <h4>Рівні цукру за весь час</h4>
    <Doughnut v-if="load" :data="data" :options="options" />
    <ul class="list-group mt-2">
        <li class="list-group-item">Вище діапазону: {{ info.maxPer }}%</li>
        <!-- /.list-group-item -->
        <li class="list-group-item">В нормі: {{ info.perNorm }}%</li>
        <!-- /.list-group-item -->
        <li class="list-group-item">Гіпоглікемія: {{ info.minPer }}%</li>
        <!-- /.list-group-item -->
    </ul>
</template>

<script lang="ts">
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";
import { Doughnut } from "vue-chartjs";
ChartJS.register(ArcElement, Tooltip, Legend);
export default {
    name: "ChartDugSugar",
    components: {
        Doughnut,
    },
    data() {
        return {
            load: false,
            info: {},
            data: {
                labels: ["Гіперглікімія", "В рамках", "Гіпоглікімія"],
                datasets: [
                    {
                        label: "Кількість у %",
                        backgroundColor: ["#ff6138", "#79bd8f", "#f2f7a1"],
                        data: [4.8, 94.4, 0.8],
                    },
                ],
            },
            options: {
                responsive: true,
                height: "200px",
                weight: "200px",
            },
        };
    },
    methods: {
        getData() {
            axios.get("/my-sugar/api/percentage").then((resp) => {
                this.data.datasets[0].data = [
                    resp.data.maxPer,
                    resp.data.perNorm,
                    resp.data.minPer,
                ];
                this.info = resp.data;
                this.load = true;
            });
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
