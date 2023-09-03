<template>
    <button class="btn btn-dark" @click="onDeleteBtn">
        <slot></slot>
    </button>
    <!-- /.main -->
</template>

<script>
import Swal from "sweetalert2";

export default {
    props: {
        deleteUrl: {
            type: String,
            require: true,
        },
        ask: {
            type: String,
            default: "Ви дійсно хочите виконати цю дію?"
        }
    },
    methods: {
        onDeleteBtn() {
            Swal.fire({
                title: this.ask,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Так",
                cancelButtonText: "Ні",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .delete(this.deleteUrl)
                        .then((r) => {
                            if (r.status) {
                                Swal.fire("Виконано!", r.info, "success");
                                location.reload()
                            } else {
                                Swal.fire(
                                    "Ой, щось пішло не так!",
                                    "Звернітся в тех. підтримку!",
                                    "error"
                                );
                            }
                        })
                        .catch((err) => {
                            Swal.fire(
                                "Ой, сталася помилка!",
                                "Можливо ви вже видалили це видаляли",
                                "error"
                            );
                        });
                }
            });
        },
    },
};
</script>
