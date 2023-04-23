<template>
    <div class="form-group mb-2">
        <input
            type="password"
            ref="pass"
            name="password"
            class="form-control my-1"
            placeholder="Пароль"
            required
        />
        <input
            @change="onChange"
            v-model="show"
            type="checkbox"
            class="mt-2 form-check-input mr-2"

            id="showPwd"
        /> &nbsp;
        <label class="" for="showPwd">{{ textLabelCheckbox }}</label>
    </div>
    <!-- /.form-group -->
</template>

<script>
export default {
    name: "PasswordField",
    data() {
        return {
            show: false,
        };
    },
    computed: {
        textLabelCheckbox() {
            return this.show ? "Приховати пароль" : "Показати пароль";
        },
    },
    methods: {
        onChange() {
            if (this.show) {
                this.$refs.pass.type = "text";
            } else {
                this.$refs.pass.type = "password";
            }
        },
    },
};
</script>
