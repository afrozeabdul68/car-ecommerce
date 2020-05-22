<template>
	<div class="suvs-section sedans">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><span>//</span> SEDANS</h2>
					<Carousel v-if="products" :items="$mq === 'mobile' ? 1 : 4" :nav="$mq === 'mobile' ? false : true" :dots="$mq === 'mobile' ? true : false" :margin="15" :navElement="'button'" :navText="navtext" >
						<div class="item" v-for="product in sedanproducts">
							<a href="#">
								<img :src="featuredImage(product)" alt="sedan-product-img" />
								<h3>{{product.type}} {{product.year}} {{product.make}} {{product.model}}</h3>
								<p>${{product.sellingprice.toLocaleString()}} <span>-{{product.miles.toLocaleString()}} mi</span></p>
							</a>
						</div>
					</Carousel>
					<div class="suv-btn">
						<a href="#">All Sedans</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.sedans .suv-btn a {
	background: #e0ebf6;
	width: 100%;
	display: inline-block;
	text-align: center;
	padding: 15px;
	color: #333333;
	font-size: 14px;
	margin: 0;
	font-weight:700;
	text-decoration: none;
}
.suvs-section.sedans {
	margin: 100px 0;
}
</style>

<script>
import Carousel from 'vue-owl-carousel';
export default {
	mounted() {
		console.log('Component mounted.');
		this.getAllSedanProducts();
	},
	components: {
		Carousel,
	},
	methods : {
		getAllSedanProducts() {
			this.axios.get('api/v2/get-all-sedanproducts').then(response => {
				this.sedanproducts = response.data;
				this.products = true;
			});
        },

        featuredImage(product) {
            return product.images.length ? product.images[0].image : '/images/no-car.png';
        }
	},
	data() {
		return {
			sedanproducts: [],
			products: false,
			navtext: ["<span aria-label='Previous'>‹</span>","<span aria-label='Next'>›</span>"],
		}
	}
};
</script>
