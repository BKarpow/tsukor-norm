<template>
    <div
        @click="onClickItem"
        class="ig-cart p-3 my-2"
        :class="{
            'ig-cart-cl-red': highIG,
            'ig-cart-cl-yellow': averageIG,
            'ig-cart-cl-green': normalIG,
        }"
    >
        <h3>
            {{ item.food }}
            <a
                v-if="item.admin"
                :href="item.link_edit"
                class="mx-2 btn btn-dark btn-sm"
            >
                <IconPen />
            </a>
        </h3>
        <div aria-label="Показники продукту" class="text-start">
            <ul>
                <li>
                    Глікемічний інлекс: {{ item.ig }} &nbsp;
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        class="bi bi-info-circle-fill pointe-arrow"
                        viewBox="0 0 16 16"
                        @click="
                            showInfo(
                                `Індекс - ${item.ig} `,
                                'Це показник по якому можна зрозуміти наскільки швидко піднімется цукор(глюкоза) крові. У чистої глюеози показник 100. При діабеті не варто їсти продукти індекс яких вище 50'
                            )
                        "
                    >
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                        />
                    </svg>
                </li>
                <li v-if="item.calories != null">
                    Калорійність: {{ item.calories }}kkal &nbsp;
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        class="bi bi-info-circle-fill pointe-arrow"
                        viewBox="0 0 16 16"
                        @click="
                            showInfo(
                                `${item.calories} кКал. в 100г.`,
                                'Це показник скільки кілокалорій в 100г продукту'
                            )
                        "
                    >
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                        />
                    </svg>
                </li>
                <li v-if="item.protein != null">Білки: {{ item.protein }}г.</li>
                <li v-if="item.fats != null">Жири: {{ item.fats }}г.</li>
                <li>Вуглеводи: {{ item.carbohydrates }}г.</li>
            </ul>
        </div>
        <div class="py-1">
            <span title="Одна хлібна одиниця">
                <input type="tel" size="2" class="clear-input" v-model="ho" />ХО
                &nbsp;
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="currentColor"
                    class="bi bi-info-circle-fill pointe-arrow"
                    viewBox="0 0 16 16"
                    @click="
                        showInfo(
                            `Хдібні одиниці.`,
                            'Хдібна одиниця - це простий спосіб зрозуміти скільки потрібно інсуліну для усвоювання цукру який підвищется в крові після того як ви зїсте певну кількість продукції'
                        )
                    "
                >
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                    />
                </svg>
                ={{ hoCount }}г. це: {{ kkal }} кКал.</span
            >
        </div>
    </div>
</template>

<script>
import IconPen from "../ui/icon/IconPen.vue";
import Swal from "sweetalert2";

export default {
    name: "IGitem",
    props: {
        item: {
            type: Object,
        },
    },
    components: {
        IconPen,
    },
    data() {
        return {
            ho: 1,
            hoCount: this.item.one_ho_count,
            lgCount: 0,
            kkal: 0,
        };
    },
    computed: {
        calcKkal() {
            return Math.floor((this.item.calories / 100) * this.hoCount);
        },
        calcLG() {
            let cbh = this.item.carbohydrates;
            return Math.floor((this.item.ig * cbh) / this.hoCount);
        },
        normalIG() {
            return this.item.ig <= 55;
        },
        averageIG() {
            return this.item.ig > 55 && this.item.ig < 70;
        },
        highIG() {
            return this.item.ig >= 70;
        },
        normalLG() {
            return this.calcLG <= 11;
        },
        averageLG() {
            return this.calcLG > 11 && this.calcLG < 20;
        },
        highLG() {
            return this.calcLG >= 20;
        },
    },
    watch: {
        ho() {
            this.hoCount = Math.floor(this.ho * this.item.one_ho_count);
            this.kkal = this.calcKkal;
            this.lgCount = this.calcLG;
        },
    },
    methods: {
        onClickItem() {
            console.log("Click!!");
        },
        showInfo(title, content) {
            Swal.fire({
                title: title,
                html: content,
                icon: "info",
            });
        },
    },
    mounted() {
        this.kkal = this.calcKkal;
        this.lgCount = this.calcLG;
    },
};
</script>

<style lang="scss" scoped>
.pointe-arrow {
    cursor: pointer;
}
.br-6 {
    border-radius: 6px;
}
.ig-cart {
    h3 {
        border-bottom: 1px solid #000;
    }
    border: 1px solid #46c2cb;
    border-radius: 12px;
    box-shadow: -14px 10px 34px -25px rgba(0, 0, 0, 0.75);
}
.ig-cart-cl-red {
    background: #ff6138;
    color: white;
}
.ig-cart-cl-yellow {
    background: #ffff9d;
    color: black;
}
.ig-cart-cl-green {
    background: #79bd8f;
    color: black;
}

.clear-input {
    background: inherit;
    border-top: none;
    border-left: none;
    border-right: none;
    text-align: end;
    color: inherit;
    text-align: start;
    transition: all 0.4s;
    &:focus {
        outline: none;
        padding: 0.5rem;
    }
}
ul {
    list-style: none;
    padding: 0;
    margin: 0;
    border-bottom: 1px solid black;
    li {
        font-size: 1.2rem;
    }
}
</style>
