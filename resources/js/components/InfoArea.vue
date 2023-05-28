<template>
    <div class="alert  my-1">
        <div class="mb-2">
            <button @click="(ev) => (show = !show)" class="btn btn-info">
                <i class="fa-solid fa-question fa-xl"></i> {{ textBtn }}
            </button>
            <!-- /.btn-info -->
        </div>
        <!-- /.mt-2 -->
        <v-spoiler v-model="show">
            <slot></slot>
        </v-spoiler>

    </div>
    <!-- /.alert alert-info -->
</template>

<script>
export default {
    props:{
        txtHide:{
            type: String,
            default: "Показати підказку"
        },
        txtShow:{
            type: String,
            default: "Сховати підказку"
        },
    },
    data() {
        return {
            show: false,
        };
    },
    computed: {
        textBtn() {
            return this.show ? this.txtShow : this.txtHide;
        },
    },
};
</script>
