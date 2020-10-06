<template>
    <div>
        <!--        这是首页-->
        <!--        轮播-->
        <mu-carousel hide-controls hide-indicators class="banner">
            <mu-carousel-item>
                <img :src="carouselImg1" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg2" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg3" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg4" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg5" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg6" style="width: 10%;">
            </mu-carousel-item>
            <mu-carousel-item>
                <img :src="carouselImg7" style="width: 10%;">
            </mu-carousel-item>
            <a href="#">
                <img src="../../assets/imgs/search.png" alt="" class="index-search">
            </a>
        </mu-carousel>
        <!--        选择框-->
        <div class="index-select">
            <div class="position">
                北京市
                <img src="../../assets/imgs/arrow.png" alt="" style="width: 0.78125rem">
            </div>
            <mu-container class="input">
                <mu-text-field placeholder="景点 地址 关键词" style="line-height: 0.75rem;width: 8rem"></mu-text-field>
            </mu-container>
            <div class="index-position">定位
                <div class="position-img">
                    <img style="height:0.78rem" src="../../assets/imgs/position-img.png" alt="">
                </div>
            </div>
            <div class="date">
                日期选择
            </div>
            <div class="search-now">
                立即查找
            </div>
            <div class="desc">
                <div class="money">
                    <img style="width: 0.75rem;" src="../../assets/imgs/moneybag.jpg" alt="">
                    信用免押金
                </div>
                <div class="serve">
                    <img style="width: 0.75rem;" src="../../assets/imgs/music.jpg" alt="">
                    24小时客服
                </div>
                <div class="safe">
                    <img style="width: 0.75rem;" src="../../assets/imgs/protect.jpg" alt="">
                    房源房东真实认证
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    import carouselImg1 from '../../assets/imgs/banner7.png';
    import carouselImg2 from '../../assets/imgs/banner2.jpg';
    import carouselImg3 from '../../assets/imgs/banner3.jpg';
    import carouselImg4 from '../../assets/imgs/banner4.jpg';
    import carouselImg5 from '../../assets/imgs/banner5.jpg';
    import carouselImg6 from '../../assets/imgs/banner6.jpg';
    import carouselImg7 from '../../assets/imgs/banner1.jpg';

    export default {
        name: "Index",
        data() {
            return {
                carouselImg1,
                carouselImg2,
                carouselImg3,
                carouselImg4,
                carouselImg5,
                carouselImg6,
                carouselImg7,
                value1: '景点 地址 关键词'
            }
        }
    }
</script>

<style scoped>

    /* 轮播样式 */
    .banner {
        position: absolute;
        top: 0;
        z-index: -1;
    }

    .mu-carousel {
        height: 280px;
    }

    .mu-carousel-indicators {
        position: relative;
        top: 140px;
    }

    .index-search {
        opacity: 0.7;
        width: 1.5rem;
        position: absolute;
        right: 1rem;
        top: 1rem;
    }

    /* 选择框样式 */
    .index-select {
        width: 19.9375rem;
        height: 12.5rem;
        z-index: 9;
        background: white;
        border-radius: 7px;
        position: absolute;
        top: 200px;
        left: 1.75rem;
        padding: 0.5rem;
        border-bottom: 1px solid #f7f7f7;
    }

    /*    定位*/
    .position {
        width: 4.1rem;
        height: 1.75rem;
        z-index: 999;
        border-bottom: 1px solid black;
        float: left;
        position: relative;
        top: 0.5315rem;
    }

    .index-position {
        float: left;
        position: absolute;
        top: 1.2rem;
        right: 0.8rem;
        color: #8d8d8d;
    }

    .position-img {
        float: left;

    }

    .date {
        width: 16rem;
        height: 2rem;
        border: 1px solid red;
        margin:0 auto;

    }

    .search-now {
        width: 16.9375rem;
        height: 2.1875rem;
        background: #eb666b;
        border-radius: 7px;
        color: #fff;
        font-size: 15px;
        text-align: center;
        line-height: 2.1875rem;
        margin:0 auto;
    }

    .desc {
        width: 17rem;
        height: 2rem;
        font-size: 0.59375rem;
        color: #7f7f7f;
        margin:0 auto;

    }

    .money {
        margin-left: 0.05rem;

        float: left;
    }

    .serve {
        margin-left: 0.05rem;
        float: left;
    }

    .safe {
        margin-left: 0.05rem;
        float: left;
    }
</style>