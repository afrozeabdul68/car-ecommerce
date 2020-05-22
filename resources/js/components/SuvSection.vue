<template>
	<div class="suvs-section" id="section1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><span>//</span> SUVS</h2>
					<Carousel v-if="products" :items="$mq === 'mobile' ? 1 : 4" :nav="$mq === 'mobile' ? false : true" :dots="$mq === 'mobile' ? true : false" :margin="15" :navElement="'button'" :navText="navtext" >
						<div class="item" v-for="product in suvproducts">
							<a href="#">
								<img :src="featuredImage(product)" alt="suv-product-img" />
								<h3>{{product.type}} {{product.year}} {{product.make}} {{product.model}}</h3>
								<p>${{product.sellingprice.toLocaleString()}} <span>-{{product.miles.toLocaleString()}} mi</span></p>
							</a>
						</div>
					</Carousel>
					<div class="suv-btn">
						<a href="#">All SUVs</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.suvs-section {
	margin-top: 100px;
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
