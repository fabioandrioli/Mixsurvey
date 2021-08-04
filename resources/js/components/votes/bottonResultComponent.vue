<template>
    <div class="row">
        <div class="col-12">
           <button  class="btn btn-info">Ver resultados</button>
        </div>
    </div>
</template>

<script>
    export default {


        mounted() {

            console.log('Component mounted.')
            console.log(this.questionsOptions)
            this.all_vote()
        },
        methods:{
            sendVote(){
                this.preloader = true
                this.form.gRecaptchaResponse = event.target['g-recaptcha-response'].value
                axios.post('/resultsVote/',this.form,{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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
            all_vote(){
                this.options.forEach(option => {
                    this.votes.all = this.votes.all + option.votes
                });
            },
            part_votes(option){
                return ((option.votes * 100)/this.votes.all).toFixed(2);
            },
            searchOption(options){
                this.questionsOptions = options;
            }
        },
        components:{
           SearchOptionSiteComponent,
        }
    }
</script>
