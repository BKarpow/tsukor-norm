<template>
    <h4>Конвертер ммоль/л в мг/дл і навпаки.</h4>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="mmol">ммоль / л.</label>
                <input
                    @input="toMg"
                    type="tel"
                    id="mmol"
                    v-model="mmol"
                    class="form-control"
                />
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-3 -->
        <div class="col-6">
            <div class="form-group">
                <label for="mg">мг / дл</label>
                <input
                    @input="toMmol"
                    type="tel"
                    id="mg"
                    v-model="mg"
                    class="form-control"
                />
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-3 -->
    </div>
    <!-- /.row -->
</template>

<script lang="ts">
export default {
    name: "ToolConvertMmolToMl",
    data() {
        return {
            mmol: 0,
            mg: 0,
        };
    },
    methods: {
        toMg() {
            this.mg = Math.floor(this.mmol * 18);
        },
        toMmol() {
            this.mmol = Math.floor(this.mg / 18);
        },
    },
};
</script>
