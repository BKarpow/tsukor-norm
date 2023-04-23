<template>
    
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
