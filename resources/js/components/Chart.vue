<template>
    <div class="overflow-auto">
        <h2>Графік цукрів крові</h2>
        <div class="my-1">
            <h3>Цукор крові</h3>
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
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Середній рівень цукру за {{ rangeDays }} днів</h4>
                    <Line v-if="load" :data="data" :options="options" />
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                    <ChartEmptyStomachGlu :range-days="rangeDays" ref="rc" />
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                    <ChartDugSugar />
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.overflow-auto -->
</template>

<script lang="ts">
import ChartEmptyStomachGlu from "./ChartEmptyStomachGlu.vue";
import ChartDugSugar from "./ChartDugSugar.vue";
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
        ChartEmptyStomachGlu,
        ChartDugSugar,
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
                this.$refs.rc.getData(Number(this.rangeDays));
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
