<template>
    <li @click="showModal = true" class="list-group-item list-group-item-info">
        <p>
            <strong>{{ medData.name }}</strong> {{ medData.dose }}x({{
                medData.tabletDose
            }})
            <small>{{ medData.time }}</small>
        </p>
    </li>
    <!-- /.list-group-item -->
    <Modal :width="320" title="Прийом ліків" v-model:visible="showModal">
        <h3>{{ medData.name }}</h3>
        <div class="my-2">
            <a
                :href="`/med-take/edit/${medData.id}`"
                class="btn btn-dark mb-1 mr-1"
            >
                <i class="bi bi-pencil-square"></i>
            </a>
            <DeleteBtn :deleteUrl="`/med-take/delete/${medData.id}`">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-trash"></i>
                </button>
            </DeleteBtn>
            <!-- /.btn btn-dark -->
            <!-- /.btn btn-dark -->
        </div>
        <p>{{ medData.dose }} ({{ medData.tabletDose }})</p>
        <p>{{ medData.note }}</p>
        <p>{{ medData.time }}</p>
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
import DeleteBtn from "./DeleteBtn.vue";
export default {
    name: "PanelMedicamentItem",
    components: {
        Modal,
        DeleteBtn,
    },
    props: {
        medData: {
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
