<template>
    <div
        class="medicament-app container my-1 p-1"
        :class="{ 'work-bg': isWork }"
    >
        <div class="work-bg"></div>
        <!-- /.work-bg -->

        <h4>Список Ваших ліків</h4>
        <!-- <div class="alert alert-info mb-2">
            <small @click="getAllMeds">Info</small>
        </div> -->
        <!-- /.alert alert-info -->
        <ul class="m-list">
            <NewMedicamentItem
                v-for="m in meds"
                :med="m"
                :key="m.id"
                @click="medChangeActive(m.id)"
            />
        </ul>
        <!-- /.m-list -->
    </div>
    <!-- /.medicament-app my-1 p-1 -->
</template>

<script>
import axios from "axios";
import NewMedicamentItem from "./NewMedicamentItem.vue";
export default {
    components: {
        NewMedicamentItem,
    },
    data() {
        return {
            isWork: false,
            meds: [],
        };
    },

    methods: {
        medChangeActive(medId) {
            this.isWork = false;
            this.isWork = true;
            axios
                .get("/medicament/api/triggerActive/" + medId)
                .then((res) => {
                    this.getAllMeds();
                });
        },
        getAllMeds() {
            this.isWork = false;
            this.isWork = true;
            axios
                .get("/medicament/api/list/all")
                .then((r) => {
                    this.meds = r.data.data;
                    this.isWork = false;
                })
                .catch((err) => console.error(err));
        },
    },
    mounted() {
        this.getAllMeds();
    },
};
</script>

<style lang="scss" scoped>
.medicament-app {
    transition: all 0.4s;
}
.work-bg {
    width: 100%;
    height: 100%;
    background: #5cb874;
    opacity: 0.7;
    filter: blur(0.072rem);

    border-radius: 8px;
    z-index: 999;
}
.m-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
</style>
