<template>
	<header :class="$route.name == 'cardetail' || $route.name == 'dealer' || $route.name == 'privacy' || $route.name == 'terms-of-service' || $route.name == 'contact-us' ? '' + ' black-header' : '' + ' fixed-top'">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 logo"><router-link to="/" ><img src="/images/logo.png"></router-link></div>
				<div class="col-lg-6 col-md-9 nav-mobile">
					<nav class="navbar navbar-expand-md ">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
							<i class="fas fa-bars"></i>
						</button>
						<div ref="collapse" class="collapse navbar-collapse" id="collapsibleNavbar">
							<ul :class="$mq === 'mobile' ? 'navbar-nav navbar-mobile': 'navbar-nav'">
								<li class="nav-item">
									<router-link to="/search" class="nav-link" @click.native="scrollWin">New Cars</router-link>
								</li>
								<li class="nav-item">
									<router-link to="/search" class="nav-link" @click.native="scrollWin">Used Cars</router-link>
								</li>
								<li class="nav-item">
									<router-link to="/find-dealers" class="nav-link" @click.native="scrollWin">Find Dealerships</router-link>
								</li> 
								<li class="nav-item">
									<router-link to="/advertise" class="nav-link" @click.native="scrollWin">Advertise</router-link>
								</li>
								<li class="nav-item">
									<router-link to="/contact-us" class="nav-link" @click.native="scrollWin">Contact us</router-link>
								</li>
							</ul>
						</div>  
					</nav>
				</div>
				<div class="col-lg-3 col-md-12 col-sm-6 contact-no">
					<a class="phone-btn" href="#"><i class="fas fa-phone"></i> 1-877-939-0002</a>
				</div>
			</div>
		</div>
	</header>
</template>
<style>
.black-header {
	background: #000;
}
.black-header .container-fluid {
	border-bottom: none;
	padding-bottom: 0;
}

header{
	transition: background-color 0.5s ease;
	border-bottom: 1px solid rgba(200, 200, 200, 0.2);
}

.scroll-header{
	background: #000;
	z-index: 999999;
}
.navbar-mobile{
    height: 100vh;
}
</style>
<script>
export default {
	mounted() {
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 100) {
				$("header").addClass("scroll-header");
			}
			else {
				$("header").removeClass("scroll-header");
			}
		});
	},
	methods: {
		scrollWin() {
			$(this.$refs.collapse).collapse('hide');
			window.scrollTo(0, 0);
		}
	}
};
</script>
