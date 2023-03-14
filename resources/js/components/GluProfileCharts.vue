<template>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h4>Профілі глюкози крові</h4>
                <div class="my-1">
                    <h3>Цукор крові</h3>
                    <div class="form-group">
                        <label for="range_days">Період відображення</label>
                        <select
                            @change="getSet"
                            name="range_days"
                            v-model="intervalDays"
                            id="range_days"
                            class="form-control"
                        >
                            <option value="3">3 дні</option>
                            <option value="7">7 днів</option>
                            <option value="14">14 днів</option>
                            <option value="30">30 днів</option>
                            <option value="90">90 днів</option>
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.my-1 -->
                <span v-if="!show">Отримання данних...</span>
                <div class="mt-1" v-if="show">
                    <GluProfileChartItem
                        v-for="profile in profileSet"
                        :key="profile.date"
                        :set="profile.set"
                        :title="profile.date"
                    />
                </div>
                <!-- /.mt-1 -->
            </div>
            <!-- /.col-md-11 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
import GluProfileChartItem from "./GluProfileChartItem.vue";

export default {
    name: "GluProfileCharts",
    components: {
        GluProfileChartItem,
    },
    data() {
        return {
            show: false,
            profileSet: [],
            intervalDays: "7",
        };
    },
    methods: {
        getSet() {
            this.show = false;
            axios
                .get("/my-sugar/api/profile", {
                    params: { interval: Number(this.intervalDays) },
                })
                .then((res) => {
                    this.profileSet = res.data.data;
                    this.show = true;
                });
        },
    },
    mounted() {
        this.getSet();
    },
};
</script>
