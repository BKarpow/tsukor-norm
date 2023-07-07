<template>
    <li :class="{'active': med.active}">
        {{ med.name }}, {{ med.dose }}
    </li>
</template>

<script>
export default {
    props:{
        med: {
            type: Object,
            require: true,
        }
    }
}
</script>

<style lang="scss" scoped>
    li {
        padding: .7rem;
        margin-bottom: .35rem;
        font-size: 1.3rem;
        font-weight: bold;
        // border: 1px solid #111;
        border-radius: 8px;
        transition: all 0.6s;
        background: darken(#fff, 6);
    }
    .active {
        background: #5cb874;
        color: darken(#fff, 6);
    }
</style>
