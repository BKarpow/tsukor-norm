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
            <div class="panel__body-insulin">
                <div v-if="!show" class="grey-bg-75"></div>
                <!-- /.grey-ng-75 -->
                <h5 v-if="show && insulins.length != 0">Інсулін</h5>
                <p class="blocks">
                    <PanelinsulinItem
                        v-for="ins in insulins"
                        :key="ins.id"
                        :ins-data="ins"
                    />

                </p>
            </div>
            <!-- /.panel__body-insulin -->
            <div class="panel__body-medicament">
                <div v-if="!show" class="grey-bg-100"></div>
                <!-- /.grey-ng-75 -->
                <h5 v-if="show && medicaments.length != 0"><img
                width="36"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC8klEQVR4nO2aS2sUQRSFPwRDxAd5iZClCUYl4iIuA6I7QX+BJj5A3YqrRFeuZbL2BwhOIj728RGJCw1xaZIxIihE0YXG6GacYEnBGSia6Uw/qrtHmAOXpnuqzq0z9bq3q6GNNgpDN3AReAysAL9lFeARcEllWhadwATwAzBNbB24AeygxdAPvHYaOgtcBoaAnbIhPZt1yi2obkugH/iohr0DjkeoY8u8V51PrSCm0+mJeaAnRt1e4KXqvhJXYZhUQz4AfQnqW+Gr4rDzqxB0ORP7RAqek+L4Ls7ccV4NeOqB65m4LGfueCDnVzxwXRXXfQrAipwf9MB1SFyWM3f8kvNdHrh2i2uDAmBkrcoXGW0hIWj3yP8ytHq1v8wAi8AaUNV1EZgGxlXOq+Ok2ASuO/eDauRmhLTAADWgrHqFCjmlawcwBfyJKMAEzNYriacQIWh4PE8owATMRtb7ihCy18lRfNlqlKjcp5DtHnvCBGy+2TDzKWTKU6O/AiPAaOB5KYqQpHZHPIMpJrYJiBgW57HAb3a5HshCyF8nap72LGJY98Ey5SyEvHFWqVpKrm/AEfHZP+dLSLnNsImfxvmtQJaZZU8Yx8Z8CznjYVjFFWHkz6uQ/eJYzFGEAZZ9C9kjjs8ZzgnTwH76FmI3QLQs5tETxpnwXoXUY6C1nHrCZNUjR2POER8iDLDkW8jpGKtW2uFkmm2KGykI67HPeE49YWTnGgmppCBccl5i13ISUQs7Kau/Mk1qh8VTzng4Gdk9QnAhJfHdLaLfEc8iqltFv106CkhKbtf0A+IqBX4bVSjuQ4QBbtMEEykdPAG2KYN74anRJmBzzgYcik4dm6VxdNPJ2eunV7nm7HX060AzqbOKk1P3eeyZuSTHgcHj6ai20OCVTYfmTNw4zMiqmhNNh9NWw2wy4gcDtsy1Js4GtGRGzSBrKh+6OsVFtz7TeOh8wmGjgLc6WjvrhPFR0KPMrqx8Yl0Nt9dlPR+LeTTeRhtkhH9wKgdqZkIycgAAAABJRU5ErkJggg=="
            /> Ліки</h5>
                <p class="">
                    <ul class="list-med">
                        <PanelMedicamentItem
                            v-for="med in medicaments"
                            :key="med.id"
                            :med-data="med"
                        />
                    </ul>
                    <!-- /.list-med-->
                </p>
            </div>
            <div class="panel__body-bp">
                <div v-if="!show" class="grey-bg-75"></div>
                <!-- /.grey-ng-75 -->
                <h5 v-if="show && bloodPressures.length != 0">АТ та пульс</h5>
                <p class="blocks">
                    <PanelBpItem  v-for="bp in bloodPressures" :key="bp.id" :bp-data="bp" />
                </p>
                <!-- /.blocks -->
            </div>
            <!-- /.panel__body-bp -->


            <div class="p-1 mt-1">
                <small>{{ dateName }}</small>
            </div>
            <!-- /.p-1 mt-1 -->

        </div>
        <!-- /.panel__body -->
    </div>
    <!-- /.panel -->
</template>

<script>
import PanelBpItemVue from './PanelBpItem.vue';
import PanelGlucoseItem from "./PanelGlucoseItem.vue";
import PanelMedicamentItem from "./PanelMedicamentItem.vue";
import PanelBpItem from "./PanelBpItem.vue";
import PanelinsulinItem from "./PanelinsulinItem.vue";
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
        PanelBpItem, PanelinsulinItem
    },
    computed: {
        medSwitchId() {
            return `only-sugar-control-${this.date}`;
        },
        dateName() {
            const months = [
                "Січня",
                "Лютого",
                "Березня",
                "Квітня",
                "Травня",
                "Червня",
                "Липня",
                "Серпня",
                "Вересня",
                "Жовтня",
                "Листопада",
                "Грудня",
            ];
            const dt = new Date(this.date);
            const toDay = new Date();
            const nameDayOfWeek = dt.getShortDayOfWeek()
            let dateName = `${nameDayOfWeek}, ${dt.getDate()} ${
                months[dt.getMonth()]
            }, ${dt.getFullYear()}`;
            if (dt.getDayOfYear() === toDay.getDayOfYear()) {
                return `Сьогодні (${dateName})`;
            }
            if (dt.getDayOfYear() === (toDay.getDayOfYear() - 1 )) {
                return `Вчора (${dateName})`;
            }
            return dateName;
        },
    },
    data() {
        return {
            show: false,
            glucoses: [],
            insulins: [],
            medicaments: [],
            medicamentsF: [],
            bloodPressures: [],
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
                    this.bloodPressures = r.data.bloodPressure
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
            color: #1f1f1f;
        }
        p {
            padding: 0.35rem;
            width: 85%;
            // @include blockMix();

                .list-med {
                    list-style: none;
                    padding: .5rem;
                    margin: 0;
                    display: flex;
                    flex-wrap: wrap;
                }

        }
    }
    &__body-bp {
        h5 {
            padding-left: 0.35rem;
            color: #1f1f1f;
        }
        p {
            padding: 0.35rem;
            @include blockMix();
        }
    }
    &__body-insulin {
        h5 {
            padding-left: 0.35rem;
            color: #1f1f1f !important;
        }
        p {
            padding: 0.35rem;
            @include blockMix();
        }
    }
}
</style>
