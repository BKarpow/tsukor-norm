<template>
    <li @click="showModal = true">
            <strong>{{ medData.name }}</strong>{{ ` x${medData.dose}` }} &nbsp;
            <small>{{ medData.time }}</small>
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
        <p>{{ medData.dose }} x ({{ medData.tabletDose }})</p>
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
li {
    display: block;
    padding: 0.3rem;
    border-radius: 6px;
    background: #5CB874;
    color: #FFF3CA;
    margin-bottom: 0.25rem;
    margin-left: 0.25rem;
}
</style>
