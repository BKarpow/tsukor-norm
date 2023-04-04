<template>
    <h4 align="center">{{ header }}</h4>
    <div class="d-flex justify-content-center align-items-center flex-wrap">
        <v-date-picker v-if="show" v-model="date" :mode="mode" is-dark is24hr></v-date-picker>
    </div>
    <input type="hidden" name="created_at" :value="formatDate" />
</template>

<script>
export default {
    name: "DateTimeField",
    props: {
        onlyDate: {
            type: Boolean,
            default: false,
        },
        dt: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            date: new Date(),
            mode: "dateTime",
            show: false,
        };
    },
    computed: {
        header(){
            let h = "Дата і час"
            if (this.onlyDate) {
                h = "Дата"
            }
            return h
        },
        formatDate() {
            let mon = String(this.date.getMonth() + 1);
            let day = String(this.date.getDate());
            let h = String(this.date.getHours());
            let m = String(this.date.getMinutes());
            mon = mon.length == 1 ? `0${mon}` : `${mon}`;
            day = day.length == 1 ? `0${day}` : `${day}`;
            h = h.length == 1 ? `0${h}` : `${h}`;
            m = m.length == 1 ? `0${m}` : `${m}`;
            const fdatetime = !this.onlyDate
                ? `${this.date.getFullYear()}-${mon}-${day} ${h}:${m}:00`
                : `${this.date.getFullYear()}-${mon}-${day} 00:00:00`;
            this.$emit("chg", fdatetime);
            return fdatetime;
        },
    },
    mounted() {
        if (this.onlyDate) {
            this.mode = "date";
        }
        if (this.dt !== "") {
            this.date = new Date(this.dt);
        }
        this.show = true;
    },
};
</script>
