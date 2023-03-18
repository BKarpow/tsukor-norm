<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3>Генерація звіту у форматі PDF</h3>
                <div class="alert alert-info">
                    <p>
                        Оберіть з я якого числа та по яке ви хочите сформувати
                        звіт. За замовчування стоїть тіль сьогоднішеій день!
                    </p>
                </div>
                <!-- /.alert alert-info -->
                <h4>Оберіть діапазон</h4>
            </div>
            <!-- /.col-md-5 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3">
                <h4>Початок періоду</h4>
                <v-date-picker
                    v-if="show"
                    v-model="dateOne"
                    :attributes="attributes"
                    mode="date"
                    is-dark
                    is24hr
                ></v-date-picker>
                <div class="mt-2 form-group">
                    <label for="startDate">Початкова дата</label>
                    <input
                        type="text"
                        id="startDate"
                        class="form-control"
                        name="startDate"
                        :value="formatDateOne"
                    />
                </div>
                <!-- /.mt-2 form-group -->
            </div>
            <!-- /.col-md-3 -->
            <div
                class="col-md-2 d-flex align-items-center justify-content-center"
            >
                <h4>по</h4>
            </div>
            <!-- /.col-md-2 -->
            <div class="col-md-3">
                <h4>Кінець періоду</h4>
                <v-date-picker
                    v-if="show"
                    v-model="dateTwo"
                    :attributes="attributes"
                    mode="date"
                    is-dark
                    is24hr
                ></v-date-picker>
                <div class="mt-2 form-group">
                    <label for="endDate">Кінцева дата</label>
                    <input
                        type="text"
                        id="endDate"
                        class="form-control"
                        name="endDate"
                        :value="formatDateTwo"
                    />
                </div>
                <!-- /.mt-2 form-group -->
            </div>
            <!-- /.col-md-3 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
import { ref } from "vue";

export default {
    data() {
        return {
            dateOne: new Date(),
            dateTwo: new Date(),
            show: false,
            attributes: [
                {
                    highlight: true,

                    dates: [],
                },
            ],
        };
    },
    computed: {
        formatDateOne() {
            let mon = String(this.dateOne.getMonth() + 1);
            let day = String(this.dateOne.getDate());
            let h = String(this.dateOne.getHours());
            let m = String(this.dateOne.getMinutes());
            mon = mon.length == 1 ? `0${mon}` : `${mon}`;
            day = day.length == 1 ? `0${day}` : `${day}`;
            h = h.length == 1 ? `0${h}` : `${h}`;
            m = m.length == 1 ? `0${m}` : `${m}`;
            const fdatetime = `${this.dateOne.getFullYear()}-${mon}-${day}`;
            this.$emit("chg", fdatetime);
            return fdatetime;
        },
        formatDateTwo() {
            let mon = String(this.dateTwo.getMonth() + 1);
            let day = String(this.dateTwo.getDate());
            let h = String(this.dateTwo.getHours());
            let m = String(this.dateTwo.getMinutes());
            mon = mon.length == 1 ? `0${mon}` : `${mon}`;
            day = day.length == 1 ? `0${day}` : `${day}`;
            h = h.length == 1 ? `0${h}` : `${h}`;
            m = m.length == 1 ? `0${m}` : `${m}`;
            const fdatetime = `${this.dateTwo.getFullYear()}-${mon}-${day}`;
            this.$emit("chg", fdatetime);
            return fdatetime;
        },
    },
    methods: {
        getDates() {
            axios.get("/my-sugar/api/all-dates").then((r) => {
                this.attributes[0].dates = r.data.data.map((item) => {
                    console.log("Dates", new Date(item.date));
                    return new Date(item.date);
                });
                this.show = true;
            });
        },
    },
    mounted() {
        this.getDates();
    },
};
</script>
