<template>
    <v-date-picker v-model="date" mode="dateTime" is-dark is24hr>
        <template v-slot="{ inputValue, inputEvents }">
            <input
                class="px-2 py-1 border rounded focus:outline-none focus:border-blue-300"
                :value="inputValue"
                v-on="inputEvents"
            />
        </template>
    </v-date-picker>
    <input type="hidden" name="created_at" :value="formatDate" />
</template>

<script>
export default {
    name: "DateTimeField",
    props: ["dt"],
    data() {
        return {
            date: new Date(),
        };
    },
    computed: {
        formatDate() {
            let mon = String(this.date.getMonth() + 1);
            let day = String(this.date.getDate());
            let h = String(this.date.getHours());
            let m = String(this.date.getMinutes());
            mon = mon.length == 1 ? `0${mon}` : `${mon}`;
            day = day.length == 1 ? `0${day}` : `${day}`;
            h = h.length == 1 ? `0${h}` : `${h}`;
            m = m.length == 1 ? `0${m}` : `${m}`;
            const fdatetime = `${this.date.getFullYear()}-${mon}-${day} ${h}:${m}:00`;
            this.$emit("chg", fdatetime);
            return fdatetime;
        },
    },
};
</script>
