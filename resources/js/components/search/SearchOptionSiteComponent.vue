<template>
    <div class="row">
        <div style="margin-bottom:10px;" class="col-12">
             <form @submit.prevent="searchOption" class="form-inline">
                <input class="form-control mr-sm-2" v-model="form.searchOption" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
         props:{
            id_survey:{
                required:true,
            }
         },
        mounted() {
            console.log('Component mounted.')
            console.log(this.id_survey)
        },
        data() {
            return {
                form: {
                    searchOption:'',
                    survey_id:this.id_survey,
                },
            }
        },
        methods:{
            searchOption(){
                 axios.post('/api/option/search',{
                        search: this.form.searchOption,
                        id: this.form.survey_id,
                    },{
                        headers: {
                         'Content-Type': 'application/json',
                    },
                })
                .then((response) => {
                    console.log(response)
                    if(response.status == 200){
                        this.$emit('searchOption',response.data.options)
                    }
                })
                .catch(
                    error => {
                        console.log(error)
                })
            }
        },
    }
</script>
