<template>
    <div>
        <about-us-banner></about-us-banner>
        <about-us-form :buttonText="'Get Started'"></about-us-form>
        <get-your-cars></get-your-cars>
        <about-video></about-video>
        <about-cargurus></about-cargurus>
        <about-us-form :buttonText="'Submit'"></about-us-form>
        <about-end-text></about-end-text>
    </div>
</template>

<style>
h2{
    font-family: 'Oswald', sans-serif !important;
}
/* responsive */


@media(max-width:767px){
    .popular-search{margin-bottom:60px;}
    .slider-arrow-bottom a {
        text-decoration: none;
        margin: auto;
        width: 150px;
        display: inherit;
    }
    .shop-by {
        margin-top: 70px;
    }
    .slider-arrow-bottom .col-md-6 {
        text-align: center;
    }
    span.right-slider {
        float: none;
        margin: auto;
        max-width: 265px;
        margin: auto;
    }
    .slider-arrow-bottom h6 {
        margin: 4px 0 0 0;
        display: inline-block;
    }
    .navbar-toggler {
        position: absolute;
        right: 15px;
        top: -42px;
    }
    .navbar-toggler {
        padding: 0 0;
        font-size: 29px;
        color: #fff;
    }
    .contact-no {
        display: none;
    }
    .navbar-nav {
        background: #000;
    }
    .navbar-nav li{
        width:100%;
    }
    ul.navbar-nav {
        text-align: left;
        padding: 10px 10px;
        margin: 0;
        width: 100%;
        max-width: 100%;
    }
    .carousel-inner img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        object-position: top;
    }
    .col-md-7.slide-content::before{display:none; }
    .col-md-7.slide-content::after{display:none;}
    .shop-by {
        padding:70px 0;
    }
    .popular-box {
        margin-bottom: 0px;
    }
    .footer-box {
        margin-bottom: 30px;
    }
    .list-one {
        margin: 40px 0 0 0;
        padding: 0;
    }
    body .carousel-caption { 
        top: 58%;
    }
    .all-products img {
        width: 100%;
    }
}


@media(max-width:480px){
    ul.nav.nav-tabs li a {
        font-size: 16px;
    }
    .popular-search {
        margin-top: 60px;
    }
    body .popular-search h2 {
        margin-bottom: 0;
    }
    .shop-by-body h2 {
        font-size: 30px;
    }
    .suvs-section h2 {
        font-size: 30px;
    }

    ul.nav.nav-tabs li {
        width: 50%;
    }
    .styled-select{width:100%; border-right:none;}
    .styled-select.border-none {
        border-bottom: 1px solid #d7d7d7 !important;
    }
    .styled-select:last-child{
        border-bottom: none !important;
    }
    .shop-by h2{
        font-size:32px;
        margin-bottom: 50px;
        text-align: left;
    }
    .popular-search h2 {
        font-size: 31px;
        margin-bottom: 50px;
        text-align: left;
    }

}
</style>

<script>
import AboutUsBanner from './AboutUsBanner.vue';
import AboutUsForm from './AboutUsForm.vue';
import GetYourCars from './GetYourCars.vue';
import AboutVideo from './AboutVideo.vue';
import AboutCargurus from './AboutCargurus.vue';
import AboutEndText from './AboutEndText.vue';
export default {
    mounted() {
        console.log('Component mounted.');
    },
    components: {
        AboutUsBanner,
        AboutUsForm,
        GetYourCars,
        AboutVideo,
        AboutCargurus,
        AboutEndText,
    }
};
</script>
