<template>
    <div @click="showModal = true" class="glucose-item">
        <h5>
            <i class="fa-solid fa-syringe"></i> &nbsp;
            {{ insData.insulin }}
        </h5>
        <small>{{ insData.type }}</small>
        <p>{{ insData.dose }} ОД</p>
        <p>{{ insData.time }}</p>
    </div>
    <!-- /.glucose-item -->
    <Modal :width="320" title="Прийом ліків" v-model:visible="showModal">
        <h3><i class="fa-solid fa-syringe"></i> &nbsp;
            {{ insData.insulin }}</h3>
        <div class="my-2">
            <a :href="`/insulin-log/edit/${insData.id}`" class="btn btn-dark mb-1 mr-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <DeleteBtn :deleteUrl="`/insulin-log/delete/${insData.id}`">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-trash"></i>
                </button>
            </DeleteBtn>
            <!-- /.btn btn-dark -->
            <!-- /.btn btn-dark -->
        </div>
        <small>{{ insData.type }}</small>
        <p>{{ insData.dose }} ОД</p>
        <p>{{ insData.note }}</p>
        <p>{{ insData.time }}</p>
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
import DeleteBtn from "./DeleteBtn.vue";
export default {
    name: "PanelinsulinItem",
    components: {
        Modal,
        DeleteBtn,
    },
    props: {
        insData: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            showModal: false,
        };
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
    background: #5cb874;
    color: #f9f9e9;
    h3 {
        text-align: center;
    }
    h5 {
        color: #1f1f1f !important;
    }
}
</style>
