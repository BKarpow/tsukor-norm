<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <ToolConvertMmolToMl />
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</template>

<script>
import ToolConvertMmolToMl from "./ToolConverMmolToMl.vue";
export default {
    name: "ToolsSugar",
    components: {
        ToolConvertMmolToMl,
    },
};
</script>
