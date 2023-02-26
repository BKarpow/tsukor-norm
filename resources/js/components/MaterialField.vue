<template>
    <label :for="name"> {{ label }}</label>
    <input
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :id="name"
        :name="name"
    />
</template>

<script lang="ts">
export default {
    name: "MaterialField",
    props: {
        type: {
            type: String,
            default: "text",
        },
        modelValue: {
            type: String,
        },
        name: {
            type: String,
            require: true,
        },
        label: {
            type: String,
            require: true,
        },
    },
    computed: {
        labelId() {
            return `label-${this.name}`;
        },
    },
};
</script>

<style scoped lang="scss">
input {
    display: block;
    outline: none;
    border-top: none;
    border-right: none;
    border-left: none;
    border-bottom: 1px solid var(--blue-bg);
}
</style>
