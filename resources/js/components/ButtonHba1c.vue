<template>
    <a :href="url"
        v-if="showBtn"
        class="btn-tn m-1  scrollt">
            <i class="fa-solid fa-square-plus"></i> {{ btnText }}
        </a><!-- /.btn btn-primary -->
        <a href="#"
        v-if="showInfo"
        class="btn  scrollt">
         {{ infoText }}
        </a><!-- /.btn btn-primary -->

</template>

<script>
export default {
    props: ['url'],
    data(){
        return {
            showBtn: false,
            showInfo: false,
            btnText: 'HbA1c',
            infoText: "",
        }
    },
    methods:{
        getData(){
            axios.get('/hba1c/api/last').then(r => {
                if (r.data.error) {
                    this.showBtn = true;
                    this.btnText = "Додайте аналіз HbA1c!"
                } else {
                    if (r.data.exceedingIntervalDays) {
                        this.showBtn = true;
                        this.btnText = "Вже час аналізу на HbA1c!"
                    }else {
                        this.showBtn = false;
                        this.showInfo = false;
                        this.infoText = 'Останній!! hba1c: '+r.data.level+'%'
                    }
                }
            })
        }
    },
    mounted(){
        this.getData();
    }
}
</script>
