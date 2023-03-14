<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <h3>Мій АТ та пульс</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>АТ, пульс</th>
                                <th>Час</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="item in items"
                                :key="item.id"
                                :class="{ 'red-bg': !item.isNormalPressure }"
                            >
                                <td>
                                    {{
                                        `${item.sis}/${item.dis}, ${item.pulse}уд.хв.`
                                    }}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        v-if="!item.isNormalPulse"
                                        fill="var(--yellow-bg)"
                                        class="bi bi-exclamation-triangle-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                                        />
                                    </svg>
                                    <div class="p-1 mt-1">
                                        <p>
                                            {{ item.note }}
                                        </p>
                                    </div>
                                    <!-- /note box -->
                                    <div class="mt-1">
                                        <p class="btn-group">
                                            <a
                                                :href="`/blood-pressure/edit/${item.id}`"
                                                class="btn btn-dark btn-sm"
                                            >
                                                <i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i>
                                            </a>
                                            <!-- /.btn btn-dark btn-sm -->
                                            <button
                                                @click="onDeleteBtn(item.id)"
                                                class="btn btn-danger btn-sm"
                                            >
                                                <i
                                                    class="fa-solid fa-trash-can"
                                                ></i>
                                            </button>
                                        </p>
                                    </div>
                                    <!-- /.mt-1 -->
                                </td>
                                <td>{{ item.time }}</td>
                                <td>{{ item.date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <Paginate :pages="pages" @to:page="getPressure" />
            </div>
            <!-- /.col-md-10 -->
        </div>
    </div>
    <!-- /.container -->
</template>

<script>
import Paginate from "./Paginate.vue";
import Swal from "sweetalert2";
export default {
    name: "TableBloodPressure",
    components: {
        Paginate,
    },
    data() {
        return {
            items: [],
            pages: [],
        };
    },
    methods: {
        onDeleteBtn(bpId) {
            Swal.fire({
                title: "Ви дійсно хочите видалити цей показник?",
                showCancelButton: true,
                confirmButtonText: "Так",
                cancelButtonText: "Ні",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .delete("/api/blood-pressure/destroy/" + bpId)
                        .then((r) => {
                            console.log(r);
                            if (r.data.status) {
                                this.items = this.items.filter(
                                    (item) => item.id != r.data.deletedId
                                );
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
                                "Можливо ви вже видалили це показник",
                                "error"
                            );
                        });
                }
            });
        },
        getPressure(url = "/api/blood-pressure") {
            axios.get(url).then((res) => {
                this.items = res.data.data;
                this.pages = [res.data.links, res.data.meta];
            });
        },
    },
    mounted() {
        this.getPressure();
    },
};
</script>

<style lang="scss" scoped>
.red-bg {
    background: var(--red-bg) !important;
    td {
        color: white !important;
    }
}
</style>
