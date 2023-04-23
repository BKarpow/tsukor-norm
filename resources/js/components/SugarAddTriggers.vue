<template>
    <div class="form-group col-md-8">
        <label for="glucose">Ваш поточний цукор крові</label>
        <input
            type="tel"
            name="glucose"
            id="glucose"
            placeholder="рівень в ммол/л"
            maxlength="4"
            size="15"
            autocomplete="off"
            autofocus
            required
            class="form-control"
            v-model="glu"
        />
    </div>
    <!-- /.form-group.col-md-4 -->
    <div class="py-2 mt-2">
        <h4>Додатково</h4>
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="before_food"
                name="before_food"
                v-model="beforeFood"
                @change="onBeforeFood"
            />
            <label class="form-check-label" for="before_food"> До їжі </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="after_food"
                name="after_food"
                v-model="afterFood"
                @change="onAfterFood"
            />
            <label class="form-check-label" for="after_food">
                Після їжі (не раніше ніж через 2 години! )
            </label>
        </div>
    </div>
    <!-- .py-2 -->
    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="before_exercise"
                name="before_exercise"
                v-model="beforeExercise"
                @change="onBeforeExercise"
            />
            <label class="form-check-label" for="before_exercise">
                До фізичного навантаження
            </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="exercise"
                name="exercise"
                v-model="exercise"
                @change="onExercise"
            />
            <label class="form-check-label" for="exercise">
                Під час фізичного навантаження
            </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="after_exercise"
                name="after_exercise"
                v-model="afterExercise"
                @change="onAfterExercise"
            />
            <label class="form-check-label" for="after_exercise">
                Після фізичного навантаження
            </label>
        </div>
    </div>
    <!-- /.py-2 -->

    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="stress"
                name="stress"
            />
            <label class="form-check-label" for="stress"> Стресс </label>
        </div>
    </div>
    <!-- /.py-2 -->

    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="disease"
                name="disease"
            />
            <label class="form-check-label" for="disease"> Хвороба </label>
        </div>
    </div>
    <!-- /.py-2 -->
    <!-- <h3>Ліки</h3>
    <div class="alert alert-success" v-if="medicaments.length == 0">
        <strong
            >Ви не додали ліків, або не вказали що ліки для контролю
            цукпу</strong
        >
    </div> -->
    <!-- /.alert alert-success -->
    <!-- <ul class="list-group my-1">
        <li class="list-group-item" v-for="med in medicaments" :key="med.id">
            {{ med.name }} ({{ med.dose }})
        </li>
    </ul> -->
    <!-- /.list-group mt-1 -->

    <div class="form-group">
        <textarea
            name="comment"
            id="comment"
            cols="20"
            rows="5"
            class="form-control"
            placeholder="Замітка"
            v-model="note"
        ></textarea>
        <!-- /#.form-control -->
    </div>
    <!-- /.form-group -->
</template>

<script>
import Swal from "sweetalert2";
const alertHelper = (gluLevel) => {
    if (gluLevel <= 3.9 && gluLevel > 0) {
        Swal.fire({
            title: "ГІПОГЛІКЕМІЯ!!!",
            html: "У Вас низький рівень цукру крові, терміново їжте цукерку (одну)!",
            icon: "warning",
        });
    } else if (gluLevel >= 9) {
        Swal.fire({
            title: "Високий рівень цукру!!!",
            html: "У Вас високий рівень цукру крові, пийте воду, зробіть прогулянку, нічого неїжте поки рівень цукру не нормалізуєтся!",
            icon: "warning",
        });
    }
};
export default {
    name: "SugarAddTriggers",
    data() {
        return {
            beforeFood: false,
            afterFood: false,
            beforeExercise: false,
            exercise: false,
            afterExercise: false,
            medicaments: [],
            glu: "",
            note: "",
            tID: 0,
        };
    },
    computed: {
        noteMed() {
            let note = "";
            if (this.medicaments.length !== 0) {
                note = "";
                this.medicaments.forEach((item) => {
                    note += `${item.name} (${item.dose}) \n`;
                });
            }
            return note;
        },
    },
    watch: {
        glu() {
            let glu = String(this.glu).replace(/[^\d\.\,]/is, "");
            glu = glu.replace(/\.+/, ".");
            glu = glu.replace(/\,+/, ".");
            glu = glu.replace(",", ".");
            this.glu = glu;
            try {
                clearTimeout(this.tID);
            } catch {
                console.log("Not timer");
            }
            this.tID = setTimeout(() => {
                alertHelper(Number(this.glu));
            }, 1000);
        },
    },
    methods: {
        getMedicaments() {
            axios
                .get("/medicament/api/list/sugar-lower")
                .then((res) => {
                    this.medicaments = res.data.data;
                    console.log("Medicaments loaded!");
                    // this.note = this.noteMed;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        onBeforeFood() {
            this.afterFood = this.afterFood ? false : this.afterFood;
        },
        onAfterFood() {
            this.beforeFood = this.beforeFood ? false : this.beforeFood;
        },
        onBeforeExercise() {
            if (this.beforeExercise) {
                this.exercise = false;
                this.afterExercise = false;
            }
        },
        onExercise() {
            if (this.exercise) {
                this.beforeExercise = false;
                this.afterExercise = false;
            }
        },
        onAfterExercise() {
            if (this.afterExercise) {
                this.exercise = false;
                this.beforeExercise = false;
            }
        },
    },
    mounted() {
        // this.getMedicaments();
    },
};
</script>
