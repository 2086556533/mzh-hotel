<template>
    <div class="lodaing" v-show="isshow">
        <div class="lodaing-content">
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>
            <div class="loading-item">
                <div class="line"></div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "loading",
        props:{
            isshow:{
                type:Boolean,
                default:true,
            }
        }
    }
</script>

<style scoped>
    .lodaing{
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        display: flex;
        justify-content: center;
        align-content: center;
        background: rgba(0,0,0,0.8);
    }

    .lodaing > .lodaing-content{
        width: 200px;
        height: 200px;
        position: relative;
    }

    .lodaing-content > .loading-item {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
    }

    .loading-item > .line{
        position: absolute;
        top: 0;
        left: 60px;
        width: 2px;
        height: 80px;
        background-color: lightcoral;
        animation: loading 1.2s infinite linear;
    }

    .lodaing-content > .loading-item:nth-child(1){
        transform: rotateZ(0);
    }
    .lodaing-content > .loading-item:nth-child(2){
        transform: rotateZ(30deg);
    }
    .lodaing-content > .loading-item:nth-child(3){
        transform: rotateZ(60deg);
    }
    .lodaing-content > .loading-item:nth-child(4){
        transform: rotateZ(90deg);
    }
    .lodaing-content > .loading-item:nth-child(5){
        transform: rotateZ(120deg);
    }
    .lodaing-content > .loading-item:nth-child(6){
        transform: rotateZ(150deg);
    }
    .lodaing-content > .loading-item:nth-child(7){
        transform: rotateZ(180deg);
    }
    .lodaing-content > .loading-item:nth-child(8){
        transform: rotateZ(210deg);
    }
    .lodaing-content > .loading-item:nth-child(9){
        transform: rotateZ(240deg);
    }
    .lodaing-content > .loading-item:nth-child(10){
        transform: rotateZ(270deg);
    }
    .lodaing-content > .loading-item:nth-child(11){
        transform: rotateZ(300deg);
    }
    .lodaing-content > .loading-item:nth-child(12){
        transform: rotateZ(330deg);
    }

    .lodaing-content > .loading-item:nth-child(1) > .line{
        animation-delay: 0ms;
    }
    .lodaing-content > .loading-item:nth-child(2) > .line{
        animation-delay: 100ms;
    }
    .lodaing-content > .loading-item:nth-child(3) > .line{
        animation-delay: 200ms;
    }
    .lodaing-content > .loading-item:nth-child(4) > .line{
        animation-delay: 300ms;
    }
    .lodaing-content > .loading-item:nth-child(5) > .line{
        animation-delay: 400ms;
    }
    .lodaing-content > .loading-item:nth-child(6) > .line{
        animation-delay: 500ms;
    }
    .lodaing-content > .loading-item:nth-child(7) > .line{
        animation-delay: 600ms;
    }
    .lodaing-content > .loading-item:nth-child(8) > .line{
        animation-delay: 700ms;
    }
    .lodaing-content > .loading-item:nth-child(9) > .line{
        animation-delay: 800ms;
    }
    .lodaing-content > .loading-item:nth-child(10) > .line{
        animation-delay: 900ms;
    }
    .lodaing-content > .loading-item:nth-child(11) > .line{
        animation-delay: 1000ms;
    }
    .lodaing-content > .loading-item:nth-child(12) > .line{
        animation-delay: 1100ms;
    }

    @keyframes loading {
        from{
            opacity: 0;
        }
        to{
            opacity: 1;
        }
    }
</style>