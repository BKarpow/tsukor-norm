<template>
    <div @click="showModal = true" class="glucose-item">
        <h5>
            {{ note.title || '---' }}
        </h5>
        <p>{{ note.short }}</p>
        <p>{{ note.time }}</p>
    </div>
    <!-- /.glucose-item -->
    <Modal :width="320" title="Прийом ліків" v-model:visible="showModal">
        <h3>
            {{ note.title }}</h3>
        <div class="my-2">
            <a :href="`/notes/edit/${note.id}`" class="btn btn-dark mb-1 mr-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <DeleteBtn :deleteUrl="`/notes/delete/${note.id}`">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-trash"></i>
                </button>
            </DeleteBtn>
            <!-- /.btn btn-dark -->
            <!-- /.btn btn-dark -->
        </div>
        <p>{{ note.text }}</p>
        <p>{{ note.time }}</p>
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
import DeleteBtn from "./DeleteBtn.vue";
export default {
    components: {
        Modal,
        DeleteBtn,
    },
    props: {
        note: {
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
