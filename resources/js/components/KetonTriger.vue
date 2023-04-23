<!-- Use preprocessors via the lang attribute! e.g. <template lang="pug"> -->
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div
                    class="mt-4 d-flex justify-content-center align-items-center"
                >
                    <div
                        class="sw"
                        :class="{ 'active-sw': plus }"
                        @click="doPlus"
                    >
                        Позитивний
                    </div>
                    <div
                        class="sw"
                        :class="{ 'active-sw': minus }"
                        @click="doMinus"
                    >
                        Негативний
                    </div>
                </div>
                <input type="hidden" name="keton" :value="hdInput">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            plus: false,
            minus: true,
        };
    },
    computed:{
        hdInput(){
            return this.plus ? 'on' : 'off';
        }
    },
    methods: {
        doPlus() {
            this.plus = true;
            this.minus = false;
        },
        doMinus() {
            this.plus = false;
            this.minus = true;
        },
    },
};
</script>

<!-- Use preprocessors via the lang attribute! e.g. <style lang="scss"> -->
<style lang="scss">
$oc: #f6f1f1;
$tc: #19a7ce;
.active-sw {
    background: $tc !important;
    color: $oc !important;
}
.sw {
    background: $oc;
    color: $tc;
    padding: 0.85rem;
    border: 1px solid $oc;
    cursor: pointer;
    transition: all 0.3s;
}
.sw:first-child {
    border-radius: 10px 0 0 10px;
}
.sw:last-child {
    border-radius: 0 10px 10px 0;
}
</style>
