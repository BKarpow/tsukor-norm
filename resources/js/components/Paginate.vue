<template>
    <div class="container">
        <div class="row">
            <div class="col-5">
                <a
                    v-if="isExistsPrevPage"
                    title="Попередня сторінка"
                    class="btn-paginate"
                    @click="toPage(uriPrevPage)"
                >
                    <IconCarets :size="32" :back="true" />
                </a>
                <!-- /.btn-paginate -->
            </div>
            <!-- /.col-5 -->
            <div class="col-2">
                <div class="pages-counter">
                    {{ pagesCounter }}
                </div>
                <!-- /.pages-counter -->
            </div>
            <!-- /.col-2 -->
            <div class="col-5">
                <a
                    v-if="isExistsNextPage"
                    title="Наступна сторінка"
                    class="btn-paginate"
                    @click="toPage(uriNextPage)"
                >
                    <IconCarets :size="32" :back="false" />
                </a>
                <!-- /.btn-paginate -->
            </div>
            <!-- /.col-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
import IconCarets from "../ui/icon/IconCarets.vue";
export default {
    components: {
        IconCarets,
    },
    props: {
        pages: {
            type: Array,
            require: true,
        },
    },
    computed: {
        pagesCounter() {
            if (this.pages.length == 0) {
                return "0/0";
            }
            return `${this.pages[1].current_page}/${this.pages[1].last_page}`;
        },
        isExistsPrevPage() {
            if (this.pages.length == 0) {
                return false;
            }
            return this.pages[0].prev !== null;
        },
        isExistsNextPage() {
            if (this.pages.length == 0) {
                return false;
            }
            return this.pages[0].next !== null;
        },
        uriPrevPage() {
            return this.pages[0].prev;
        },
        uriNextPage() {
            return this.pages[0].next;
        },
    },
    methods: {
        toPage(uri) {
            this.$emit("to:page", uri);
        },
    },
};
</script>

<style lang="scss" scoped>
.btn-paginate {
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: black;
    border: 1px solid #453c67;
    border-radius: 4px;
    padding: 1rem;
    transition: all 0.4s;
    &:hover {
        background: #453c67;
        color: white;
    }
    &:active {
        background: darken(#453c67, 11);
        color: darken(white, 11);
    }
}
.pages-counter {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    font-size: 1.5rem;
    letter-spacing: 0.3rem;
}
</style>
