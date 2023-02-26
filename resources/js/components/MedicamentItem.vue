<template>
    <div class="d-flex justify-content-between">
        <div class="p-1">
            <slot></slot>
        </div>
        <div class="p-1 form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="before_food"
                name="before_food"
                v-model="medicamentActive"
                @change="medChangeActive"
            />
            <label class="form-check-label" for="before_food">
                Зараз приймаю
            </label>
        </div>
    </div>
    <!-- /.d-flex justify-content-between -->
</template>

<script>
export default {
    name: "MedicamentItem",
    props: ["isActive", "medId"],
    data() {
        return {
            medicamentActive: false,
        };
    },
    methods: {
        medChangeActive() {
            axios
                .get("/medicament/api/triggerActive/" + this.medId)
                .then((res) => {
                    this.medicamentActive = res.data.active;
                });
        },
    },
    mounted() {
        this.medicamentActive = Boolean(this.isActive);
    },
};
</script>
