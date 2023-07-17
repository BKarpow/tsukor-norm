<template>
    <div v-if="show" class="a-w my-1" v-cloak>
        <div class="text">
           <h5> {{ title }} </h5>
            <slot></slot>
        </div>
        <!-- /.text -->
        <div class="close">
            <i @click="onClose" class="fa-solid fa-circle-xmark"></i>
        </div>
        <!-- /.close -->
    </div>
    <!-- /.a-w -->
</template>

<script>
import md5Hex from "md5-hex";

export default {
    props: {
        title: {
            type: String,
            default: "Попередження",
        },
        alertId: {
            type: String,
            default: "alertWarning1",
        },
    },
    data() {
        return {
            show: false,
            storageId: "",
        };
    },
    methods: {
        onClose() {
            window.localStorage.setItem(this.storageId, "off");
            this.show = false;
        },
    },
    mounted() {
        const dateSalt =  new Date().getTodaysDate();
        this.storageId = md5Hex(
            this.title.toString() + this.alertId.toString() + dateSalt
        );

        const show = window.localStorage.getItem(this.storageId);
        if (show === null) {
            this.show = true;
        } else if (typeof show === "string" && show == "off") {
            this.show = false;
            console.log("Closed alert id:", this.storageId);
        }
    },
};
</script>

<style lang="scss" scoped>
$mainColor: #ff6138;
.a-w {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    color: darken($mainColor, 25);
    background: lighten($mainColor, 31);
    border-left: 4px solid darken($mainColor, 10);
    font-size: 1.3rem;
    font-weight: bold;
}
.close {
    cursor: pointer;
}
</style>
