<template>
    <div class="overflow-auto my-1" v-if="load">
        <h3>Ранковий цукор крові за {{ rangeDays }} днів.</h3>
        <Line :data="data" :options="options" />
        <p class="p-1">
            Середній цукор натощак за {{ rangeDays }} днів:
            <strong> {{ avg }} mmol/L </strong>
        </p>
        <!-- /.p-1 -->
    </div>
    <!-- /.overflow-auto -->
</template>

<script lang="ts">
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import { Line } from "vue-chartjs";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

export default {
    name: "ChartEmptyStomachGlu",
    components: {
        Line,
    },
    data() {
        return {
            load: false,
            avg: 0,
            rangeDays: 7,
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Цукор натощак",
                        backgroundColor: "#79bd8f",
                        borderColor: "#79bd8f",
                        fill: "#79bd8f",
                        data: [],
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            color: "rgb(255, 99, 132)",
                        },
                    },
                },
                responsive: true,
            },
        };
    },
    methods: {
        getData(rd: any) {
            this.rangeDays = rd;
            this.load = false;
            const options = {
                params: {
                    range: Number(rd),
                },
            };
            axios.get("/my-sugar/api/empty-stomach", options).then((resp) => {
                this.data.labels = resp.data.sugars.map((item) => item.date);
                this.data.datasets[0].data = resp.data.sugars.map(
                    (item) => item.glu
                );
                this.avg = Number(
                    resp.data.sugars.reduce((a, c) => a + c.glu, 0) /
                        resp.data.sugars.length
                ).toFixed(1);
                this.load = true;
            });
        },
    },
    mounted() {
        // this.getData();
    },
};
</script>
