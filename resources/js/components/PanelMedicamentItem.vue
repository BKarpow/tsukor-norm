<template>
    <div @click="showModal = true" class="glucose-item">
        <h5>
            <img
                width="36"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC8klEQVR4nO2aS2sUQRSFPwRDxAd5iZClCUYl4iIuA6I7QX+BJj5A3YqrRFeuZbL2BwhOIj728RGJCw1xaZIxIihE0YXG6GacYEnBGSia6Uw/qrtHmAOXpnuqzq0z9bq3q6GNNgpDN3AReAysAL9lFeARcEllWhadwATwAzBNbB24AeygxdAPvHYaOgtcBoaAnbIhPZt1yi2obkugH/iohr0DjkeoY8u8V51PrSCm0+mJeaAnRt1e4KXqvhJXYZhUQz4AfQnqW+Gr4rDzqxB0ORP7RAqek+L4Ls7ccV4NeOqB65m4LGfueCDnVzxwXRXXfQrAipwf9MB1SFyWM3f8kvNdHrh2i2uDAmBkrcoXGW0hIWj3yP8ytHq1v8wAi8AaUNV1EZgGxlXOq+Ok2ASuO/eDauRmhLTAADWgrHqFCjmlawcwBfyJKMAEzNYriacQIWh4PE8owATMRtb7ihCy18lRfNlqlKjcp5DtHnvCBGy+2TDzKWTKU6O/AiPAaOB5KYqQpHZHPIMpJrYJiBgW57HAb3a5HshCyF8nap72LGJY98Ey5SyEvHFWqVpKrm/AEfHZP+dLSLnNsImfxvmtQJaZZU8Yx8Z8CznjYVjFFWHkz6uQ/eJYzFGEAZZ9C9kjjs8ZzgnTwH76FmI3QLQs5tETxpnwXoXUY6C1nHrCZNUjR2POER8iDLDkW8jpGKtW2uFkmm2KGykI67HPeE49YWTnGgmppCBccl5i13ISUQs7Kau/Mk1qh8VTzng4Gdk9QnAhJfHdLaLfEc8iqltFv106CkhKbtf0A+IqBX4bVSjuQ4QBbtMEEykdPAG2KYN74anRJmBzzgYcik4dm6VxdNPJ2eunV7nm7HX060AzqbOKk1P3eeyZuSTHgcHj6ai20OCVTYfmTNw4zMiqmhNNh9NWw2wy4gcDtsy1Js4GtGRGzSBrKh+6OsVFtz7TeOh8wmGjgLc6WjvrhPFR0KPMrqx8Yl0Nt9dlPR+LeTTeRhtkhH9wKgdqZkIycgAAAABJRU5ErkJggg=="
            />
            {{ medData.name }}
        </h5>
        <p>{{ medData.dose }}x({{ medData.tabletDose }})</p>
        <p>{{ medData.time }}</p>
    </div>
    <!-- /.glucose-item -->
    <Modal :width="320" title="Прийом ліків" v-model:visible="showModal">
        <h3>{{ medData.name }}</h3>
        <div class="my-2">
            <a :href="`/med-take/edit/${medData.id}`" class="btn btn-dark mb-1 mr-1">
                <i class="bi bi-pencil-square"></i>
            </a>
            <DeleteBtn :deleteUrl="`/med-take/delete/${medData.id}`">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-trash"></i>
                </button>
            </DeleteBtn>
            <!-- /.btn btn-dark -->
            <!-- /.btn btn-dark -->
        </div>
        <p>{{ medData.dose }} ({{ medData.tabletDose }})</p>
        <p>{{ medData.note }}</p>
        <p>{{ medData.time }}</p>
    </Modal>
</template>

<script>
import { Modal } from "usemodal-vue3";
import DeleteBtn from "./DeleteBtn.vue";
export default {
    name: "PanelMedicamentItem",
    components: {
        Modal,
        DeleteBtn,
    },
    props: {
        medData: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            showModal: false,
        };
    },
};
</script>

<style lang="scss" scoped>
.glucose-item {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 0.45rem;
    margin-right: 0.35rem;
    margin-bottom: 0.35rem;
    background: #5cb874;
    color: #f9f9e9;
    h3 {
        text-align: center;
    }
    h5 {
        color: #1f1f1f !important;
    }
}
</style>
