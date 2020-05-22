<template>
	<div class="suvs-section sedans">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><span>//</span> PICKUP TRUCKS</h2>
					<Carousel v-if="products" :items="$mq === 'mobile' ? 1 : 4" :nav="$mq === 'mobile' ? false : true" :dots="$mq === 'mobile' ? true : false" :margin="15" :navElement="'button'" :navText="navtext" >
						<div class="item" v-for="product in truckproducts">
							<a href="#">
								<img :src="featuredImage(product)" alt="pickup-product-img" />
								<h3>{{product.type}} {{product.year}} {{product.make}} {{product.model}}</h3>
								<p>${{product.sellingprice.toLocaleString()}} <span>-{{product.miles.toLocaleString()}} mi</span></p>
							</a>
						</div>
					</Carousel>
					<div class="suv-btn">
						<a href="#">All Pickup Trucks</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>

</style>

<script>
import Carousel from 'vue-owl-carousel';
export default {
	mounted() {
		console.log('Component mounted.');
		this.getAllTruckProducts();
	},
	components: {
		Carousel,
	},
	methods : {
		getAllTruckProducts() {
			this.axios.get('api/v2/get-all-truckproducts').then(response => {
				this.truckproducts = response.data;
				this.products = true;
			});
        },

        featuredImage(product) {
            return product.images.length ? product.images[0].image : '/images/no-car.png';
        }
	},
	data() {
		return {
			truckproducts: [],
			products: false,
			navtext: ["<span aria-label='Previous'>‹</span>","<span aria-label='Next'>›</span>"],
		}
	}
};
</script>
