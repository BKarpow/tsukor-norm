<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Ваші норми глюкози крові</h3>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input
                        type="tel"
                        class="form-control"
                        placeholder="Мінімум в день"
                        v-model="minGlu"
                    />
                </div>
                <!-- /.form-group -->
                <div class="form-group mb-2">
                    <input
                        type="tel"
                        class="form-control"
                        placeholder="Мінімум зоанку"
                        v-model="minGluNt"
                    />
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input
                        type="tel"
                        class="form-control"
                        placeholder="Максимум зранку"
                        v-model="maxGluNt"
                    />
                </div>
                <!-- /.form-group -->
                <div class="form-group mb-2">
                    <input
                        type="tel"
                        class="form-control"
                        placeholder="Максимум в день"
                        v-model="maxGlu"
                    />
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button @click="storeOrUpdate" class="btn btn-primary">
                        {{ btnText }}
                    </button>
                    <!-- /.btn btn-primary -->
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
import Swal from "sweetalert2";

const filterInputValue = (val) => {
    let valFilt = String(val);
    valFilt = valFilt.replace(/\,+/, ".");
    valFilt = valFilt.replace(/[^\d\.]+/, "");
    return valFilt;
};

const testInputValue = (val1, val2) => {
    const re = /[\d\.]+/;
    return re.test(val1) && re.test(val1);
};

export default {
    name: "SugarTargetRange",
    data() {
        return {
            minGlu: "",
            minGluNt: "",
            maxGlu: "",
            maxGluNt: "",
            noneStr: true,
        };
    },
    computed: {
        btnText() {
            return this.noneStr ? "Зберигти" : "Оновити";
        },
    },
    watch: {
        minGlu() {
            this.minGlu = filterInputValue(this.minGlu);
        },
        maxGlu() {
            this.maxGlu = filterInputValue(this.maxGlu);
        },
    },
    methods: {
        getLastStr() {
            axios
                .get("/api/str/last")
                .then((resp) => {
                    if (resp.data.status) {
                        this.minGlu = resp.data.str.min_glu;
                        this.maxGlu = resp.data.str.max_glu;
                        this.minGluNt = resp.data.str.min_nt_glu;
                        this.maxGluNt = resp.data.str.max_nt_glu;
                        this.noneStr = false;
                    } else {
                        Swal.fire(
                            "Не вказаний діапазон!",
                            "Вкажіть свій цільовий діапазон рівнів глюкози та збережіть",
                            "error"
                        );
                    }
                })
                .catch((err) => {
                    Swal.fire(
                        "Помилка запиту до серверу!",
                        "Можливо збій інтернет зв'язку",
                        "error"
                    );
                });
        },
        storeOrUpdate() {
            if (!testInputValue(this.minGlu, this.maxGlu)) {
                Swal.fire(
                    "Помилка у формі!",
                    "Обидва поля мають бути заповнені тільки цифрами та десятковою комою!",
                    "error"
                );
                return;
            }
            axios
                .post("/api/str/last", {
                    min_glu: this.minGlu,
                    max_glu: this.maxGlu,
                    min_nt_glu: this.minGluNt,
                    max_nt_glu: this.maxGluNt,
                })
                .then((res) => {
                    if (res.data.status) {
                        let msg = "";
                        if (res.data.type === "store") {
                            msg = "Показники створено!";
                        }
                        if (res.data.type === "update") {
                            msg = "Показники оновлено!";
                        }
                        Swal.fire(msg, "", "success");
                        this.getLastStr();
                    }
                })
                .catch((err) => {
                    Swal.fire(
                        "Помилка запиту до серверу 2!",
                        "Можливо збій інтернет зв'язку",
                        "error"
                    );
                });
        },
    },
    mounted() {
        this.getLastStr();
    },
};
</script>
