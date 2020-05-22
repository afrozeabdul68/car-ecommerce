<template>
	<div class="col-lg-8 pl-4" id="filterProduct">
		<div class="row mt-3 heading-sec">
			<div class="col-md-6 match-left">
				<h5><span>//</span> {{productsList.total}} Matches near for you</h5>
			</div>
			<div class="col-md-6 match-right">
				<label>Sort by:</label>
				<select>
					<option>Best deals first</option>
					<option>Worst deals first</option>
					<option>Lowest price first</option>
					<option>Highest price first</option>
					<option>Lowest mileage first</option>
					<option>Highest mileage first</option>
					<option>Closest first</option>
					<option>Oldest first(by car year)</option>
					<option>Newest first(by car year)</option>
					<option>Newest listings first</option>
					<option>Oldest listings first</option>
				</select>
				<i class="fas fa-chevron-down s-down"></i>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 product-btn">
				<ul>
					<li v-if="product_searches.length > 0"  @click.prevent="clearAllValue()"><a href="#"><span><i class="fas fa-times"></i></span>Clear All</a></li>
					<li v-for="searches in product_searches" :data-type="searches.type" @click.prevent="clearValue(searches.type, searches.value)"><a href="#"><span><i class="fas fa-times"></i></span>{{getValue(searches.value, searches.type)}}</a></li>
				</ul>
			</div>
		</div>

		<div v-if="productsList.total > 0" class="row detail-box2" v-for="(product, $index) in productsList.data" :key="$index">
			<div class="col-lg-6 titu d-flex align-items-center">
				<div class="product-slider w-100 position-relative">
					<Carousel v-if="product.images.length > 0 && product.images[0].image !== ''" :items="1" :nav="$mq === 'mobile' ? false : true" :dots="$mq === 'mobile' ? true : false" :margin="15" :navElement="'button'" :navText="navtext" :lazyLoad="true">
						<div class="item" v-for="(p_image, index) in product.images" v-if="index <= 1" :key="index">
							<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" >
								<img v-if="!p_image.original_url && p_image.image" :src="p_image.image" alt="suv-product-img" />
								<img v-else-if="p_image.original_url && p_image.image" :src="p_image.original_url" alt="suv-product-img" />
							</router-link>
						</div>
					</Carousel>
					<div v-else class="item">
						<router-link :to="{name: 'cardetail', params: { vin: product.vin }}" >
							<img src="images/no-car.png" class="img-respomsive" />
						</router-link>
					</div>
				</div>
			</div>
			<div class="col-lg-6 detail-box">
				<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="div" class="premium">
					<h5>{{product.year}} {{product.make}} {{product.model}}</h5>
					<span v-if="product.type === 'New'" class="w3-badge green">{{product.type == "Used" ? "HIT" : "NEW"}}</span>
					<span v-if="product.type === 'Used'" class="w3-badge orange">{{product.type == "Used" ? "HIT" : "NEW"}}</span>
				</router-link>
				<div class="row">
					<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="div" class="col-lg-5 col-sm-5 great-deal">
						<a href="#" class="great_price" v-if="product.sellingprice && product.sellingprice <= product.below_price"><span><i class="fas fa-arrow-up"></i></span>Great Deal</a>
						<a href="#" class="good_price" v-else-if="product.sellingprice && product.sellingprice <= product.average_price && product.sellingprice > product.below_price"><span><i class="fas fa-arrow-up"></i></span>Good Deal</a>
						<a href="#" class="fair_price" v-else-if="product.sellingprice && product.sellingprice > product.above_price"><span><i class="fas fa-arrow-right"></i></span>Fair Price</a>
						<span class="below-c">
							<p>${{belowPrice(product.msrp,product.sellingprice)}} Below</p>
							<p>CarDesta Market Value</p>
						</span>

					</router-link>
					<div class="col-lg-7 col-sm-7 dooler">
						<p>price: <router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="b"> ${{product.sellingprice.toLocaleString()}}</router-link><span>${{calculatePrice(product.sellingprice)}}/mo est</span></p>
						<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="p" >Mileage:<strong v-if="product.miles">{{product.miles.toLocaleString()}} mi</strong><br></router-link>
					</div>
					<div class="col-lg-12 var-list">
						<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="div" class="row">
							<div class="col-lg-5 var-1">
								<p>Ext. Color:<strong>{{product.exteriorcolor}}</strong></p>
								<p>Int. Color:<strong>{{product.interiorcolor}}</strong></p>
							</div>
							<div class="col-lg-7 var-2">
								<p>Transmission: <strong>{{product.transmission}}</strong></p>
								<p>Drivetrain: <strong>{{product.drivetrain}}</strong></p>
							</div>
						</router-link>
					</div>
					<div class="col-lg-12">
						<div class="reviws">
							<!-- <ul>
								<li style="color:#f57325">4.9</li>
								<li><i class="fas fa-star"></i></li>
								<li><i class="fas fa-star"></i></li>
								<li><i class="fas fa-star"></i></li>
								<li><i class="fas fa-star"></i></li>
								<li class="opacity-30 mr-1" ><i class="fas fa-star"></i></li>
								<li><span>593 Google Reviews</span></li>
							</ul> -->
							<router-link :to="{name: 'cardetail', params: { vin: product.vin, products : getProductsData(productsList, $index) }}" tag="p"  class="dec" style="color:#000;">{{product.dealer.name}}, {{product.miles}} miles from {{product.zip}} <!-- <span class="hifun"> - </span> <strong class="desktop-nb" v-if="product.dealer">{{product.dealer.call_tracking_no}}</strong> -->	</router-link>
							<!-- <a class="mob-btn" v-if="product.dealer" href="#">{{product.dealer.call_tracking_no}}</a> -->
							<a class="chk-btn" href="#" @click="openModal(product)">Check Availability</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pagination -->

		<div v-if="productsList.total > productsList.per_page" class="row site-pagination">
			<div class="col-lg-12">
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item prev"><a class="page-link" @click.prevent="changePage((products.current_page - 1))" :class="products.current_page == 1 ? 'disabled' : ''" href="#"><i class="fas fa-chevron-left left"></i>Prev</a></li>
						<li class="page-item first" v-for="page in pagesNumber" :class="products.current_page == page ? 'active' : ''" ><a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a></li>
						<li class="page-item next"><a class="page-link" href="#" @click.prevent="changePage((products.current_page + 1))" :class="products.current_page == products.last_page ? 'disabled' : ''">Next<i class="fas fa-chevron-right right-pagi"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div v-if="productsList.total == 0" class="row detail-box2">
			<div class="col-lg-6 titu">
				<h5>Sorry No products found</h5>
			</div>
		</div>
		<div class="search-footer font-strong">

			<p>
				Title, other fees, and incentives are not included in this calculation, which is an estimate only. Monthly payment estimates are for illustrative purposes only and do not represent a financing offer from the seller. Other taxes may apply.
			</p>
			<p class="show-more" :class="{show: footerExpanded}">
				The information on vehicles provided in this service is supplied by the seller or other third parties; Cars.com is not responsible for the accuracy of such information. Cars.com provides this service and materials without representations or warraties of any kind, either
			</p>
			<!-- <a @click="showMoreFooter">Show More</a> -->
		</div>

		<!-- Modals -->
		<div id="contact-modal" ref="contactModal" :class="$mq !== 'mobile' ? 'modal' : 'mobile-modal'">
			<div class="modal-content">
				<span class="close cursor" @click="closeModal()">&times;</span>
				<contact-form :product="selectedProduct"></contact-form>
			</div>
		</div>
	</div>
