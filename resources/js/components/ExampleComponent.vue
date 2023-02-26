<template>
    <MaterialField
        label="Systalic pressure"
        type="tel"
        v-model="fValue"
        name="test"
    />
    <spoler> Test 123 </spoler>
</template>

<script>
import MaterialField from "./MaterialField.vue";
import Spoler from "./Spoler.vue";

export default {
    components: {
        MaterialField,
        Spoler,
    },
    data() {
        return {
            fValue: "123",
        };
    },

    mounted() {
        console.log("Component mounted.");
    },
};
</script>
