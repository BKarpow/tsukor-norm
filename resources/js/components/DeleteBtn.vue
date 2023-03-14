<template>
    <div @click="onDeleteBtn">
        <slot></slot>
    </div>
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
    },
    methods: {
        onDeleteBtn() {
            Swal.fire({
                title: "Ви дійсно хочите видалити цей показник?",
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
                                Swal.fire("Видалено!", r.info, "success");
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
