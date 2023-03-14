<template>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h4>Профілі глюкози крові</h4>
                <span v-if="!show">Отримання данних...</span>
            </div>
            <!-- /.col-md-11 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
export default {
    name: "GluProfileCharts",
    data() {
        return {
            show: false,
            profileSet: [],
            intervalDays: "7",
        };
    },
    methods: {
        getSet() {
            this.show = false;
            axios.get("/my-sugar/api/profile", {
                params: { interval: Number(this.interval) },
            }).then(res => {
                this.profileSet = res.data.data;
                this.show = true;
            });
        },
    },
    mounted() {
        this.getSet();
    }
};
</script>
