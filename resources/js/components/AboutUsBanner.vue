<template>
	<!-- banner start -->
	<div class="site-banner mx-wid" style="background-image : url(/images/about.png)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 cl-whi">
					<h5>Home<span>/</span>Contact Us</h5>
					<h1>The Technology and Audience to Drive <br /> Dealership Growth</h1>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.cl-whi h5 {
    padding-top: 20px;
    color: white !important;
}
.mx-wid {
    max-height: 100% !important;
    padding: 120px 0 400px 0 !important;
}
.col-md-12.slide-content h2 {
    font-family: 'Oswald', sans-serif !important;
    font-size: 60px !important;
    text-transform: uppercase !important;
    margin: 0 00 20px 0 !important;
}
.carousel-inner img {
    width: 100%;
}
.slider-arrow-bottom {
    padding: 25px 0;
}
span.right-slider {
    font-size: 40px;
    font-weight: bold;
    font-family: 'Oswald', sans-serif;
    color:#fff;
}
span.right-slider span.slide-text {
    font-size: 14px;
    display: inline-block;
    font-family: 'Roboto', sans-serif;
    color:#fff;
    font-weight:500; text-transform:uppercase;
}
span.right-slider b {
    color: #41abed;
}
body .carousel-caption {
    position: absolute;
    right: 0;
    bottom: auto;
    left: 0;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #fff;
    text-align: center;
    max-width: 1270px;
    margin: auto;
    top:50%;transform: translateY(-50%);
}
span.s-circle {
    height: 26px;
    width: 26px;
    float: left;
    border: 2px solid #7e7d7e;
    border-radius: 25px;
    margin: 0 7px 0 0;
    text-align: center;
}
.slider-arrow-bottom h6 {
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 4px 0 0 0;
}
.slider-arrow-bottom a{text-decoration:none}
span.right-slider {
    float: right;
    margin:-21px 0 0 0;
}
.slider-arrow-bottom {
    margin: -110px 0 0 0;
}
span.dot-s {
    height: 10px;
    width: 10px;
    display: inline-block;
    background: #41abed;
    border-radius: 10px;
    position: relative;
    top: -1px;
}
a.carousel-control-next {
    right: auto;
    font-size:28px;
    opacity: 1;
}
.arrow-slide {
    display: inline-block;
    width: 48px;
    margin: 0 auto auto auto;
    position: absolute;
    float: none;
    left: 0;
    right: 0;
    bottom: 60px;
}
body .carousel-caption{padding:0 15px;}
a.carousel-control-prev {
    left: auto;
    opacity: 1;
    font-size:28px;
}
.carousel-control-next, .carousel-control-prev {
    bottom: 0;
    top: auto!important;
    width: auto;
    left: 0;
    right: 0;
}
.col-md-7.slide-content {
    text-align: left;
}
.col-md-7.slide-content h2 {
    font-family: 'Oswald', sans-serif;
    font-size: 60px;
    text-transform: uppercase;
    margin: 0 00 20px 0;
}
.carousel-caption p {
    font-size: 16px;
}
.col-md-7.slide-content:before {
    content: '';
    background: url('/images/slide-before.png');
    width: 25px;
    max-height: 200px;
    display: inline-block;
    position: absolute;
    top: -80%;
    left: 150px;
    height:100%;
}

.col-md-7.slide-content:after {
    content: '';
    background: url('/images/slide-after.png');
    width: 65px;
    max-height: 210px;
    display: inline-block;
    position: absolute;
    bottom: -81%;
    left: 126px;
    background-size: contain;
    height: 100%;
}
@media (max-width: 768px) {
    .desktop-title {
        padding-top: 100px;
    }
    .desktop-title h2 {
        color: #fff;
    }
}
</style>

<script>
import SliderForm from './SliderForm.vue';
export default {
    components: {
        SliderForm,
    },
    data() {
        return {
            slide: 0,
            sliding: null
        }
    },
    methods: {
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = true
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
};
</script>
