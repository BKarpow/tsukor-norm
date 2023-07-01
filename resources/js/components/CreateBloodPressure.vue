<template>
    <form @submit.prevent="storeBp">

        <div v-if="infoText.length > 0" class="row my-1">
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-info fa-beat fa-xl"></i>
                <p>
                    <strong> {{ infoText }}</strong>
                </p>
            </div>
            <!-- /.alert alert-success -->
        </div>
        <!-- /.row mb-1 -->
        <div class="row my-2">
            <div class="col-4">
                <input
                    @focus="onFocusSystal"
                    @blur="onBlur"
                    type="tel"
                    ref="sys"
                    id="sys"
                    placeholder="Сісталичний тиск"
                    v-model="systal"
                    class="form-control"
                />
            </div>
            <!-- /.col-4 -->

            <div class="col-4">
                <input
                    @focus="onFocusDiast"
                    @blur="onBlur"
                    type="tel"
                    ref="diast"
                    id="diast"
                    placeholder="Діасталичний тиск"
                    v-model="diast"
                    class="form-control"
                />
            </div>
            <!-- /.col-4 -->
            <div class="col-3">
                <input
                    @focus="onFocusPulse"
                    @blur="onBlur"
                    type="tel"
                    ref="pulse"
                    v-model="pulse"
                    placeholder="Пульс"
                    class="form-control"
                />
            </div>
            <!-- /.col-3 -->
        </div>
        <!-- /.row mb-2 -->
        <div class="row mb-1">
            <div v-if="Number(systal) > 135" class="alert alert-warning mb-1">
                <strong
                    >ВИСОКИЙ СІСТАЛІЧНИЙ ТИСК! {{ systal }} - це
                    перевищення,варто звернутися до лікаря!</strong
                >
            </div>
            <!-- /.alert alert-warning -->
            <div v-if="Number(diast) > 85" class="alert alert-warning mb-1">
                <strong
                    >ВИСОКИЙ ДІАСТАЛІЧНИЙ ТИСК! {{ diast }} - це
                    перевищення,варто звернутися до лікаря!</strong
                >
            </div>
            <!-- /.alert alert-warning -->
            <div v-if="Number(pulse) > 80" class="alert alert-warning mb-1">
                <strong
                    >Тахікардія, високий пульс для спокійного стану!
                    {{ pulse }} - це перевищення,варто звернутися до
                    лікаря!</strong
                >
            </div>
            <!-- /.alert alert-warning -->
        </div>
        <!-- /.row mb-1 -->
        <div class="form-group mb-1">
            <label for="note">Нотатка</label>
            <textarea
                @focus="onFocusNote"
                @blur="onBlur"
                v-model="note"
                name="note"
                ref="note"
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
        <div class="my-1">
            <DateTimeField @chg="setDt" />
        </div>
        <!-- /.my-1 -->

        <div class="form-group">
            <button class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i> &nbsp; Зберегти
            </button>
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
    v = v.replace(/[^\d]/, "");
    return Number(v);
};

export default {
    name: "CreateBloodPressure",
    components: {
        DateTimeField,
        MaterialField,
    },
    data() {
        return {
            systal: "",
            diast: "",
            pulse: "",
            note: "Все добре.",
            dt: "",
            infoText: "",
        };
    },
    watch: {
        systal() {
            this.systal = filterNumeric(this.systal);
            if (this.systal >= 40 && this.systal <= 310) {
                this.$refs.diast.focus();
            }
        },
        diast() {
            this.diast = filterNumeric(this.diast);
            if (this.diast >= 30 && this.diast <= 250) {
                this.$refs.pulse.focus();
            }
        },
        pulse() {
            this.pulse = filterNumeric(this.pulse);
            if (this.pulse >= 30 && this.pulse <= 250) {
                this.$refs.note.focus();
            }
        },
    },
    methods: {
        onFocusSystal() {
            this.infoText =
                "Напишійть показник сісталічного (верхнього) тиску.";
        },
        onFocusDiast() {
            this.infoText =
                "Напишійть показник діасталічного (нижнього) тиску.";
        },
        onFocusPulse() {
            this.infoText =
                "Напишійть показник пульсу (ударів серця за хвилину).";
        },
        onFocusNote() {
            this.infoText = "Опишіть ваш стан.";
        },
        onBlur() {
            this.infoText = "";
        },
        setDt(val) {
            console.log("Test dt", val);
            this.dt = val;
        },
        clearModels() {
            this.systal = "";
            this.diast = "";
            this.pulse = "";
            this.note = "";
            this.infoText = "";
        },

        storeBp() {
            axios
                .post("/api/blood-pressure/store", {
                    sis: this.systal,
                    dis: this.diast,
                    pulse: this.pulse,
                    note: this.note,
                    createdAt: this.dt,
                })
                .then((resp) => {
                    if (resp.data.storeStatus) {
                        Swal.fire("Запис АТ додано!", "", "success");
                        this.clearModels();
                        window.location.href = "/";
                    }

                    // this.$emit("on:store", resp.data);
                })
                .catch((resp) => {
                    console.log("Cath create at", resp);
                    Swal.fire("Помилка!", resp.response.data.message, "error");
                });
        },
    },
    mounted() {
        this.$refs.sys.focus();
    },
};
</script>
