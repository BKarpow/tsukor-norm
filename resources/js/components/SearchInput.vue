<template>
    <div class="form-group my-2">
        <input
            type="text"
            placeholder="Пошук..."
            v-model="searchText"
            class="form-control"
        />
    </div>
    <!-- /.form-group my-2 -->
</template>

<script>
export default {
    name: "SearchInput",
    data() {
        return {
            searchText: "",
            tID: 0,
        };
    },
    watch: {
        searchText() {
            try {
                clearTimeout(this.tID);
            } catch {
                console.log("Not timer");
            }
            this.tID = setTimeout(() => {
                if (this.searchText.length == 0) {
                    this.$emit("on:empty");
                }
                this.$emit("on:search", this.searchText);
            }, 800);
        },
    },
};
</script>

<style scoped>
input {
    font-size: 1.7rem;
    font-weight: bold;
}
</style>
