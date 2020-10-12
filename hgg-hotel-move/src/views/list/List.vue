<template>
    <div>
        <ul class="nav">
            <li class="active">综合<i class="iconfont icon-xiajiantou"></i></li>
            <li>位置<i class="iconfont icon-xiajiantou"></i></li>
            <li>时间<i class="iconfont icon-xiajiantou"></i></li>
            <li>价格<i class="iconfont icon-xiajiantou"></i></li>

        </ul>
        <div class="stayhome">

        </div>
    </div>
</template>

<script>
    export default {
        name: "List"
    }
</script>

<style scoped>
.nav{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    width: 100%;
    margin-top: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-sizing: border-box;
    padding: 0 1.5rem;
    height: 2rem;

    text-align: center;
    line-height: 1.8rem;
}
    .nav>li{
        width: 4.1875rem;
        height:2rem;
        border-radius: 1rem ;
        font-size: 0.75rem;
        color: #000000;

    }
    .nav>li.active{
        background: #eb666b;
        color: #fff;
        box-shadow: 0 0.12rem 0.3rem 0 rgba(235,102,107,.5);
    }
    .stayhome{
        margin-top: 5rem;
        padding: 0 1.5rem;

        height: 5rem;
    }
</style>