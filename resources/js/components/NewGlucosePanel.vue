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
                <p v-if="!show" class="grey-bg-100"></p>
                <!-- /.grey-35 -->
                <p v-if="show">
                    <span class="d-block mx-2">
                        <svg
                            width="36"
                            fill="#000000"
                            version="1.1"
                            id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 496 496"
                            xml:space="preserve"
                        >
                            <g>
                                <g>
                                    <g>
                                        <path
                                            d="M464,88c-5.856,0-11.272,1.696-16,4.448V80c0-17.648-14.352-32-32-32c-6.632,0-12.8,2.032-17.912,5.496
				C393.712,41.024,381.952,32,368,32c-13.952,0-25.72,9.024-30.088,21.496C332.8,50.032,326.632,48,320,48
				c-14.872,0-27.288,10.24-30.864,24H236.84c-3.824-14.776-11.048-28.16-20.84-39.288V32h-0.648C197.768,12.416,172.336,0,144,0H40
				C17.944,0,0,17.944,0,40v112c0,22.056,17.944,40,40,40h104c28.336,0,53.768-12.416,71.352-32H216v-0.712
				c9.792-11.128,17.016-24.512,20.84-39.288H288v148.688l-8-8V220c0-19.848-16.152-36-36-36c-19.848,0-36,16.152-36,36v78.04
				l41.768,76.568c5.504,10.096,13.84,18.144,24.12,23.28L288,404.944V496h16V395.056l-22.96-11.48
				c-7.336-3.672-13.296-9.416-17.224-16.624L224,293.96V220c0-11.032,8.968-20,20-20c11.032,0,20,8.968,20,20v47.312L284.688,288
				H304V120h16V72h-13.776c2.776-4.76,7.88-8,13.776-8c8.816,0,16,7.184,16,16v136h16V80V64c0-8.816,7.176-16,16-16
				c8.816,0,16,7.184,16,16v16v8v128h16V88v-8c0-8.816,7.176-16,16-16c8.816,0,16,7.184,16,16v40v8v88h16v-88v-8
				c0-8.816,7.176-16,16-16c8.816,0,16,7.184,16,16v240c0,15.248-8.472,28.96-22.112,35.776L448,400.72V496h16v-85.392l1.048-0.52
				C484.144,400.544,496,381.352,496,360V120C496,102.352,481.648,88,464,88z M144,176H40c-13.232,0-24-10.768-24-24V40
				c0-13.232,10.768-24,24-24h104c17.928,0,34.44,6,47.792,16H184c-13.232,0-24,10.768-24,24v80c0,13.232,10.768,24,24,24h7.792
				C178.44,170,161.928,176,144,176z M207.848,144H184c-4.416,0-8-3.584-8-8V56c0-4.416,3.584-8,8-8h23.848
				C217.936,61.392,224,77.984,224,96S217.936,130.608,207.848,144z M304,104h-64.408c0.224-2.648,0.408-5.304,0.408-8
				s-0.184-5.352-0.408-8H304V104z"
                                        />
                                        <path
                                            d="M333.656,266.344l-11.312,11.312l19.88,19.88C358.84,314.168,368,336.256,368,359.768V392h16v-32.232
				c0-27.784-10.824-53.896-30.464-73.536L333.656,266.344z"
                                        />
                                        <path
                                            d="M32,160h112V32H32V160z M48,48h80v96H48V48z"
                                        />
                                        <rect
                                            x="64"
                                            y="112"
                                            width="16"
                                            height="16"
                                        />
                                        <rect
                                            x="96"
                                            y="112"
                                            width="16"
                                            height="16"
                                        />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <PanelGlucoseItem
                        v-for="g in glucoses"
                        :key="g.time"
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
            targetRange: {},
            sugarLover: true,
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
                    this.targetRange = r.data.targetRange;
                    this.show = true;
                });
        },
        onSugarLover() {
            if (this.sugarLover) {
                this.medicamentsF = this.medicaments.filter(
                    (item) => item.sugarLower
                );
            } else {
                this.medicamentsF = this.medicaments;
            }
        },
    },
    mounted() {
        this.getData();
    },
};
</script>

<style lang="scss" scoped>
$border-radius: 10px;
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
        padding: 0.25rem;
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
