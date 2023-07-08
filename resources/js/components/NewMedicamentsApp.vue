<template>
    <div
        class="medicament-app container my-1 p-1"
        :class="{ 'work-bg': isWork }"
    >
        <div class="my-1">
            <div class="alert alert-info">
                <h5><i class="fa-solid fa-circle-info fa-xl"></i> &nbsp; Допомога</h5>
                <p>Для активації ліків, вам потрібно натиснути на назву, якщо перепарат зафарбовано зеленим - значит він активни.</p>
                <p>Активація потрібна щоб відображати ліки, коли ви записуєте їх прийом.</p>
            </div>
            <!-- /.alert alert-info -->
        </div>
        <!-- /.my-1 -->
        <h4>Список Ваших ліків</h4>
        <ul class="m-list">
            <NewMedicamentItem
                v-for="m in meds"
                :med="m"
                :key="m.id"
                @active="medChangeActive(m.id)"
                @control="goToControlPage(m.id)"
            />
        </ul>
        <!-- /.m-list -->
        <div class="mt-4" v-if="medsTrash.length != 0">
            <h4 >Видалені ліки</h4>
        <ul class="m-list">
            <NewMedicamentItem
                v-for="m in medsTrash"
                :med="m"
                :key="m.id"
                @control="goToControlPage(m.id)"
            />
        </ul>
        <!-- /.m-list -->
        </div>
        <!-- /.mt-2 -->

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
            medsTrash: [],
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
        goToControlPage(medId) {
            window.location = '/medicament/edit/' + medId;
            console.log('Control click');
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
        getTrashMeds() {
            this.isWork = false;
            this.isWork = true;
            axios
                .get("/medicament/api/list/trash")
                .then((r) => {
                    this.medsTrash = r.data.data;
                    this.isWork = false;
                })
                .catch((err) => console.error(err));
        },
    },
    mounted() {
        this.getAllMeds();
        this.getTrashMeds();
    },
};
</script>

<style lang="scss" scoped>
.medicament-app {
    transition: all 0.4s;
    min-height: 800px;
}
.work-bg {
    width: 100%;
    height: 100%;
    background: #5cb874;
    opacity: 0.7;
    filter: blur(0.072rem);

    border-radius: 8px;
}
.m-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
</style>
