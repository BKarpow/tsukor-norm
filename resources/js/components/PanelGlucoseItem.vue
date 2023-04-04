<template>
    <div @click="showModal = true" :style="bgStyleCalc" class="glucose-item">

        <h3>{{ gluData.glucose }}</h3>
        <p>{{ gluData.time }}</p>
    </div>
    <!-- /.glucose-item -->
    <Modal :width="320" title="Цукор крові" v-model:visible="showModal">
        <div
            :style="bgStyleCalc"
            class="mb-2 p-2 animate__animated animate__zoomIn"
        >
            <h3 class="glu-value">{{ gluData.glucose }} mmol/L</h3>
            <!-- /.glu-value -->
            <div class="my-1">
                <div class="btn-group">
                    <delete-btn delete-url="#">
                        <a href="#" class="btn btn-dark"
                            ><i class="fa-solid fa-trash"></i></a
                    ></delete-btn>
                    <a href="#" class="btn btn-dark"
                        ><i class="fa-solid fa-pen-to-square"></i
                    ></a>
                </div>
                <!-- /.btn-group -->
            </div>
            <!-- /.my-1 -->
            <div class="p-1">
                <strong>
                    {{ getNameTimeDay }}
                </strong>
            </div>
            <!-- /.p-1 -->
            <p class="mt-1 p-1">
                {{ desc }}
            </p>
            <!-- /.mt-1 p-1 -->
            <p class="desc p-1 mt-2">
                {{ descGlu }}
                {{ gluData.note }}
            </p>
            <!-- /.desc -->
            <p class="date">{{ gluData.time }}, {{ gluData.date }}</p>
            <!-- /.date -->
        </div>
        <!-- /.cart-glu -->
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
export default {
    name: "PanelGlucoseItem",
    components: {
        Modal,
    },
    props: {
        gluData: {
            type: Object,
            require: true,
        },
        tr: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            showModal: false,
            ranok: false,
            desc: "",
        };
    },
    computed: {
        getNameTimeDay() {
            let nm = "";
            let time = Number(String(this.gluData.time).replace(":", ""));
            if (time > 0 && time <= 400) {
                nm = "Під час сну";
            } else if (time > 400 && time <= 600) {
                nm = "Ранковий";
                if (this.gluData.beforeFood) {
                    nm = "Натще";
                    this.ranok = true;
                }
            } else if (time > 600 && time <= 1245) {
                nm = "Сніданок";
                if (this.gluData.beforeFood) {
                    nm = "Натще";
                    this.ranok = true;
                }
                if (this.gluData.afterFood) {
                    nm = "Після сніданку";
                }
            } else if (time > 1245 && time <= 1600) {
                nm = "Обід";
                if (this.gluData.beforeFood) {
                    nm = "До обіду";
                }
                if (this.gluData.afterFood) {
                    nm = "Після обіду";
                }
            } else if (time > 1600 && time <= 2100) {
                nm = "Вечеря";
                if (this.gluData.beforeFood) {
                    nm = "До вечері";
                }
                if (this.gluData.afterFood) {
                    nm = "Після вечері";
                }
            } else if (time > 2100 && time <= 2359) {
                nm = "Перед сном.";
            }

            return nm;
        },
        bgStyleCalc() {
            let cl = "var(--green-bg)";
            let clT = "black";
            if (this.gluData.glucose >= this.tr.max_glu) {
                cl = "var(--red-bg)";
                clT = "white";
                this.desc =
                    "Високий рівень цукру крові! Межа: " + this.max + " mmol/L";
            }
            if (
                this.gluData.glucose < this.tr.max_glu &&
                this.gluData.glucose > this.tr.min_glu
            ) {
                cl = "var(--green-bg)";
                clT = "black";
                this.desc = "Все добре - це нормальний рівень цукру!";
            }
            if (this.gluData.glucose <= this.tr.min_glu) {
                cl = "var(--yellow-bg)";
                clT = "black";
                this.desc =
                    "УВАГА!! ГІПОГЛІКЕМІЯ, терміново їжте цукерку! Межа: " +
                    this.min +
                    " mmol/L";
            }
            if (this.gluData.glucose >= this.tr.max_nt_glu && this.ranok) {
                cl = "var(--red-bg)";
                clT = "white";
                this.desc =
                    "Перевищення рівня цукру натще! Норма " +
                    this.maxnt +
                    " mmol/L";
            }
            return `background: ${cl}; color: ${clT};`;
        },
        descGlu() {
            let d = "";
            if (this.gluData.beforeFood) {
                d = d + "До їжі. ";
            } else if (this.gluData.afterFood) {
                d = d + "Після їжі. ";
            }

            if (this.gluData.beforeExercise) {
                d = d + "До спорту. ";
            } else if (this.ae) {
                d = d + "Після спорту. ";
            }

            if (this.gluData.stress) {
                d = d + "Стрес. ";
            }
            if (this.gluData.disease) {
                d = d + "Хвороба. ";
            }

            return d;
        },
    },
};
</script>

<style lang="scss" scoped>
.glucose-item {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 0.45rem;
    margin-right: 0.35rem;
    h3 {
        text-align: center;
    }
}
</style>
