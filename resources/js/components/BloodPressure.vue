<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion mt-1" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="false"
                                aria-controls="collapseOne"
                            >
                                Дадати АТ та пульс
                            </button>
                        </h2>
                        <div
                            id="collapseOne"
                            class="accordion-collapse collapse"
                            aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample"
                        >
                            <div class="accordion-body">
                                <CreateBloodPressure @on:store="onStore" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.accordion -->
                <div class="my-1">
                    <ChartsBloodPressure ref="charts" />
                </div>
                <!-- /.my-1 -->

                <TableBloodPressure ref="table" />
                <!-- This table  -->
            </div>
            <!-- /.col-md-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container m-1 -->
</template>

<script>
import CreateBloodPressure from "./CreateBloodPressure.vue";
import TableBloodPressure from "./TableBloodPressure.vue";
import ChartsBloodPressure from "./ChartsBloodPressure.vue";

export default {
    name: "BloodPressure",
    components: {
        CreateBloodPressure,
        TableBloodPressure,
        ChartsBloodPressure,
    },
    data() {
        return {
            activeItem: "collapseOne",
        };
    },
    methods: {
        onStore(data) {
            console.log("new blood pressure", data);
            this.$refs.table.getPressure();
            this.$refs.charts.getData();
        },
    },
};
</script>
