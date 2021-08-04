<template>
    <div class="row">
        <div class="col-12">
            <search-option-site-component :id_survey="surveyId" @searchOption="searchOption"></search-option-site-component>
            <form  @submit.prevent="(event) => sendVote(event)">
                <div v-for="option in questionsOptions" :key="option.id"  class="row"  >
                    <div v-if="option.image != null" class="option_card col-md-4 col-sm-12">
                        <div>
                            <label class="option_choose"  :for="option.title">
                               <img class="card-img-top" :src="`../assets/uploads/options/${option.image}`" alt="imagem das opcoes de voto">
                            </label>
                        </div>
                    </div>
                    <div  style="margin-bottom: 3%; background:#21252912;" class="col-md-8 col-sm-12">
                        <div style="padding: 2%" class="form-check">
                            <input class="form-check-input" type="radio" :value="option.id" name="option" v-model="form.option_id" :id="option.title">
                            <label class="option_choose form-check-label" :for="option.title">
                                {{option.title}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style="margin:5px" class="col-md-12 col-sm-12">
                        <div class="g-recaptcha" style="transform:scale(0.8);transform-origin:0 0" :data-sitekey="this.mySiteKeyVariable"></div>
                    </div>
                    <div class="col-12">
                        <button  v-if="!vote_register" type="submit" class="btn btn-success">
                            votar
                        </button>
                        <button  @click="hasHistory" type="submit" class="btn btn-info">
                            voltar
                        </button>
                        <a  style="color:white" href="" v-if="!this.hasSession" @click.prevent="showResults" class="btn btn-info">Ver resultados</a>
                        <img v-if="preloader" width="120" height="120"  class="img-responsive"  src="/assets/preloader.gif">
                    </div>
                    <div v-if="success || fail" style="margin-top:5px" class=" col-12 alert alert-success" role="alert">
                        {{message}}
                    </div>
                </div>
            </form>
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
            surveyId:{
                required:true,
            },
            hasSession:{
                required:true,
                 type:Boolean,
                default:false,
            }
         },
        data() {
            return {
                preloader:false,
                success:false,
                fail:false,
                message:'',
                vote_register:false,
                votes:{all:0},
                questionsOptions:this.options,
                form: {
                    gRecaptchaResponse: null,
                    option_id:'',
                    searchOption:'',
                },
                mySiteKeyVariable: '6LfmDqUZAAAAAJ93VW2055FacV4MVIdzdKyaE-ig',
            }
        },
        mounted() {

            console.log('Component mounted.')
            console.log(this.questionsOptions)
            this.all_vote()
        },
        methods:{
            sendVote(){
                this.preloader = true
                this.form.gRecaptchaResponse = event.target['g-recaptcha-response'].value
                axios.post('/results/survey/option',{
                   'gRecaptchaResponse': this.form.gRecaptchaResponse,
                   'option_id':this.form.option_id,
                   'searchOption':this.form.searchOption,
                },{
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then((response) => {
                    if(response.data.vote){
                        this.message = response.data.message_success
                        this.success = true;
                        this.vote_register = true;
                        this.$emit('voteregister',response.data.options)
                        this.$emit('showresult',this.vote_register)
                    }else{
                       window.location = '/login';
                    }
                })
                .catch(
                    error => {
                        console.log(error)
                })
                .finally(() => {
                    this.preloader = false
                });


            },
            time(){
                setTimeout(() =>
                    this.success = false
                , 4000);
            },
            all_vote: function() {
                this.questionsOptions.forEach(option => {
                    if(option.votes !== 0)
                        option.votes = 0;
                    this.votes.all = parseInt(this.votes.all) + parseInt(option.votes)
                });
            },
            part_votes(option){
                return ((option.votes * 100)/this.votes.all).toFixed(2);
            },
            searchOption(options){
                this.questionsOptions = options;
            },
            hasHistory () {
                 return window.history.back()
            },
            showResults(){
                axios.get('/api/resultsShow/'+this.questionsOptions[0].survey_id,{
                     headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then((response) => {
                    this.$emit('voteregister',response.data.options)
                    this.$emit('showresult',true)
                })
                .catch(
                    error => {
                        console.log(error)
                })
                .finally(() => {
                    this.preloader = false
                });
            }
        },
        components:{
           SearchOptionSiteComponent,
        }
    }
</script>
