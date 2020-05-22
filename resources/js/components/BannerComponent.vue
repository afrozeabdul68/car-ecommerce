<template>
	<div v-if="$route.name == 'cardetail' || $route.name == 'dealer'" class="row">
		<div class="col-lg-12 blockB ">
			<div class="breadcrum">
				<h6>Home<span>/</span>Search</h6>       
			</div>
		</div>
	</div>
	<div v-else-if="$route.name == 'privacy'" class="row">
		<div class="col-lg-12 blockB ">
			<div class="breadcrum">
				<h6>Home<span>/</span>Privacy Statement</h6>       
			</div>
		</div>
	</div>
	<div v-else-if="$route.name == 'terms-of-service'" class="row">
		<div class="col-lg-12 blockB ">
			<div class="breadcrum">
				<h6>Home<span>/</span>Terms of Service</h6>
			</div>
		</div>
	</div>
	<div v-else-if="$route.name == 'contact-us'" class="row">
		<div class="col-lg-12 blockB ">
			<div class="breadcrum">
				<h6>Home<span>/</span>Contact Us</h6>
			</div>
		</div>
	</div>
	<!-- banner start -->
	<div v-else class="site-banner" style="background-image : url(/images/single-page-bg.jpg)">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h5>Home<span>/</span> Search</h5>
					<h1>{{searchInfo}}</h1>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.site-banner {
	/*background-image: url(../images/single-page-bg.jpg);*/
	padding: 120px 0;
	text-align: center;
	color: #fff;
	background-size: cover;
	background-repeat: no-repeat;
	max-height: 250px;
}
.site-banner h1 {
	font-size: 50px;
	text-transform: uppercase;
	padding-top: 10px;
	padding-bottom: 30px;
}
.site-banner h5 span {
	margin-left: 5px;
	margin-right: 5px;
}
.site-banner h5 {
	font-size: 12px;
	color: rgb(102, 102, 102);
}
@media (max-width: 768px) {
	.site-banner h1 {
		font-size: 36px;
	}
}
</style>

<script>
export default {
    props: {
		products: {
			type: Object
		}
    },
    data() {
		return {
			searchInfo: '',
		}
	},
    watch: {
		products() {
            console.log("type", this.products.searches.type);
            this.searchInfo = ""
            if (this.products.searches.type !== '') {
                this.searchInfo += this.products.searches.type;
            }
            if (this.products.searches.make !== '') {
                this.searchInfo += " " + this.products.searches.make;
                if (this.products.searches.model !== '') {
                    this.searchInfo += " " + this.products.searches.model;
                } else {
                    this.searchInfo += " Cars";
                }
            } else {
                this.searchInfo += " Cars";
            }
            this.searchInfo += " for Sale";
            // this.searchInfo += " for Sale in " + this.products.searches.search_zip;
		},
	}
};
</script>
