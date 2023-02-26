<template>
    <div class="form-group mt-2 col-5">
        <input
            type="tel"
            name="carbohydrates"
            id="carbohydrates"
            placeholder="Вуглеводи в 100г продукту"
            title="Вуглеводи в 100г продукту"
            maxlength="8"
            class="form-control"
            v-model="carbohydrates"
        />
    </div>
    <!-- /.form-group.col-5 -->
    <div class="input-group my-2">
        <div class="input-group-text">
            <input
                class="form-check-input mt-0"
                type="checkbox"
                id="cellulose"
                value=""
                v-model="cellulose"
                aria-label="Checkbox for following text input"
            />
        </div>
        <label for="cellulose" class="px-2">Чи є в продукті клітковина?</label>
    </div>
    <div class="row">
        <div class="form-group mt-2 col-2">
            <input
                type="tel"
                name="one_ho_count"
                id="one_ho_count"
                placeholder="1 ХО це"
                title="Вкажіть кількість продукту в 1 хлібні одиниці"
                pattern="^[\d]+$"
                maxlength="3"
                required
                class="form-control"
                :value="calcHO"
            />
        </div>
        <!-- /.form-group.col-2 -->
        <div class="form-group mt-2 col-4">
            <input
                type="tel"
                name="one_ho_unit"
                id="one_ho_unit"
                placeholder="Наприклад грам, або г."
                title="В яких одиницях міряти"
                required
                class="form-control"
                value="г."
            />
        </div>
        <!-- /.form-group.col-2 -->
    </div>
    <!-- /.row -->
</template>

<script>
import { computed } from "@vue/runtime-core";
export default {
    data() {
        return {
            carbohydrates: 0,
            cellulose: false,
        };
    },
    props:{
        carbohydratesProp:{
            type: Number,
            default: 0
        }
    },
    computed: {
        calcHO() {
            if (this.carbohydrates > 0) {
                const kf = this.cellulose ? 13 : 10;
                let ho = this.carbohydrates / kf;
                return Math.floor(100 / ho);
            } else {
                return 0;
            }
        },
    },
    mounted(){
        if (this.carbohydratesProp != 0) {
            this.carbohydrates = this.carbohydratesProp
        }
    }
};
</script>
