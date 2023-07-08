<template>
    <li>
        <div
            class="med-item"
            @click="$emit('active')"
            :class="{ active: med.active }"
        >
            <span :style="medNameStyle">{{ med.name }}, {{ med.dose }}</span>
        </div>
        <!-- /.med-item -->
        <div class="med-control" @click="$emit('control')">
            <i class="fa-solid fa-gear fa-xl"></i>
        </div>
        <!-- /.med-control -->
    </li>
</template>

<script>
export default {
    props: {
        med: {
            type: Object,
            require: true,
        },
    },
    computed: {
        medNameStyle() {
            if (this.med.trash) {
                return "text-decoration: line-through; color: #ccc;";
            }
            return "";
        }
    }
};
</script>

<style lang="scss" scoped>
li {
    display: flex;
    align-items: center;
    margin-bottom: 0.35rem;
    border-radius: 8px;
    transition: all 0.6s;
    div {
        padding: 0.7rem;
        background: darken(#fff, 6);
        text-align: center;
        cursor: pointer;
    }
    .med-item {
        font-size: 1.3rem;
        font-weight: bold;
        width: 85%;
    }
    .med-control {
        border-left: 1px solid #fcfcfc;
        width: 15%;
    }
}
.active {
    background: #5cb874;
    color: darken(#fff, 6);
}
</style>
