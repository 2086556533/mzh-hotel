<template>
    <div>
        <ve-line :data="lineData"></ve-line>
    </div>
</template>

<script>
    import VeLine from 'v-charts/lib/line.common';

    export default {
        name: "Echarts",
        components:{
            VeLine
        },
        data(){
            return{
                lineData:{
                    colums:['','','',''],
                    rows:[
                        {},
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>