<template>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h2>Глікемічні профілі</h2>
                <div class="my-1">
                    <h3>Графік цукру за добу</h3>
                    <div class="form-group">
                        <label for="range_days">Період відображення</label>
                        <select
                            @change="getSet"
                            name="range_days"
                            v-model="intervalDays"
                            id="range_days"
                            class="form-control"
                        >
                            <option value="1">1 день</option>
                            <option value="2">2 дні</option>
                            <option value="3">3 дні</option>
                            <option value="7">7 днів</option>
                            <option value="14">14 днів</option>
                            <option value="30">30 днів</option>
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.my-1 -->
                <span v-if="!show">Отримання данних...</span>
                <!-- /.mt-1 -->
            </div>
            <!-- /.col-md-11 -->
        </div>
        <!-- /.row -->
        <div class="row d-flex flex-wrap mt-1" v-if="show">
            <div
                class="col-md-4 "
                v-for="profile in profileSet"
                :key="profile.date"
            >
                <GluProfileChartItem
                    :set="profile.set"
                    :title="profile.date"
                    :dt="profile.dateSystem"
                />
            </div>
            <!-- /.col-md-4 m-1 -->
        </div>
        <!-- /.row d-flex flex-wrap -->
    </div>
    <!-- /.container -->
</template>

<script>
import GluProfileChartItem from "./GluProfileChartItem.vue";

const generateRandomHexColor = () => {
  const hexCharacters = '0123456789ABCDEF';
  let hexColor = '#';
  for (let i = 0; i < 6; i++) {
    hexColor += hexCharacters[Math.floor(Math.random() * 16)];
  }
  return hexColor;
}

export default {
    name: "GluProfileCharts",
    components: {
        GluProfileChartItem,
    },
    data() {
        return {
            show: false,
            profileSet: [],
            intervalDays: "2",
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
