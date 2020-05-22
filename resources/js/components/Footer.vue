<template>
	<div class="footer" v-if="$mq == 'desktop'">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-box">
						<a href="#"><img src="/images/logo.png" alt="logo-2"></a>
						<ul class="list-one">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 ">
					<div class="footer-box">
						<ul class="list-two">
							<li><a href="#">New Cars</a></li>
							<li><a href="#">Used Cars</a></li>
							<li><a href="#">Find Dealerships</a></li>
							<li><router-link to="/advertise" @click.native="scrollWin">Advertise</router-link></li>
							<li><router-link to="/contact-us" @click.native="scrollWin">Contact us</router-link></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-box">
						<ul class="list-two">
							<li><a href="#">Our Company</a></li>
							<li><router-link to="/about-us" @click.native="scrollWin">About CarDesta</router-link></li>
							<li><a href="#">Investor Relations</a></li>
							<li><a href="#">Contact CarDesta</a></li>
							<li><a href="#">Site Map</a></li>
							<li><a href="#">Careers</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-box">
						<ul class="list-two">
							<li><a href="#">Buying & Selling</a></li>
							<li><a href="#">Find a Car</a></li>
							<li><a href="#">Certified Pre-Owned</a></li>
							<li><a href="#">Car Dealers</a></li>
							<li><a href="#">Listings by City</a></li>
							<li><router-link to="/privacy" @click.native="scrollWin">Privacy Policy</router-link></li>
						</ul>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div v-else class="mobile-footer">
		<div class="container">		
			<div class="row">
				<div class="col-lg-12 ">
					<div class="footer-box">
						<a href="#"><img src="/images/logo.png" alt="logo-2"></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 mobile-two">
					<div class="footer-box">
						<ul class="list-two mobile-two">
							<li><a href="#">Main Page</a></li>
							<li><a href="#">New Cars</a></li>
							<li><a href="#">Used Cars</a></li>
							<li><a href="#">Find Dealerships</a></li>
							<li><router-link to="/advertise" @click.native="scrollWin">Advertise</router-link></li>
							<li><router-link to="/contact-us" @click.native="scrollWin">Contact Us</router-link></li>
							<li><a href="#">Our Company</a></li>
							<li><router-link to="/about-us" @click.native="scrollWin">About CarDesta</router-link></li>
							<li><a href="#">Investor Relations</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 mobile-two">
					<div class="footer-box">
						<ul class="list-two">
							<li><a href="#">Contact CarDesta</a></li>
							<li><a href="#">Site Map</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">Buying &amp; Selling</a></li>
							<li><a href="#">Find a Car</a></li>
							<li><a href="#">Certified Pre-Owned</a></li>
							<li><a href="#">Car Dealers</a></li>
							<li><a href="#">Listings by City</a></li>
							<li><router-link to="/privacy" @click.native="scrollWin">Privacy Policy</router-link></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-icons">
			<ul class="list-one mobile-list">

				<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
</template>

<style>
.footer{
	background:#0d0d0d;
	padding:50px 0 45px;
	color:#fff;
	border-top: 11px solid #41abed;
}
.list-one{
	margin:60px 0 0 0;
	padding:0;
}
.list-one li{
	list-style:none;
	padding-right:15px;
	display:inline-block;
}
ul.list-one li {
	background: #191919;
	border-radius: 20px;
	height: 40px;
	width: 40px;
	text-align: center;
	margin-left:10px;
}
ul.list-one li i {
	font-size: 14px;
	color: #fff;
	padding-left: 13px;
	margin-top: 13px;
}
.footer-box p {
	margin: 20px 0;
}

.list-two{
	margin:0;
	padding:0;
}
.list-two li {
	list-style: none;
	margin-bottom: 15px;
}
.list-two li a {
	color: #fff;
	font-size: 14px;
	text-decoration:none;
}
.list-two li a:hover{
	color:#41abed;
}
.footer-box h5 {
	color: #575757;
	font-size: 18px;
}
.footer-box h5 {
	margin-bottom: 29px;
}
.footer-box p {
	margin: 20px 0;
	font-size: 14px;
}
.t2 p {

	font-size: 14px;
}
.t2 img {
	margin-top: 30px;
}
@media (max-width: 768px) {
	.mobile-footer {
		display: block;
		background: #0d0d0d;
		padding: 50px 0 0px;
		color: #fff;
		border-top: 11px solid #41abed;
		text-align: center;
	}

	.footer-box {
		margin-bottom: 30px;
	}
	.col-lg-6.col-sm-6.mobile-two {
		width: 50%;
		margin: 15px 0 25px 0;
	}
	.mobile-icons {
		text-align: center;
		background: #0d0d0d;
		border-top: 1px solid #2a2a2a;
		border-bottom: 1px solid #2a2a2a;
		padding: 20px 0;
		display: block;
	}
	.mobile-list {
		margin: 0 !important;
	}
	.list-one {
		margin: 40px 0 0 0;
		padding: 0;
	}
	.mobile-copyright {
		border-top: none;
	}
	.mobile-copyright p {
		color: #ffffff78;
	}
}
</style>

<script>
export default {
	methods: {
		scrollWin() {
			window.scrollTo(0, 0);
		}
	}
};
</script>