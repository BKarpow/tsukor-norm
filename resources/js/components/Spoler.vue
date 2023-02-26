<template>
    <div class="box">
        <div class="mb-2">
            <button @click="vis = !vis" class="btn">+ Деталі..</button>
            <!-- /.btn btn-dark -->
        </div>
        <!-- /.mb-2 -->

        <div v-if="vis" class="cont animate__animated animate__slideInLeft">
            <slot></slot>
        </div>
        <!-- /.animate__animated animate__bounce -->
    </div>
    <!-- /.box -->
</template>
<script>
export default {
    name: "Spoler",
    data() {
        return {
            vis: false,
        };
    },
};
</script>

<style scoped>
.cont {
    border: 1px solid var(--yellow-bg);
    border-radius: 10px;
    padding: 0.5rem;
}
</style>
