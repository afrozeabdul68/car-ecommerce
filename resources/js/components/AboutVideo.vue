<template>
	<div class="suvs-section sedans">
		<div class="container">
			<div class="row">
				<div class="col-md-6 about-video">
					<img src="/images/about-video.png">
					<div class="col-md-12 about-video-text">
						<div class="double-quote">&#8221;</div>
						<div class="video-des">We have more traffic coming through CarDesta than any other third-party provider </div>
					</div>
					<div class="col-md-12 about-avatar-text">
						<img src="/images/about-avatar.png">
						<div class="avatar-name">Tom Gregg,</div>
						<div class="avatar-position">Internet Director at Dan Wolf Automotive: </div>
						<div class="avatar-location">Toyota of Naperville</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.about-video {
	margin: 70px auto;
}
.about-video img {
	width: 100%;
	border-radius: 10px;
}
.video-des {
	font-size: 17px;
	padding: 20px 0 20px 40px;
}
.double-quote {
	float: left;
	font-size: 70px;
	font-family: "Proxima Nova", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
	color: #41abed;
}
.about-avatar-text img {
	width: auto;
	border-radius: 50%;
	float: left;
}
.avatar-name {
	text-transform: uppercase;
    font-weight: bold;
    padding-left: 110px;
	font-size: 16px;
}
.avatar-position {
	font-size: 13px;
	color: #666666;
	padding-left: 110px;
}
.avatar-location {
	font-size: 14px;
	color: #666666;
	padding-left: 110px;
}
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
