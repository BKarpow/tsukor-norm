<template>
    <div class="py-2 px-1 my-1 d-flex justify-content-center">
        <div class="btn-group">
            <button class="btn btn-all" @click="clickBtn('all')">Всі</button>
            <!-- /.btn btn-sm btn-info -->
            <button class="btn btn-green" @click="clickBtn('normal')">
                Можна
            </button>
            <!-- /.btn btn-sm btn-info -->
            <button class="btn btn-yellow" @click="clickBtn('average')">
                Не варто
            </button>
            <!-- /.btn btn-sm btn-info -->
            <button class="btn btn-red" @click="clickBtn('high')">
                Точно ні!
            </button>
            <!-- /.btn btn-sm btn-info -->
        </div>
        <!-- /.btn-group -->
    </div>
    <!-- /.py-2 px-1 my-1 d-flex justify-content-center -->
</template>

<script>
export default {
    methods: {
        clickBtn(profile) {
            if (profile === "normal") {
                this.$emit("on:sort", [0, 55]);
            } else if (profile === "average") {
                this.$emit("on:sort", [56, 70]);
            } else if (profile === "high") {
                this.$emit("on:sort", [71, 100]);
            } else {
                this.$emit("on:sort", [0, 150]);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@mixin btn($color, $fc) {
    background: $color;
    transition: all 0.45s;
    &:hover {
        background: darken($color, 18);
        border: 1px solid darken($color, 35);
        color: $fc;
    }
}
.btn-green {
    @include btn(#79bd8f, white);
}

.btn-yellow {
    @include btn(#ffff9d, black);
}

.btn-red {
    @include btn(#ff6138, white);
}
.btn-all {
    @include btn(#6d67e4, white);
}
</style>
