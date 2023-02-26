<template>
    <div class="overflow-auto">
        <div class="my-1">
            <div class="form-group">
                <label for="range_days">Період відображення</label>
                <select
                    @change="onSelect"
                    name="range_days"
                    v-model="rangeDays"
                    id="range_days"
                    class="form-control"
                >
                    <option value="7">7 днів</option>
                    <option value="14">14 днів</option>
                    <option value="30">30 днів</option>
                    <option value="90">90 днів</option>
                    <option value="180">180 днів</option>
                </select>
                <!-- /#.form-control -->
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.my-1 -->
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
    name: "Chart",
    components: {
        Line,
    },
    props: {
        title: {
            type: String,
            default: "GLU",
        },
    },
    data() {
        return {
            rangeDays: "7",
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
    methods: {
        onSelect() {
            // console.log(this.rangeDays);
            localStorage.setItem(lcStorageName, this.rangeDays);
            this.getData();
        },
        getData() {
            this.load = false;
            const options = {
                params: {
                    range: Number(this.rangeDays),
                },
            };
            axios.get("/my-sugar/api/analytic", options).then((resp) => {
                this.data.labels = resp.data.data.map((item) => item.date);
                this.data.datasets[0].data = resp.data.data.map(
                    (item) => item.glu
                );
                this.load = true;
            });
        },
    },
    mounted() {
        const rd = localStorage.getItem(lcStorageName);
        this.rangeDays = rd == null ? "7" : rd;
        this.getData();
    },
};
</script>

<style scoped>
.overflow-auto {
    overflow: scroll;
}
</style>
