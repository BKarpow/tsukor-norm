<template>
    <div class="overflow-auto">
        <Line v-if="load" :data="data" :options="options" />
        <div class="mt-2">
            <Line v-if="load" :data="dataTwo" :options="options" />
        </div>
        <!-- /.mt-2 -->
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
    name: "ChartsBloodPressure",
    components: {
        Line,
    },
    data() {
        return {
            load: false,
            dataTwo: {
                labels: [],
                datasets: [
                    {
                        label: "Пульс",
                        backgroundColor: "#79bd8f",
                        borderColor: "#79bd8f",
                        fill: "#79bd8f",
                        data: [],
                    },
                ],
            },
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Сісталічне",
                        backgroundColor: "#453c67",
                        borderColor: "#453c67",
                        fill: "#453c67",
                        data: [],
                    },
                    {
                        label: "Діастолічне",
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
                // maintainAspectRatio: false,

                // scales: {
                //     X: {
                //         type: "category",
                //         labels: [
                //             "1-й тиждень",
                //             "2-й тиждень",
                //             "3-й тиждень",
                //             "4-й тиждень",
                //             "5-й тиждень",
                //             "6-й тиждень",
                //             "7-й тиждень",
                //             "8-й тиждень",
                //             "9-й тиждень",
                //             "10-й тиждень",
                //             "11-й тиждень",
                //             "12-й тиждень",
                //             "13-й тиждень",
                //         ],
                //     },
                // },
            },
        };
    },
    methods: {
        getData() {
            this.load = false;
            axios.get("/api/blood-pressure/all").then((resp) => {
                this.data.labels = resp.data.data.map((item) => item.date);
                this.dataTwo.labels = resp.data.data.map(
                    (item) => item.date + item.time
                );
                this.dataTwo.datasets[0].data = resp.data.data.map(
                    (item) => item.pulse
                );
                this.data.datasets[0].data = resp.data.data.map(
                    (item) => item.sis
                );
                this.data.datasets[1].data = resp.data.data.map(
                    (item) => item.dis
                );
                this.load = true;
            });
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
