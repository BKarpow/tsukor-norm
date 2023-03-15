<template>
    <div class="overflow-auto">
        <h4>{{ dateName }}</h4>

        <Line v-if="load" :data="data" :options="options" />
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

const lcStorageName = "gluRangeDays";

export default {
    name: "GluProfileChartItem",
    components: {
        Line,
    },
    props: {
        set: {
            type: Array,
            default: [],
        },
        title: {
            type: String,
            default: "",
        },
        dt: {
            type: String,
            default: "",
        },
    },
    computed: {
        dateName() {
            const months = [
                "Січень",
                "Лютий",
                "Березень",
                "Квітень",
                "Травень",
                "Червень",
                "Липень",
                "Серпень",
                "Вересень",
                "Жовтень",
                "Листопад",
                "Грудень",
            ];
            const dt = new Date(this.dt)
            return `${dt.getDate()} ${months[dt.getMonth()]} ${dt.getFullYear()}`
        },
    },
    data() {
        return {
            load: false,
            data: {
                labels: [],
                datasets: [
                    {
                        label: this.title,
                        backgroundColor: "#453c67",
                        borderColor: "#453c67",
                        fill: "#453c67",
                        data: [],
                    },
                ],
            },
            options: {
                responsive: true,
                // maintainAspectRatio: false,
            },
        };
    },
    mounted() {
        this.load = false;
        this.data.labels = this.set.map((item) => item.time);
        this.data.datasets[0].data = this.set.map((item) => item.glucose);
        this.load = true;
    },
};
</script>

<style scoped>
.overflow-auto {
    overflow: scroll;
}
</style>