</template>

<style>
/* modal style start*/
.mobile-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #f8f9fa;
}
.close {
	color: white !important;
	font-size: 41px !important;
	opacity: 1 !important;
}
/* modal style end*/
.search-footer p{
	font-weight: 400;
}

.search-footer p.show-more{
	display: none;
}

.search-footer p.show-more.show{
	display: block;
}

.search-footer a{
	border-bottom: 1px dashed;
	padding-bottom: 4px !important;
	font-weight: 500;
	text-decoration: none;
	cursor: pointer;
}

.match-left {
	float: left;
}
.pagination .page-item .page-link.disabled {
	pointer-events: none;
	cursor: default;
	color: #e1e1e1;
}
.pagination .page-item.active .page-link {
	border-bottom: 1px solid #4185cc;
	color: #4185cc;
}
.match-left h5 span{
	letter-spacing: -7px;
	font-size: 30px;
	position: absolute;
	top: -6px;
	left: 2px;
}
.match-left h5 {
	padding-left: 15px;
	text-transform: uppercase;
	color: #000;
	font-size: 20px;
	font-weight: 700;
	font-family: 'Oswald', sans-serif;
}
.seo-txt h4{font-family: 'Oswald', sans-serif;}
.match-left span {
	color: #41abed;
	margin-right: 10px;
	font-weight: 600;
}
.match-right {
	float: left;
	text-align: right;
}
.match-right label {
	color: #333;
	font-size: 14px;
	margin-right: 10px;
	font-weight: 600;
}
i.fas.fa-chevron-down.s-down {
	position: initial;
	margin-left: 3px;
}
.match-right select {
	border: none;
	color: #165a84;
	font-weight: 600;
	-webkit-appearance: none;
	background-image: linear-gradient(to right, #165a84 10%, rgba(255, 255, 255, 0) 0%);
	background-position: bottom;
	background-size: 10px 1px;
	background-repeat: repeat-x;
	font-size: 16px;
}
.match-right .s-down {
	position: unset;
}
.product-btn {
	margin: 20px 0;
	border-top: 1px solid #f0f0f0;
	border-bottom: 1px solid #f0f0f0;
	padding: 20px 0;
}
.product-btn span {
	color: #41abed;
	padding-right: 10px;
	font-weight: 300 !important;
}
.product-btn ul li a {
	text-decoration: none !important;
	color: #000;
	padding: 12px 20px;
	border: 2px solid #e0ebf6;
	border-radius: 20px;
	font-size: 14px;
	font-weight: 600;
}
.col-lg-12.product-btn ul li {
	display: inline-block;
	margin-left: 10px;
	margin-top: 10px;
	margin-bottom: 10px;
}
.product-btn ul {
	margin: 0;
	padding: 0;
}
.product-btn ul li a {
	text-decoration: none !important;
	color:#000;
}
.product-btn ul li a:hover {
	background: #e0ebf6;
}
.premium, .great-deal, .dooler, .var-list, .reviws .dec {
	cursor: pointer;
}
.premium h5{
	color: #165a84;
}
.premium h5 {
	color: #165a84;
	font-size: 16px;
	margin-bottom: 10px;
	font-weight: 600;
}
.col-lg-6.detail-box b {
	color: #000;
	font-size: 20px;
	padding-right: 7px;
}
.col-lg-6.detail-box a {
	color: #fff;
	background: #a9d600;
	padding: 3px 10px;
	display: inline-block;
	border-radius: 4px;
	font-size: 14px;
	margin-bottom: 10px;
	text-decoration: none;
}
.col-lg-6.detail-box a.good_price {
	background: #e7c127;
}
.col-lg-6.detail-box a.fair_price {
	background: #bfbfbf;
}
.col-lg-6.detail-box span {
	color: #2374e2;
	font-size: 14px;
	font-weight: 500;
}
a.chk-btn {
	width: 100%;
	text-align: center;
	padding: 7px 0 !important;
	background: #e0ebf6 !important;
	color: #000 !important;
	font-weight: 500;
	margin-top: 10px;
}

.reviws ul li i {
	color: #f57325;
}
.reviws ul li {
	list-style: none;
	display: inline-block;
	color: #ccc;
}
.reviws ul {
	margin: 0;
	padding: 10px 0 0 0;
	border-top: 1px solid #f0f0f0;
}
a.chk-btn:hover {
	background: #165a84 !important;
	color: #fff !important;
}
.below-c{
	color:#9999 !important;
}
span.below-c p {
	color: #545454 !important;
	line-height: 14px;
}
i.fas.fa-arrow-up, i.fas.fa-arrow-right {
	color: #fff;
	padding-right: 10px;
	font-weight: 900;
}
.col-lg-6.detail-box p {
	color: #000;
	font-size: 14px;
	margin-bottom: 2px;
	font-weight: 500;
}
.col-lg-6.detail-box .below-c p{font-size:12px;}

.col-lg-6.detail-box strong {
	color: #000;
	padding-left: 2px;
	font-weight: 600;
}
.col-lg-6.detail-box {
	/* margin-top: 18px; */
}
.detail-box2 {
	box-shadow: 0 0px 15px 0 #0000001a;
	margin-bottom: 30px;
}
.product-btn ul li a:focus {
	background: #e0ebf6;
	border-color: #e0ebf6;
}
.titu{
	padding-left:0px;
}
.fade i{
	color:#fde3d3 !important;
}
.col-lg-12.var-list {
	padding-top: 6px;
	padding-bottom: 5px;
}
.owl-nav button.owl-prev {
	position: absolute;
	left: 0;
	top: 50%;
	transform: translateY(-50%);
}
.owl-nav button.owl-next {
	position: absolute;
	right: 0;
	top: 50%;
	transform: translateY(-50%);
}
.owl-theme .owl-nav [class*=owl-]:hover {
	background: none!important;
}
.owl-nav button {
	outline: 0;
}
span.w3-badge.green {
	right: 20px;
	background: #009a00;
	padding: 3px 10px;
	display: inline-block;
	color: #fff;
	border-radius: 6px;
	position: absolute;
	top: 15px;
	font-size: 14px;
	z-index: 99;
	text-transform: uppercase;
}
span.w3-badge.orange {
	right: 20px;
	background: orange;
	padding: 3px 10px;
	display: inline-block;
	color: #fff;
	border-radius: 6px;
	position: absolute;
	top: 15px;
	font-size: 14px;
	z-index: 99;
	text-transform: uppercase;
}
span.w3-badge.green.orange {
	background: #f57325 !important;
}
.product-slider img.img-respomsive {
	width: 100%;
}
.page-item.first .page-link {
	border-left: 1px solid #e2e2e2;
}
.page-item.next .page-link {
	border-right: none;
	border-left: 1px solid #e2e2e2;
}
ul.pagination li a {
	background: #f0f0f0;
	border-top-color: #f0f0f0;
	border-bottom-color: #f0f0f0;
}
.page-link {
	color: #000;
	font-weight: 500;
	font-size: 14px;
	padding: 15px 25px
}
.page-link:hover {
	z-index: 2;
	color: #4185cc;
	text-decoration: none;
	border-bottom-color: #4185cc;
}
.page-link .left {
	padding-right: 10px;
	color:#a6a6a6;
}
.page-link .right {
	padding-left: 10px;
	color:#a6a6a6;
}
li.page-item:first-child {
	float: left;
}
li.page-item:last-child {
	float: right;
}
ul.pagination {
	background: #f0f0f0;
}

.site-pagination .col-lg-12 {
	padding: 0;
}
.page-item:first-child .page-link {
	border-left-color: #f0f0f0;
	border-radius: 10px;
}

ul.pagination .page-link {
	color: #000;
	font-weight: 500;
	font-size: 14px;
	padding: 15px 17px;
	border: none;
	border-top-color: currentcolor;
	border-right-color: currentcolor;
	border-right-style: none;
	border-right-width: medium;
	border-bottom-color: currentcolor;
	border-left-color: currentcolor;
	border-right: 1px solid #cecece;
	border-right-color: rgb(206, 206, 206);
	border-radius: 0 !important;
}
.row.site-pagination ul li {
	display: inline-block;
}
ul.pagination {
	text-align: center;
	background: #f0f0f0;
	display: inline-block;
	width: 100%;
	border-radius: 9px !important;
	overflow: hidden;
}

i.fas.fa-chevron-right.right-pagi {
	padding-left: 9px;
	color: #a6a6a6;
}
ul.pagination .page-link {
	border-right: 1px solid #e2e2e2;
	border-right-color: #e2e2e2;
	border-bottom: 1px solid #f0f0f0;

}
.slider-img{
	padding-left:0px;
}
ul.pagination .page-link:hover{
	border-bottom: 1px solid #4185cc;
	color: #4185cc;
}
ul.pagination .page-link:focus{
	border-bottom: 1px solid #4185cc;
	color: #4185cc;
}
.page-item.active .page-link {
	z-index: 1;
	color: #333333;
	background-color: transparent;
	border-color: #e2e2e2;


}
.page-link {
	border-bottom: 1px solid #f0f0f0;

}
.page-link:hover{
	border-bottom: 1px solid #000;
}
.reviws .mob-btn {
	display: none !important;
}
@media (max-width: 768px){
	.mobile-modal .close {
        color: #2d2929 !important;
        top: 0px !important;
        right: 10px !important;
    }

	.owl-theme .owl-nav.disabled+.owl-dots {
		margin-top: 10px;
		float: left;
		background: #fff;
		width: 100%;
	}
	.owl-theme .owl-dots, .owl-theme .owl-nav {
		text-align: left !important;
		-webkit-tap-highlight-color: transparent;
	}
	.owl-theme .owl-dots .owl-dot span {
		width: 6px !important;
		height: 6px !important;
	}
	.premium h5 {
		margin: 15px 0;
	}
	.premium {
		padding: 0 !important;
	}
	.row.heading-sec {
		display: none;
	}
	.col-lg-12.product-btn {
		display: none;
	}
	.row.site-pagination ul li {
		display: none;
	}
	.pagination .page-item:first-child {
		display: block;
		width: 50%;
	}
	.pagination .page-item:last-child {
		display: block;
		width: 50%;
	}
	.col-lg-6.detail-box {
		margin-top: 0;
		margin-left: 15px;
		margin-right: 15px;
	}
	.titu {
		padding-left: 15px;
	}
	.detail-box {
		box-shadow: 0 0px 15px 0 #0000001a;
		padding-bottom: 10px;
	}
	.detail-box2 {
		box-shadow: none;
	}
	.owl-carousel .owl-item img,
	.product-slider img.img-respomsive {
		border-radius: 10px 10px 0px 0;
	}
	.great-deal,
	.dooler {
		width: 50%;
	}
	.col-lg-5.var-1 {
		border-top: 1px solid #ebebeb;
		padding-top: 15px;
	}
	.col-lg-7.col-sm-7.dooler span {
		float: right;
		width: 70%;
		margin-bottom: 3px;
	}
	.col-lg-5.var-1 {
		border-top: 1px solid #ebebeb;
		padding-top: 15px;
	}
	.var-list strong {
		width: 46%;
		float: right;
	}
	.var-2 {
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;
	}
	.reviws ul {
		border: none;
	}
	.reviws {
		text-align: center;
	}
	span.hifun {
		display: none;
	}
	.reviws .mob-btn {
		width: 100%;
		text-align: center;
		padding: 7px 0 !important;
		color: #333333 !important;
		font-weight: 500;
		margin-top: 10px;
		background: #fff !important;
		border: 1px solid #165a84;
		display: block !important;
	}
	strong.desktop-nb {
		display: none;
	}
	a.chk-btn {
		margin-top: 3px;
	}
}
</style>

<script>
function initialState() {
	return {
		type: '',
		zip: '',
		radius: '',
		min_year: '',
		max_year: '',
		make: [],
		min_price: '',
		max_price: '',
		miles: '',
		price: '',
		model: [],
		dealrating: [],
		features: [],
		color: [],
		body: [],
		exteriorcolor: [],
		interiorcolor: [],
		drivetrain: [],
		transmission: [],
		enginecylinders: [],
		photos: '',
		fuel_type: [],
		doors: [],
		search_make: '',
		search_model: '',
		search_zip: '',
		search_type: '',
		search_body: '',
		search_price: '',
		search_distance: '',
	}
}
import Carousel from 'vue-owl-carousel';
import ContactForm from './ContactForm'

export default {
	mounted() {
		console.log("FilterProduct component", this.products);
	},
	props: {
		products: {
			type: Object
		}
	},
	components: {
		Carousel,
		ContactForm
	},
	data() {
		return {
			productsList: {
				searches: {}
			},
			percentage: 3.99,
			calculateprice: 0,
			downpayment: 0,
			pagination: {},
			product_searches: [],
			navtext: ["<img src='images/left-owl.png'>","<img src='images/right-owl.png'>"],

			selectedProduct: {},
			footerExpanded: false
		}
	},
	methods : {
		belowPrice(msrp,price) {
			let belowprice = (msrp - price);
			return belowprice.toLocaleString();
		},
		productTypeIsUsed(product) {
			return product.type == 'Used';
		},
		getProductsData(productList, index) {
			let newproductslist = productList;
			// newproductslist.prev_vin = '';
			// newproductslist.prev_index = '';
			// newproductslist.data[index].cur_index = index;
			// if (index > 1) {
			// 	newproductslist.data[index].prev_vin = newproductslist.data[index-1].vin;
			// 	newproductslist.data[index].prev_index = index - 1;
			// }
			// newproductslist.next_vin = '';
			// newproductslist.next_index = '';
			// if (index < (newproductslist.data.length - 1)) {
			// 	newproductslist.data[index].next_vin = newproductslist.data[index+1].vin;
			// 	newproductslist.data[index].next_index = index + 1;
			// }
			return newproductslist;
		},
		changePage(page) {
			this.products.current_page = page;
			this.$emit('paginate', this.products);
		},
		getStringData($object) {
			let data = [];
			$.each($object, function(key, value) {
				if (Array.isArray(value)) {
					$.each(value, function(k, v) {
						if (v) {
							data.push({type: key, value : v});
						}
					});
				} else {
					if (value) {
						data.push({type: key, value : value});
					}
				}
			});
			return data;
		},
		checkValue(value) {
			if (Array.isArray(value)) {
				$.each(value, function(key, val) {
					if (val) {
						return true;
					} else {
						return false;
					}
				});
			} else {
				if (value !== '') {
					return true;
				}
				return false;
			}
		},
		getValue(value, type) {
			let val = value;
			if (type == 'min_year') {
				val = val + ' Min year';
			}
			if (type == 'search_distance') {
				val = val + ' mile distance';
			}
			if (type == 'miles') {
				val = val + ' miles';
			}
			if (type == 'max_year') {
				val = val + ' Max year';
			}
			if (type == 'min_price') {
				val = '$' + val + ' Min Price';
			}
			if (type == 'max_price') {
				val = '$' + val + ' Max Price';
			}
			if (type == 'enginecylinders') {
				val = val + ' cylinder';
			}
			return val;
		},
		clearValue(type, value) {
			if (type == 'type') {
				this.productsList.searches.type = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'zip') {
				this.productsList.searches.zip = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'radius') {
				this.productsList.searches.radius = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'min_year') {
				this.productsList.searches.min_year = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'max_year') {
				this.productsList.searches.max_year = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'min_price') {
				this.productsList.searches.min_price = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'max_price') {
				this.productsList.searches.max_price = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'miles') {
				this.productsList.searches.miles = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'photos') {
				this.productsList.searches.photos = '';
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'make') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.make)) {
					$.each(this.productsList.searches.make, function(key, val) {
						if (val) {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.make = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'dealrating') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.dealrating)) {
					$.each(this.productsList.searches.dealrating, function(key, val) {
						if (val) {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.dealrating = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'body') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.body)) {
					$.each(this.productsList.searches.body, function(key, val) {
						if (val) {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.body = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'exteriorcolor') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.exteriorcolor)) {
					$.each(this.productsList.searches.exteriorcolor, function(key, val) {
						if (val) {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.exteriorcolor = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'interiorcolor') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.interiorcolor)) {
					$.each(this.productsList.searches.interiorcolor, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.interiorcolor = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'drivetrain') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.drivetrain)) {
					$.each(this.productsList.searches.drivetrain, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.drivetrain = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'transmission') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.transmission)) {
					$.each(this.productsList.searches.transmission, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.transmission = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'enginecylinders') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.enginecylinders)) {
					$.each(this.productsList.searches.enginecylinders, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.enginecylinders = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'fuel_type') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.fuel_type)) {
					$.each(this.productsList.searches.fuel_type, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.fuel_type = new_search;
				this.$emit('searches', this.productsList.searches);
			} else if (type == 'features') {
				let new_search = [];
				if (Array.isArray(this.productsList.searches.features)) {
					$.each(this.productsList.searches.features, function(key, val) {
						if (val !== '') {
							if (val !== value) {
								new_search.push(val);
							}
						}
					});
				}
				this.productsList.searches.features = new_search;
				this.$emit('searches', this.productsList.searches);
			}
			this.product_searches = this.getStringData(this.productsList.searches);
		},
		clearAllValue() {
			this.productsList.searches = initialState();
			this.$emit('searches', this.productsList.searches);
			this.product_searches = this.getStringData(this.productsList.searches);
		},

		openModal(product) {
			this.selectedProduct = product;
			this.$refs.contactModal.style.display = "block";
		},

		closeModal() {
			this.selectedProduct = {};
			this.$refs.contactModal.style.display = "none";
		},
		calculatePrice(sellingprice) {
			let terms = 60;
			let price = 0;
			price = (((this.percentage / 100) * sellingprice + sellingprice)) / terms ;
			return price.toFixed(0);
		},

		showMoreFooter() {
			this.footerExpanded = !this.footerExpanded;
		}
	},
	computed: {
		pagesNumber: function () {
			if (!this.productsList.to) {
				return [];
			}
			var from = this.productsList.current_page - 4;
			if (from < 1) {
				from = 1;
			}
			var to = from + (4 * 2) ;
			if (to >= this.productsList.last_page) {
				to = this.productsList.last_page;
			}
			var pagesArray = [];
			for (let page = from; page <= to; page++) {
				pagesArray.push(page);
			}
			return pagesArray;
		},
	},

	watch: {
		products() {
			this.productsList = this.products;
			this.product_searches = this.getStringData(this.productsList.searches);
		},
	}
};
</script>
