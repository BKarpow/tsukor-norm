<template>
    <div
        :style="bgStyleCalc"
        class="cart-glu mb-2 p-2 animate__animated animate__zoomIn"
    >
        <h3 class="glu-value"> {{ glu }} mmol/L</h3>
        <!-- /.glu-value -->
        <div class="my-1">
            <div class="btn-group">
                <delete-btn :delete-url="deleteUrl">
                    <a href="#" class="btn btn-dark"
                        ><i class="fa-solid fa-trash"></i></a
                ></delete-btn>
                <a :href="editUrl" class="btn btn-dark"
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
        <p class="desc p-1 mt-2">
            {{ descGlu }}
            {{ note }}
        </p>
        <!-- /.desc -->
        <p class="date">{{ time }}, {{ date }}</p>
        <!-- /.date -->
    </div>
    <!-- /.cart-glu -->
</template>
<script>
export default {
    name: "GluItem",
    props: [
        "glu",
        "max",
        "min",
        "bf",
        "af",
        "be",
        "ae",
        "s",
        "h",
        "time",
        "date",
        "note",
        "deleteUrl",
        "editUrl",
    ],
    computed: {
        getNameTimeDay() {
            let nm = "";
            let time = Number(String(this.time).replace(":", ""));
            if (time > 0 && time <= 400) {
                nm = "Під час сну";
            } else if (time > 400 && time <= 600) {
                nm = "Ранковий";
                if (this.bf) {
                    nm = "Нотощ";
                }
            } else if (time > 600 && time <= 1245) {
                nm = "Сніданок";
                if (this.bf) {
                    nm = "Нотощ";
                }
                if (this.af) {
                    nm = "Після сніданку";
                }
            } else if (time > 1245 && time <= 1600) {
                nm = "Обід";
                if (this.bf) {
                    nm = "До обіду";
                }
                if (this.af) {
                    nm = "Після обіду";
                }
            } else if (time > 1600 && time <= 2100) {
                nm = "Вечеря";
                if (this.bf) {
                    nm = "До вечері";
                }
                if (this.af) {
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
            if (this.glu >= this.max) {
                cl = "var(--red-bg)";
                clT = "white";
            }
            if (this.glu < this.max && this.glu > this.min) {
                cl = "var(--green-bg)";
                clT = "black";
            }
            if (this.glu <= this.min) {
                cl = "var(--yellow-bg)";
                clT = "black";
            }
            return `background: ${cl}; color: ${clT};`;
        },
        descGlu() {
            let d = "";
            if (this.bf) {
                d = d + "До їжі. ";
            } else if (this.af) {
                d = d + "Після їжі. ";
            }

            if (this.be) {
                d = d + "До спорту. ";
            } else if (this.ae) {
                d = d + "Після спорту. ";
            }

            if (this.s) {
                d = d + "Стрес. ";
            }
            if (this.h) {
                d = d + "Хвороба. ";
            }

            return d;
        },
    },
};
</script>

<style lang="scss" scoped>
.cart-glu {
    border: 1px solid var(--dark-bg);
    border-radius: 10px;
}
</style>
