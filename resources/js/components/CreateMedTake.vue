<template>
    <div class="form-group mb-2">
        <ul class="list-group">
            <li
                class="list-group-item overflow-auto"
                v-for="m in meds"
                :key="m.id"
            >
                <div class="input-group">
                    <div class="input-group-text">
                        <input
                            class="form-check-input mt-0"
                            type="checkbox"
                            @change="onChecked($event, m)"
                            value=""
                            aria-label="Checkbox for following text input"
                        />
                    </div>
                    <span class="input-group-text">{{ m.name }}</span>
                    <input
                        type="tel"
                        class="form-control"
                        value="1"
                        :ref="`med${m.id}`"
                        placeholder="Доза"
                        aria-label="Text input with checkbox"
                    />
                </div>
            </li>
            <!-- /.list-group-item -->
        </ul>
        <!-- /.list-group -->
    </div>
    <!-- /.form-group -->


    <div class="mb-2">
        <DateTimeField @get-date="setCreateAt"/>
    </div>
    <!-- /.mb-2 -->

    <div class="form-group mb-2" v-if="dataMeds.length">
        <h4>Вибрані ліки</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="d in dataMeds" :key="d.id">
                {{ d.name }} {{ d.doseTake }}x{{ d.dose }}
            </li>
            <!-- /.list-group-item -->
        </ul>
        <!-- /.list-group -->
    </div>
    <!-- /.form-group mb-2 -->

    <div class="form-group mb-2">
        <textarea
            class="form-control"
            placeholder="Кілька слів ..."
            v-model="note"
        ></textarea>
    </div>

    <div class="form-group mb-2" v-if="dataMeds.length">
        <button @click="saveMedTakes" type="button" class="btn btn-success">
            Записати прийом ліків
        </button>
        <!-- /.btn btn-success -->
    </div>
    <!-- /.form-group mb-2 -->
</template>

<script>
import axios from "axios";

import DateTimeField from './DateTimeField.vue';

export default {
    data() {
        return {
            meds: [],
            dataMeds: new Array(),
            note: "Прийом ліків",
            createAt: "",
        };
    },
    components:{
        DateTimeField
    },
    methods: {
        setCreateAt(ca){
            this.createAt = ca
        },
        getMeds() {
            axios.get("/medicament/api/list").then((r) => {
                this.meds = r.data.data;
            });
        },
        saveMedTakes() {
            axios.post("/med-take/create", this.dataMeds).then((r) => {
                if (r.data.adds) {
                    window.location = '/';
                }
            });
        },
        onChecked(ev, med) {
            if (ev.target.checked) {
                med.med_id = med.id
                med.dose = this.$refs[`med${med.id}`][0].value;
                med.note = this.note;
                med.created_at = this.createAt;
                this.dataMeds.push(med);
            } else {
                this.dataMeds = this.dataMeds.filter(
                    (item) => item.id != med.id
                );
            }
        },
    },
    mounted() {
        this.getMeds();
    },
};
</script>

<style lang="scss" scoped>
.fm {
    outline: none;
    border: none;
    border-bottom: 1px solid #1f1f1f;
    padding-left: 0.35rem;
}
</style>
