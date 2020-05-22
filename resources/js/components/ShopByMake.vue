<template>
	<div class="shop-by" style="background-image: url(../images/shop-make-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2><span>//</span>	SHOP BY MAKE</h2>
				</div>
			</div>

			<div class="row" v-if="$mq === 'desktop'">

				<div class="col-lg-3 col-sm-6 col-xs-6" v-for="(item, index) in shop_items" :key="index">
					<div class="shop-box">
						<ul>
							<li v-for="makes in item.makes" :key="makes.name"><a href="#">{{makes.name}}</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" v-else>
				<div class="col-lg-3 col-sm-6 col-xs-6" >
					<Carousel :items="2" :nav="false" :dots="true" :margin="15" >
						<div class="shop-box" v-for="(m_item, index) in shop_items" :key="index">
							<ul>
								<li v-for="makes in m_item.makes" :key="makes.name"><a href="#">{{ makes.name }}</a></li>
							</ul>
						</div>
					</Carousel>
				</div>
			</div>
		</div>

	</div>
</template>

<style>
.shop-by {
	margin-top: -150px;
}
.shop-box ul li a {
	text-decoration: none;
	color: #cccccc;
	font-size: 14px;
}
.shop-box ul li:hover a {color:#fff;}
.shop-box ul li {
	list-style: none;
	margin-bottom: 10px;
	border-bottom: 1px solid #36393d;
	padding-bottom: 10px;
}
.shop-box ul li:hover {
	border-bottom: 1px solid #41abed;

}
.shop-box ul {
	margin: 0;
	padding: 0;
}
</style>

<script>
import Carousel from 'vue-owl-carousel';
export default {
	mounted() {
		console.log('Component mounted.');
	},
	components: {
		Carousel,
	},
	data() {
		return {
			shop_items : [
			{
				makes : [
				{ name : "Acura" },
				{ name : "Alfa Romeo" },
				{ name : "Aston Martin" },
				{ name : "Audi" },
				{ name : "Bentley" },
				{ name : "BMW" },
				{ name : "Buick" },
				{ name : "Cadillac" },
				{ name : "Chevrolet" },
				{ name : "Chrysler" },
				{ name : "Dodge" },
				]
			},
			{
				makes : [
				{ name : "Ferrari" },
				{ name : "FIAT" },
				{ name : "Ford" },
				{ name : "Genesis" },
				{ name : "GMC" },
				{ name : "Honda" },
				{ name : "Hyundai" },
				{ name : "INFINITI" },
				{ name : "Jaguar" },
				{ name : "Jeep" },
				{ name : "Kia" },
				]
			},
			{
				makes : [
				{ name : "Lamborghini" },
				{ name : "Land Rover" },
				{ name : "Lexus" },
				{ name : "Lincoln" },
				{ name : "Lotus" },
				{ name : "Maserati" },
				{ name : "Mazda" },
				{ name : "McLaren" },
				{ name : "Mercedes-Benz" },
				{ name : "MINI" },
				{ name : "Mitsubishi" },
				]
			},
			{
				makes : [
				{ name : "Nissan" },
				{ name : "Porsche" },
				{ name : "RAM" },
				{ name : "Rolls-Royce" },
				{ name : "Scion" },
				{ name : "smart" },
				{ name : "Subaru" },
				{ name : "Tesla" },
				{ name : "Toyota" },
				{ name : "Volkswagen" },
				{ name : "Volvo" },
				]
			},
			]
		}
	}
};
</script>
