<template>
    <div class="items m-1">
        <IGItem v-for="item in items" :item="item" :key="item.id" />
    </div>
</template>

<script>
import IGItem from "./IGItem.vue";

export default {
    name: "IGItems",
    components: {
        IGItem,
    },
    props: {
        items: {
            type: Array,
        },
    },
};
</script>
