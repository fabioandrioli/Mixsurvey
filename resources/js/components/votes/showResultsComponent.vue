<template>
    <div>
        <search-option-site-component :id_survey="surveyid" @searchOption="searchOption"></search-option-site-component>
        <div v-for="option in questionsOptions" :key="option.id"  class="row" >

            <div v-if="option.image != null" class="option_card col-md-4 col-sm-12">
                <div class="form-check">
                    <img class="card-img-top" :src="`../assets/uploads/options/${option.image}`" alt="imagem das opcoes de resultado">
                </div>
            </div>
            <div  style="margin-bottom: 3%; background:#21252912;" class="col-md-8 col-sm-12">
                <div style="padding: 2%" class="form-check">
                    <label style="font-family: 'Chango', cursive;" class="form-check-label" :for="option.title">
                        {{option.title}}
                    </label>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-dark" role="progressbar" :style="'width:' + parseFloat(part_votes(option)) + '%;'" :aria-valuenow="parseFloat(part_votes(option))" aria-valuemin="0" aria-valuemax="100">{{parseFloat(part_votes(option)) + ' %'}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom:10px" class="row">
            <div class="col-12">
              <h5>Total de votos: {{this.votes.all}}</h5>
            </div>
        </div>
    </div>
</template>

<script>
    import SearchOptionSiteComponent from './../search/SearchOptionSiteComponent'
    export default {
        props:{
             options:{
                required:true,
            },
            surveyid:{
                required:true,
            }
         },
        data() {
            return {
                 votes:{
                     all:0,
                    porcent:0
                 },
                 questionsOptions:this.options,
            }
        },
        mounted() {
            console.log(this.options)
            console.log('Component mounted.')
            this.all_vote
        },
        methods:{
             part_votes(option){
                 let porcent
                 if(option.votes != null){
                    porcent = this.votes.porcent = ((option.votes * 100)/this.votes.all)
                    if(porcent % 2 == 0)
                        return porcent.toFixed(0)
                    else
                        return porcent.toFixed(2)
                 }else{
                     return 0;
                 }
            },
            searchOption(options){
                this.questionsOptions = options;
            }
        },
        computed:{
            all_vote: function() {
                this.questionsOptions.forEach(option => {
                    if(option.votes === null)
                        option.votes = 0;
                    this.votes.all = this.votes.all + parseInt(option.votes)
                });
            },
        },
        components:{
           SearchOptionSiteComponent,
        }
    }
</script>
