<script>
import { Line } from 'vue-chartjs'
export default {
    props:{
        options:{
            required:true
        }
    },
    extends: Line,
    mounted() {
        console.log(this.options),
        this.renderChart({
            labels:["Janeiro","Fevereiro"],
            datasets:[
                {
                    label: "Relatório das enquetes",
                    data:['10','15'],
                    backgroundColor: "transparent",
                    borderColor: "red"
                }
            ]
        },{response:true, maintainAspectRatio: false})
    },
}
</script>
