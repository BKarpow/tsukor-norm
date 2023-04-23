<template>
    <div class="panel">
        <div class="panel__head">
            <h3 v-if="show" class="panel__head-title">
                {{ dateName }}
            </h3>
            <h3 v-if="!show" class="grey-bg-35"></h3>
        </div>
        <!-- /.panel__head -->
        <div class="panel__body">
            <div class="panel__body-glucose">
                <h5>Глюкоза крові в mmol/L</h5>
                <p v-if="!show" class="grey-bg-100"></p>
                <!-- /.grey-35 -->
                <p v-if="show">

                    <PanelGlucoseItem
                        v-for="g in glucoses"
                        :key="g.id"
                        :glu-data="g"
                        :tr="targetRange"
                    />
                </p>
            </div>
            <!-- /.panel__body-glucose -->
            <div class="panel__body-medicament">
                <div v-if="!show" class="grey-bg-100"></div>
                <!-- /.grey-ng-75 -->
                <h5 v-if="show && medicaments.length != 0">Ліки</h5>
                <div
                    v-if="show && medicaments.length != 0"
                    class="form-check form-switch m-2"
                >
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        :id="medSwitchId"
                        v-model="sugarLover"
                        @change="onSugarLover"
                    />
                    <label class="form-check-label" :for="medSwitchId">
                       Лише для контролю цукру.
                    </label>
                </div>
                <p class="blocks">
                    <PanelMedicamentItem
                        v-for="med in medicamentsF"
                        :key="med.id"
                        :med-data="med"
                    />
                    <div v-if="sugarLover && medicamentsLen != 0" class="d-flex justify-content-center align-items-center">
                        <p style="cursor: pointer;" @click="showAllMeds">Всі (ще {{ medicamentsLen }}) </p>
                    </div>
                    <!-- /.d-flex justify-content-center align-items-center -->
                </p>
            </div>
            <div class="panel__body-insulin"></div>
            <!-- /.panel__body-insulin -->
        </div>
        <!-- /.panel__body -->
    </div>
    <!-- /.panel -->
</template>

<script>
import PanelGlucoseItem from "./PanelGlucoseItem.vue";
import PanelMedicamentItem from "./PanelMedicamentItem.vue";
export default {
    name: "NewGlucosePanel",
    props: {
        date: {
            type: String,
            required: true,
        },
    },
    components: {
        PanelGlucoseItem,
        PanelMedicamentItem,
    },
    computed: {
        medSwitchId() {
            return `only-sugar-control-${this.date}`;
        },
        dateName() {
            const months = [
                "Січень",
                "Лютий",
                "Березень",
                "Квітень",
                "Травень",
                "Червень",
                "Липень",
                "Серпень",
                "Вересень",
                "Жовтень",
                "Листопад",
                "Грудень",
            ];
            const dt = new Date(this.date);
            return `${dt.getDate()} ${
                months[dt.getMonth()]
            } ${dt.getFullYear()}`;
        },
    },
    data() {
        return {
            show: false,
            glucoses: [],
            insulins: [],
            medicaments: [],
            medicamentsF: [],
            medicamentsLen: 0,
            targetRange: {},
            sugarLover: true,
            ketonTest: false,
            keton: {},
        };
    },
    methods: {
        getData() {
            this.show = false;
            axios
                .get("/glucose-api/get-date", {
                    params: { date: this.date },
                })
                .then((r) => {
                    this.glucoses = r.data.glucose;
                    this.insulins = r.data.insulin;
                    this.medicaments = r.data.medicaments;
                    this.medicamentsF = this.medicaments.filter(
                        (item) => item.sugarLower
                    );
                    this.medicamentsLen = this.medicaments.length - this.medicamentsF.length;
                    this.targetRange = r.data.targetRange;
                    this.ketonTest = typeof r.data.keton == 'object';
                    if (this.ketonTest) {
                        this.keton = r.data.keton;
                    }
                    this.show = true;
                });
        },
        onSugarLover() {

            if (this.sugarLover) {
                this.medicamentsF = this.medicaments.filter(
                    (item) => item.sugarLower
                );
                this.medicamentsLen = this.medicaments.length - this.medicamentsF.length;
            } else {
                this.medicamentsF = this.medicaments;
            }
        },
        showAllMeds() {
            this.sugarLover = false;
            this.onSugarLover();
        }
    },
    mounted() {
        this.getData();
    },
};
</script>

<style lang="scss" scoped>
$border-radius: 6px;
@mixin grey($hi) {
    display: block;
    background: #ccc;
    width: 100%;
    height: $hi;
    padding: 0.25rem;
    border-radius: $border-radius;
}

@mixin blockMix() {
    display: flex;
    // justify-content: space-around;
    flex-wrap: wrap;
    align-items: center;
}
.grey-bg-10 {
    @include grey(10px);
}
.grey-bg-25 {
    @include grey(25px);
}
.grey-bg-35 {
    @include grey(35px);
}
.grey-bg-50 {
    @include grey(50px);
}
.grey-bg-100 {
    @include grey(100px);
}

.panel {
    margin-top: 0.25rem;
    margin-bottom: 0.5rem;
    border: 1px solid #111;
    border-radius: $border-radius;
    &__head {
        border-bottom: 1px solid #111;
    }
    &__head-title {
        padding: 0.35rem;
    }
    &__body-glucose {
        margin-top: 0.1rem;
        padding: 0.25rem;
        p {
            @include blockMix();
        }
    }
    &__body-medicament {
        h5 {
            padding-left: 0.35rem;
        }
        p {
            padding: 0.35rem;
            @include blockMix();
        }
    }
}
</style>
