<template>
	<div class="suvs-section get-cars-section" id="section1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2><span>//</span>Get Your Cars in Front of the Most <br />Ready-to-Buy Shoppers</h2>
				</div>
				<div class="col-md-4 text-center about-m">
					<img src="/images/aboutm1.png">
					<h5>Vehicle Pricing Validation</h5>
					<h6>CarDesta analyzes millions of vehicle prices daily to produce a proprietary vehicle deal rating for every listing.</h6>
				</div>
				<div class="col-md-4 text-center about-m">
					<img src="/images/aboutm2.png">
					<h5>More Qualified Connections</h5>
					<h6>CarDesta engages and informs low-funnel auto shoppers with car and dealership reviews.</h6>
				</div>
				<div class="col-md-4 text-center about-m">
					<img src="/images/aboutm3.png">
					<h5>Boost Your Close Rates</h5>
					<h6>CarDesta advanced price analysis increases shopper confidence, making our users less likely to haggle and more ready-to-buy.</h6>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.about-m {
	padding-top: 50px;
}

.about-m h5 {
	text-transform: uppercase;
	margin-top: 30px;
	color: black;
}
.about-m h6 {
	font-size: 12px;
	margin-top: 20px;
	color: #999;
}

.suvs-section {
	margin-top: 100px;
}
.get-cars-section {
	margin-top: -100px !important;
}
.get-cars-section h2 {
	text-transform: uppercase;
}
.suvs-section a {
	text-decoration: none;
}
.suvs-section h2 {
	font-size: 40px;
	color: #000000;
	font-weight: 500;
	margin: 0px 0 35px 0;
	padding: 0 0 0 0;
}
.suvs-section h2 span {
	color: #5cb7f0;
	margin-right: 10px;
}
.suvs-section h3 {
	font-size: 14px;
	color: #165a84;
	font-weight: 400;
	margin: 20px 0 0 0;
	padding: 0 0 0 0;
}
.suvs-section p {
	font-size: 14px;
	color: #000;
	font-weight: 700;
	margin: 10px 0 0 0;
	padding: 0 0 0 0;
}
.suvs-section p span{
	color:#999999;
	font-weight:400;
}
.suvs-section .owl-nav {
	position: absolute;
	font-size: 40px;
	right: -5px;
	top: -95px;
	direction: rtl;
	color: #090909;
}
.suvs-section .owl-theme .owl-nav [class*=owl-]:hover {
	background: none !important;
	color: #000 !important;
	text-decoration: none;
}
.suvs-section .owl-theme .owl-nav [class*=owl-]:focus {
	outline:none !important;
}
.suvs-section .owl-theme .owl-nav {
	margin-top: 0 !important;
}
.suv-btn{
	margin:30px 0 0 0;
}
.suv-btn a:hover{background:#165a84; color:#fff;}
.sedans .suv-btn a:hover{background:#165a84; color:#fff;}
.suv-btn a {
	background: #e0ebf6;
	width: 100%;
	display: inline-block;
	text-align: center;
	padding: 15px;
	color: #000;
	font-size: 14px;
	margin: 0;
	font-weight:700;
	text-decoration: none;
}
</style>

<script>
import Carousel from 'vue-owl-carousel';
export default {
	mounted() {
		console.log('Component mounted.');
		this.getAllSuvProducts();
	},
	components: {
		Carousel,
	},
	methods : {
		getAllSuvProducts() {
			this.axios.get('api/v2/get-all-suvproducts').then(response => {
				this.suvproducts = response.data;
				this.products = true;
			});
        },

        featuredImage(product) {
            return product.images.length ? product.images[0].image : '/images/no-car.png';
        }
	},
	data() {
		return {
			suvproducts: [],
			products: false,
			navtext: ["<span aria-label='Previous'>‹</span>","<span aria-label='Next'>›</span>"],
		}
	}
};
</script>
