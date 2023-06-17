<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h1 class="text-center">Глікемічний індекс продуктів.</h1>

                <Spinner v-if="load" />
                <SearchInput
                    @on:search="searchInputHelper"
                    @on:empty="getAll"
                />
                <IgSortedButton v-if="!load" @on:sort="sortedHelper" />
                <IGItems v-if="!items.load && !load" :items="items" />
                <Paginate
                    v-if="!load"
                    @to:page="uRequest"
                    :pages="pageInfoArray"
                />
            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row justify-content-center -->
    </div>
    <!-- /.container -->
</template>

<script>
import axios from "axios";
import IGItems from "./IGItems.vue";
import SearchInput from "./SearchInput.vue";
import Spinner from "./Spinner.vue";
import IgSortedButton from "./IgSortedButton.vue";
import Paginate from "./Paginate.vue";

export default {
    data() {
        return {
            items: [],
            load: false,
            pageInfoArray: [],
            infoPages: {},
        };
    },
    components: {
        IGItems,
        SearchInput,
        Spinner,
        IgSortedButton,
        Paginate,
    },
    methods: {
        onClickItem() {
            console.log("Click!!");
        },
        searchInputHelper(sText) {
            this.load = true;
            axios
                .post("/api/ig/search", { search: sText })
                .then((r) => {
                    this.items = r.data.data;
                    this.infoPages = {
                        uri: "/api/ig/search",
                        params: { search: sText },
                        method: "post",
                    };
                    this.pageInfoArray[0] = r.data.links;
                    this.pageInfoArray[1] = r.data.meta;
                    this.load = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        sortedHelper(sLevel) {
            this.load = true;
            axios
                .post("/api/ig/sort", { minIg: sLevel[0], maxIg: sLevel[1] })
                .then((r) => {
                    this.items = r.data.data;
                    this.infoPages = {
                        uri: "/api/ig/sort",
                        params: { minIg: sLevel[0], maxIg: sLevel[1] },
                        method: "post",
                    };
                    this.pageInfoArray[0] = r.data.links;
                    this.pageInfoArray[1] = r.data.meta;
                    this.load = false;
                });
        },
        getAll(uri = "") {
            this.load = true;
            const uriGo =
                uri === "" || typeof uri == "boolean" ? "/api/ig/all" : uri;
            axios.get(uriGo).then((r) => {
                this.items = r.data.data;
                this.pageInfoArray[0] = r.data.links;
                this.pageInfoArray[1] = r.data.meta;
                this.load = false;
            });
        },
        uRequest(u = "") {
            this.load = true;
            let url = u == "" || u == null ? this.infoPages.uri : u;
            axios
                .request({
                    method: this.infoPages.method,
                    url: url,
                    params: this.infoPages.params,
                })
                .then((r) => {
                    this.items = r.data.data;
                    this.pageInfoArray[0] = r.data.links;
                    this.pageInfoArray[1] = r.data.meta;
                    this.load = false;
                });
        },
    },
    mounted() {
        this.getAll();
    },
};
</script>
