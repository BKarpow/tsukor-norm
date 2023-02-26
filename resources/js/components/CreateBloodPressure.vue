<template>
    <form @submit.prevent="storeBp">
        <div class="rom mb-2">
            <div class="col-6">
                <DateTimeField @chg="setDt" />
            </div>
            <!-- /.col-6 -->
        </div>
        <!-- /.rom mb-2 -->
        <div class="row mb-2">
            <div class="col-6">
                <div class="form-group">
                    <MaterialField
                        label="Сісталічне"
                        name="sys"
                        type="tel"
                        v-model="sis"
                    />
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-6 -->
            <div class="col-6">
                <div class="form-group">
                    <MaterialField
                        label="Діасталічне"
                        name="dis"
                        type="tel"
                        v-model="dis"
                    />
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-6 -->
        </div>
        <!-- /.row -->
        <div class="form-group mb-2">
            <MaterialField
                label="Пульс"
                name="pulse"
                type="tel"
                v-model="pulse"
            />
        </div>
        <!-- /.form-group -->
        <div class="form-group mb-1">
            <label for="note">Нотатка</label>
            <textarea
                v-model="note"
                name="note"
                id="note"
                cols="30"
                rows="4"
                class="form-control"
            >
                Все добре.
            </textarea>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <button class="btn-sgn">Додати</button>
            <!-- /.btn btn-sgn -->
        </div>
        <!-- /.form-group -->
    </form>
</template>

<script>
import DateTimeField from "./DateTimeField.vue";
import Swal from "sweetalert2";
import MaterialField from "./MaterialField.vue";

const filterNumeric = (val) => {
    let v = String(val);
    return v.replace(/[^\d]/, "");
};

export default {
    name: "CreateBloodPressure",
    components: {
        DateTimeField,
        MaterialField,
    },
    data() {
        return {
            sis: "",
            dis: "",
            pulse: "",
            note: "Все добре.",
            dt: "",
        };
    },
    watch: {
        sis() {
            this.sis = filterNumeric(this.sis);
        },
        dis() {
            this.dis = filterNumeric(this.dis);
        },
        pulse() {
            this.pulse = filterNumeric(this.pulse);
        },
    },
    methods: {
        setDt(val) {
            console.log("Test dt", val);
            this.dt = val;
        },
        clearModels() {
            this.sis = "";
            this.dis = "";
            this.pulse = "";
            this.note = "";
        },

        storeBp() {
            axios
                .post("/api/blood-pressure/store", {
                    sis: this.sis,
                    dis: this.dis,
                    pulse: this.pulse,
                    note: this.note,
                })
                .then((resp) => {
                    Swal.fire("Запис АТ додано!", "", "success");
                    this.$emit("on:store", resp.data);
                    this.clearModels();
                })
                .catch((resp) => {
                    console.log("Cath create at", resp);
                    Swal.fire("Помилка!", resp.response.data.message, "error");
                });
        },
    },
};
</script>
