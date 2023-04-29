<template>
    <div @click="showModal = true" :style="bgStyleCalc" class="glucose-item">
        <!-- <p class="text-center"> <i style="font-size: 2rem;" class="bi bi-heart-pulse-fill"></i></p> -->
        <h3> <i  class="bi bi-heart-pulse-fill"></i> &nbsp;{{ bpData.sis }}/{{ bpData.dis }}</h3>
        <h4>{{ bpData.pulse }} чсс. <i v-if="!bpData.isNormalPulse" style="color: var(--yellow-bg);" class="bi bi-exclamation-diamond-fill"></i></h4>
        <p class="text-end text-bold text-">{{ bpData.time }}</p>
    </div>
    <!-- /.glucose-item -->
    <Modal :width="320" title="Артеріальний тиск та пульс" v-model:visible="showModal">
        <div
            :style="bgStyleCalc"
            class="mb-2 p-2 animate__animated animate__zoomIn"
        >
        <h2>{{ bpData.sis }}/{{ bpData.dis }}</h2>
        <h3>{{ bpData.pulse }} чсс.  <i v-if="!bpData.isNormalPulse" style="color: var(--yellow-bg);" class="bi bi-exclamation-diamond-fill"></i></h3>
            <!-- /.glu-value -->
            <div class="my-1">
                <div class="btn-group">
                    <delete-btn :delete-url="`/blood-pressure/delete/${bpData.id}`">
                        <a href="#" class="btn btn-dark"
                            ><i class="fa-solid fa-trash"></i></a
                    ></delete-btn>
                    <a
                        :href="`/blood-pressure/edit/${bpData.id}`"
                        class="btn btn-dark"
                        ><i class="fa-solid fa-pen-to-square"></i
                    ></a>
                </div>
                <!-- /.btn-group -->
            </div>
            <!-- /.my-1 -->
            <p class="desc p-1 mt-2">
                {{ bpData.note }}
            </p>
            <!-- /.desc -->
            <p class="date">{{ bpData.time }}, {{ bpData.date }}</p>
            <!-- /.date -->
        </div>
        <!-- /.cart-glu -->
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
export default {
    name: "PanelBpItem",
    components: {
        Modal,
    },
    props: {
        bpData: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            showModal: false,
        };
    },

    computed: {


        bgStyleCalc() {
            let cl = "var(--green-bg)";
            let clT = "black";
            if ( !this.bpData.isNormalPressure ) {
                cl = "var(--red-bg)";
                clT = "white";
            }
            return `background: ${cl}; color: ${clT};`;
        },

    },
    mounted() {

    },
};
</script>

<style lang="scss" scoped>
.glucose-item {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 0.45rem;
    margin-right: 0.35rem;
    margin-bottom: 0.35rem;
    h3 {
        text-align: center;
    }
    h5 {
        color: #1f1f1f !important;
    }
}
</style>
