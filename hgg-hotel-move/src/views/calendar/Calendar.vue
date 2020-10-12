<template>
    <div>
        <van-calendar v-model="show" type="range" @confirm="onConfirm"></van-calendar>
    </div>
</template>

<script>
    import {Calendar} from 'vant'
    import 'vant/lib/calendar/style'

    export default {
        name: "Calendar",
        data() {
            return {
                show: true
            }
        },
        methods: {
            onConfirm(date) {
                let [startTime, endTime] = date;
                let start = startTime.getMonth() + 1 + '.' + startTime.getDate(),
                 end = endTime.getMonth() + 1 + '.' + endTime.getDate(),
                 startDay = startTime.getDay(),
                 endDay = endTime.getDay();
                this.$store.commit('setTime', {start, end,startDay,endDay});
                this.$router.back();
            }
        },
        components: {
            'van-calendar': Calendar
        },
    }
</script>

<style scoped>

</style>