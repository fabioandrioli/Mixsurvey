<template>
    <div class="content">
        <show-options-component :hasSession="session" @showresult="voteChecked"  @voteregister="voteRegister" v-if="!vote_register" :surveyId="id_survey" :options="questions"></show-options-component>
        <show-results-component  v-if="show_result" :options="questions" :surveyid="id_survey"></show-results-component>
    </div>
</template>

<script>
    import ShowOptionsComponent from './showOptionsComponent'
    import ShowResultsComponent from './showResultsComponent'
    export default {
         props:{
             options:{
                required:true,
            },
            survey_id:{
                required:true,
            },
            session:{
                required:true,
                default:false,
                type:Boolean,
            }
         },
        data() {
            return {
                vote_register:false,
                show_result:false,
                id_option:0,
                questions:this.options,
                id_survey:this.survey_id,
            }
        },
        methods:{
            voteRegister(options){
                this.vote_register = true
                this.questions = options
                this.voteChecked()
            },
            voteChecked(checked){
                this.show_result = checked
            },

        },
        components:{
            ShowOptionsComponent,
            ShowResultsComponent,
        }
    }
</script>
