<template>
	<div class="popular-search">
		<div class="container" v-if="hasproducts">
			<div class="row">
				<div class="col-lg-12">
					<h2><span>//</span>Popular Searches</h2>
				</div>
			</div>
			<div class="row" v-if="$mq === 'desktop'" v-for="item in items">
				<div class="col-lg-3 col-sm-6">
					<div class="popular-box">
						<h5>{{item.main_name}}</h5>
					</div>
				</div>
				<div class="col-lg-3" v-for="products in chunkedProducts(item.slug)">
					<div class="popular-box">
						<ul>
							<li v-for="product in products"><a href="#">{{product.type}} {{product.year}} {{product.make}} {{product.model}} </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" v-if="$mq === 'mobile'">
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<li class="nav-item" v-for="(item, index) in items">
						<a class="nav-link " :class="index == 0 ? 'active' : ''" data-toggle="tab" :href="'#ps' + index">{{item.sort_name}}</a>
					</li>
				</ul>
				<div class="tab-content">
					<div :id="'ps' + index" v-for="(item, index) in items" :class="index == 0 ? 'active' : ''" class="tab-pane fade show">
						<br>
						<div class="col-lg-3" v-for="products in chunkedProducts(item.slug)">
							<div class="popular-box">
								<ul>
									<li v-for="product in products"><a href="#">{{product.type}} {{product.year}} {{product.make}} {{product.model}} </a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.popular-box h5{font-family: 'Oswald', sans-serif; font-weight:800;}
.popular-search{
	margin-top:110px;
}
.popular-search h2 {
	font-size: 40px;
	color: #000;
	font-weight: 600;
	text-align: center;
	margin-bottom: 80px;
	text-transform: uppercase;
}
.popular-box {
	margin-bottom: 100px;
}
.popular-search h2 span{
	color:#41abed;
	padding-right: 10px;
}
.popular-box h5{
	font-size:20px;
}

.popular-box ul li a {
	text-decoration: none;
	color: #165a84;
	font-size: 14px;
}
.popular-box ul li {
	list-style: none;
	margin-bottom: 10px;
	border-bottom: 1px solid #e1e9ee;
	padding-bottom: 10px;
}
.popular-box ul {
	margin: 0;
	padding: 0;
}

@media (max-width:1350px){
	body a.nav-link{padding:9px 10px!important; }
	
}

@media (max-width: 768px) {
	.popular-search ul.nav.nav-tabs li a {
		font-size: 90%;
		text-transform: capitalize;
	}
}

@media (max-width:1280px){
	body a.nav-link {
		padding: 9px 6px !important;
	}
	ul.nav.nav-tabs li a{font-size:18px;}
}

@media (max-width:1199px){
	ul.nav.nav-tabs li a{padding:15px 10px !important;}
	.col-md-7.slide-content h2{ font-size:46px;}
	.styled-select{ padding:10px;}
	.col-md-7.slide-content::after {
		width: 35px;
		max-height: 110px;
		bottom: -51%;
		height: 100%;
	}
	.col-md-7.slide-content::before {
		max-height: 150px;
		left: 132px;
	}
	.slider-arrow-bottom {
		margin: 0;
		background: #000;
	}
	.slider-arrow-bottom {
		padding: 25px 0 9px 0;
	}
}
ul.navbar-nav li {
	position: relative;
}
@media (max-width:991px) {
	.popular-search h2{margin-bottom:20px;}
	header .col-md-6 {
		padding: 0;
	}
	.popular-search {
		margin-bottom: 60px;
	}
	.navbar-nav {
		padding: 0 10px 0 10px;
	}
	.popular-box {
		margin-bottom: 10px;
	}
	.col-md-7.slide-content {
		-ms-flex: 0 0 58.333333%;
		flex: 0 0 100%;
		max-width: 100%;
	}
	.popular-box h5 {
		margin: 50px 0 30px 0;
	}
	.col-md-7.slide-content h2 {
		font-size: 36px;
	}
	ul.navbar-nav {
		text-align: right;
	}
	
}


@media(max-width:576px){
	.col-sm-6.col-md-4.col-lg-3.product-mg {
		margin: 15px 0 0 0;
		padding-left: 15px;
		padding-right: 15px;
	}
	.col-xs-6.col-sm-6.col-md-4.col-lg-3.product-mg {
		margin: 0;
		padding-left: 0;
		padding-right: 0;
		width: 50%;
	}
	.all-products {
		border-radius: 0;
	}
	.suvs-section .owl-nav {
		position: relative;
		font-size: 50px;
		right: 0;
		top: 0;
		color: #090909;
	}
	.col-md-7.slide-content h2 {
		font-size: 25px;
	}
}

/* responsive */
.nav-justified {
	width: 100%;
	border-bottom: 0;
}

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
		width: 100%;
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
		font-size: 32px;
		margin-bottom: 50px;
		text-align: left;
	}

}
</style>

<script>
import chunk from 'chunk';
export default {
	mounted() {
		console.log('Component mounted.');
		this.getAllPopularProducts();
	},
	methods : {
		getAllPopularProducts() {
			this.axios.get('api/v2/get-all-popular-products').then(response => {
				this.products = response.data;
				this.hasproducts = true;
			});
		},
		chunkedProducts(search) {
			if (search == 'recentproduct') {
				return chunk(this.products.recentproduct, 5);
			}
			if (search == 'usedcar') {
				return chunk(this.products.usedcar, 5);
			}
			if (search == 'certified_greatcars') {
				return chunk(this.products.certified_greatcars, 5);
			}
		}
	},
	data() {
		return {
			products: [],
			hasproducts: false,
			items : [
			{
				main_name : 'POPULAR NEW CARS',
				sort_name : 'New Cars',
				slug : 'recentproduct'
			},
			{
				main_name : 'POPULAR USED CARS',
				sort_name : 'Used Cars',
				slug : 'usedcar'
			},
			{
				main_name : 'POPULAR GREAT CARS',
				sort_name : 'Great Cars',
				slug : 'certified_greatcars'
			}
			]
		}
	}
};
</script>