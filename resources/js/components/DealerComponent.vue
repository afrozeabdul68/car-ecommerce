<template>
	<div class="dealer-box">
		<div class="slider-car">
			<div class="container">
				<app-banner></app-banner>
				<!-- pagination -->			
				<div class="row site-pagination site-pagination2">
					<div class="col-lg-12 block-section">
						<h2>Dealers Near You</h2>

					</div>
				</div>
				<div class="row">
					<div class="col-md-6 match-left">
						<h5><span>//</span> 81 Dealers in Colorado Springs,CO</h5>
					</div>
					<div class="col-md-6 match-right">
						<label>Distance:</label>
						<select>
							<option>Nearest to Furthest</option>
							<option>Nearest to Furthest</option>
							<option>Nearest to Furthest</option>
						</select>
						<i class="fas fa-chevron-down s-down"></i>

					</div>
					<div class="col-md-12 match-right-m mobile-sort">
						<h4><img src="/images/sort-icon-m.png"> Nearest to Furthest</h4>

					</div>
					<div class="col-md-12 match-left">
						<hr>
					</div>
				</div>
			</div>
		</div>

		<div class="dealer-part">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="left-menu-section">
							<ul>
								<li><a href="#" @click.prevent="openNav('location')"><i class="fas fa-map-marker-alt"></i><br>Location</a>
									<div class="menu-hover sidenav" :class="isLocation ? 'show' : ''" id="mySidenav12">
										<div class="padding-20">
											<a href="#" class="closebtn" @click.prevent="closeNav('location')">&times;</a>
											<div class="top-heading">
												<h4>Location<br><span>81 matches</span></h4>
												<a href="#" @click.prevent="searchDealer('location')">Apply</a>
											</div>
											<div class="loc-section">
												<select v-model="distance">
													<option value="30">30 miles</option>
													<option value="40">40 miles</option>
													<option value="50">50 miles</option>
												</select>
												<input class="tab-text" v-model="zip" type="text" placeholder="">
											</div>
										</div>
										<div class="done-btn"><a href="#">Done</a></div>
									</div>
								</li>
								<li><a href="#" @click.prevent="openNav('make')"><i class="fas fa-bars"></i><br>Make</a>
									<div class="menu-hover sidenav" :class="isMake ? 'show' : ''" id="mySidenav13">
										<div class="padding-20">
											<a href="#" class="closebtn" @click.prevent="closeNav('make')">&times;</a>
											<div class="top-heading">
												<h4>Make<br><span>81 matches</span></h4>
												<a href="#" @click.prevent="searchDealer('make')">Apply</a>
											</div>
											<div class="loc-section">
												<div class="make-scroll">
													<label class="con" v-for="m in makes">{{m}}
														<input v-model="make" type="checkbox" :value="m">
														<span class="checkmark"></span>
													</label>
												</div>
											</div>
										</div>
										<div class="done-btn"><a href="#">Done</a></div>
									</div>
								</li>
								<li><a href="#" @click.prevent="openNav('dealer_rating')"><i class="far fa-star"></i><br>Dealer Rating</a>
									<div class="menu-hover sidenav" :class="isDealerRating ? 'show' : ''" id="mySidenav14">
										<div class="padding-20">
											<a href="#" class="closebtn" @click.prevent="closeNav('dealer_rating')">&times;</a>
											<div class="top-heading">
												<h4>Dealer Rating<br><span>81 matches</span></h4>
												<a href="#" @click.prevent="searchDealer('rating')">Apply</a>
											</div>
											<div class="loc-section">
												<div class="make-scroll">
													<!-- Default unchecked -->
													<!-- Group of default radios - option 1 -->
													<div class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="defaultGroupExample5" name="groupOfDefaultRadios">
														<label class="custom-control-label" for="defaultGroupExample5">Any</label>
													</div>

													<!-- Group of default radios - option 2 -->
													<div class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="defaultGroupExample6" name="groupOfDefaultRadios" checked="">
														<label class="custom-control-label" for="defaultGroupExample6">2 stars or more</label>
													</div>

													<!-- Group of default radios - option 3 -->
													<div class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="defaultGroupExample7" name="groupOfDefaultRadios">
														<label class="custom-control-label" for="defaultGroupExample7">3 stars or more</label>
													</div>
													<!-- Group of default radios - option 2 -->
													<div class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="defaultGroupExample8" name="groupOfDefaultRadios">
														<label class="custom-control-label" for="defaultGroupExample8">4 stars or more</label>
													</div>

												</div>
											</div>
										</div>
										<div class="done-btn"><a href="#">Done</a></div>
									</div>
								</li>
								<li><a href="#" @click.prevent="openNav('dealer_name')"><i class="fas fa-user"></i><br>Dealer Name</a>
									<div class="menu-hover sidenav" :class="isDealerName ? 'show' : ''" id="mySidenav15">
										<div class="padding-20">
											<a href="#" class="closebtn" @click.prevent="closeNav('dealer_name')">&times;</a>
											<div class="top-heading">
												<h4>Dealer Name<br><span></span></h4>
												<a href="#" @click.prevent="searchDealer('name')">Apply</a>
											</div>
											<div class="loc-section">
												<input class="tab-text" v-model="dealer_name" type="text" placeholder="Dealer Name">
											</div>
										</div>	
										<div class="done-btn"><a href="#">Done</a></div>
									</div>
								</li>
							</ul>
						</div>

						<div class="right-menu-section">
							<ul v-if="dealers.total > 0">
								<li v-for="dealer in dealers.data">
									<h3><a href="#">{{dealer.name}}</a></h3>
									<span class="rating-product">4.9 <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><span>593 Google reviews</span></span>
									<span class="miles">{{dealer.address}} {{dealer.distance}} miles away</span>
									<p>Sales: {{dealer.call_tracking_no}}</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.dealer-box {
	max-width: 750px;
	margin: auto;
	width:100%;
}
.left-menu-section {
	width: 25%;
	float:left;
}
.right-menu-section {
	width: 75%;
	float:left;
}
.right-menu-section ul {
	list-style: none;
	padding: 0;
}
.rating-product {
	font-size: 14px;
	color: #f57325;
	width: 100%;
	display: inline-block;
}
.rating-product i:first-child {
	padding-left: 7px;
}
.rating-product i {
	padding-right: 4px;
}
.rating-product span {
	color: #333;
	font-weight: 300;
	padding-left: 9px;
}
.miles {
	font-size: 12px;
	color: #999;
	font-weight: 300;
}
.right-menu-section ul li h3 {

	font-size: 16px;
	font-family: 'Roboto', sans-serif;

}
.right-menu-section ul li h3 a{
	text-decoration:none;
	color: #165a84;

}
.right-menu-section ul li p {
	font-size: 12px;
	margin-bottom:0;
	color: #333;
}
.right-menu-section ul li:hover {

	border-color: #fff;
	box-shadow: 10px 0px 30px rgba(0, 0, 0, 0.10);

}
.right-menu-section ul li {

	border: 1px solid #e6e6e6;
	padding: 18px;
	border-radius: 13px;
	margin-bottom: 20px;

}
.left-menu-section ul li {

	height: 105px;

	text-align: center;
	display:table; width:100%;

}
.left-menu-section ul li i {

	font-size: 28px;
	margin-bottom: 15px;

}
.left-menu-section ul li a {
	text-decoration:none;
	height: 135px;
	display: inline-block;
	width: 100%;
	border-bottom: 2px solid #ebebeb;
	color: #333;
	font-size: 14px;
	font-weight: 600;
	display: table-cell;

	vertical-align: middle;

}
.menu-hover {

	display: none;
	position: absolute;
	left: 100%;
	width: 318px;
	top:0;
	background: #fff;
	box-shadow: 10px 0px 30px rgba(0, 0, 0, 0.10);
	padding: 20px;
	max-height:600px;
	min-height:600px;
	height:100%;
	text-align: left;

}
.top-heading h4 {

	font-size: 14px;
	text-transform: uppercase;
	float:left;
}
.top-heading a {

	float: right;
	width: auto !important;
	background: #e0ebf6;
	height: auto !important;
	padding: 7px 33px;
	border-radius: 3px;
	border: none !important;
	color: #333 !important;
	font-size: 14px !important;

}
.col-md-12.match-left {
	margin-bottom: 15px;
}
.loc-section input.tab-text {
	padding: 8px 10px;
	height: auto;
	color: #333;
}
.loc-section .make-scroll {
	height: 481px;
}
.loc-section .con {
	border-bottom: 1px solid #ebebeb;
	padding-bottom: 13px;
}
.loc-section .custom-control {
	border-bottom: 1px solid #ebebeb;
	padding-bottom: 6px;
	padding-top: 4px;
}
.loc-section .checkmark {

	border-radius: 2px;
	background: none;
	background-color: rgba(0, 0, 0, 0);
	border: 1px solid #ccc;
}
.loc-section .con .checkmark::after {
	left: 7.5px;
	top: 4px;
}
.loc-section .con input:checked ~ .checkmark {
	background-color: #2196F3;
	border: none;
}
.top-heading {

	display: inline-block;
	width: 100%;
	border-bottom: 1px solid #ebebeb;
	padding-bottom: 8px;
	margin-bottom: 10px;

}
body .loc-section select {
	color: #165a84 !important;
	font-size: 16px;
	font-weight: bold;
	padding: 6px 5px;
	height: 40px;
}
.loc-section select {

	width: 100%;
	margin-bottom: 10px;
	margin-top: 5px;
	border: 1px solid #ccc;
	border-radius: 3px;

}
.dealer-part {

	padding-bottom: 80px;

}
.top-heading h4 span {

	text-transform: capitalize;
	font-size: 12px;
	font-family: 'roboto';
	color: #999;
	font-weight: 300;
	margin-top: 8px;
	display: inline-block;

}
.left-menu-section ul li:hover div.sidenav.menu-hover{display:block;}
.left-menu-section ul li:hover div#mySidenav{display:block;}
.sidenav.menu-hover .closebtn{display:none;}
.left-menu-section ul li a:hover{color:#41abed; border-bottom: 2px solid #41abed;}
.left-menu-section ul li:last-child a:hover{color:#41abed; border-bottom: 2px solid #41abed;}
.left-menu-section ul li:last-child a{border-bottom:2px solid #f7f7f7;}
.left-menu-section ul {

	background: #f7f7f7;
	padding: 0;
	list-style: none;
	border-radius: 10px 0 0 10px;
	border: 1px solid #ebebeb;
	position:relative;
}
.right-menu-section {
	padding-left: 30px;
}
.done-btn {display:none;}
.match-right-m{display:none;}
body .menu-hover{ width:318px; }
@media(max-width:1280px){
	body a.nav-link {
		padding: 9px 5px !important;
	}

}
@media(max-width:991px){
	.dealer-box {
		padding-top: 90px;
	}
	.top-heading a{display:none;}
	.match-right-m{display:block;}
	.match-right{display:none;}
	.dealer-box .block-section h2 {
		margin-bottom: 10px;
	}
	.done-btn {display:block;}
	.done-btn a {
		height: auto !important;
		border: none !important;
		width: 100%;
		text-align: center;
		float: left;
		background: #165a84;
		color: #fff !important;
		padding: 10px 10px;
		border-radius: 4px;
	}
	.loc-section .con {
		border-bottom: none;
		padding-bottom: 0;
		margin: 0 0 13px 0;
	}
	.loc-section .custom-control {
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 0;
		padding-top: 0px;

	}
	.loc-section .custom-control:first-child{border-top: 1px solid #ebebeb; padding-top: 10px;}
	.sidenav .closebtn {
		position: absolute;
		top: 1px;
		right: -260px;
		font-size: 29px;
		margin-left: 50px;
	}
	.top-heading {
		border-bottom: none;
		padding-bottom: 0;
	}
	.col-md-6.match-left h5 {
		font-size: 14px;
		font-family: 'Roboto', sans-serif;
		letter-spacing: 0.5px;
		color:#333;
	}
	.done-btn {
		position: absolute;
		width: auto;
		left: 20px;
		right: 20px;
		bottom: 27px;
	}
	.col-md-12.match-right-m.mobile-sort h4 img{margin-right:7px;}
	body .top-heading a {
		display: none !important;
	}
	.top-heading h4{font-size:20px;}
	.top-heading h4 span{display:none;}
	.col-md-6.match-left h5 span{display:none;}
	.left-menu-section {
		width: 100%;
		float: left;
	}
	.left-menu-section ul {
		background: #f7f7f7;
		padding: 0;
		list-style: none;
		border-radius: 10px 0 0 10px;
		border: 1px solid #dfdfdf;
		position: relative;
		display: inline-block;
		width: 100%;
	}
	.left-menu-section ul li {
		width: 25%;
		float: left;
		border-bottom: none !important;
	}
	.left-menu-section ul li a:hover {
		color: #41abed;
		border-bottom: none;
	}
	.left-menu-section ul li a{padding:7px;}
	.col-md-12.match-left {
		display: none;
	}
	.dealer-part {
		padding-top: 15px;
	}
	.left-menu-section ul li:last-child a:hover {
		color: #41abed;
		border-bottom: none;
	}
	body .left-menu-section ul {
		border-radius: inherit !important;
	}
	.right-menu-section {
		padding-left: 0;
		width: 100%;
	}
	.left-menu-section ul li:last-child a {
		border-bottom: none;
		border-right: none;
	}
	.left-menu-section ul li a {
		text-decoration: none;
		height: 135px;
		display: inline-block;
		width: 100%;
		border-bottom: none;
		color: #333;
		font-size: 14px;
		font-weight: 600;
		display: table-cell;
		vertical-align: middle;
		border-right: 1px solid #dfdfdf;
	}
	.dealer-box .match-left {
		max-width: 100% !important;
		flex: 0 0 100%;
	}

	.left-menu-section {
		width: auto;
		float: none;
		margin: 0 -15px;
	}
	.col-md-6.match-left {
		border-bottom: 1px solid #ccc;
		padding-bottom: 30px;
		margin-bottom: 20px;
	}
	.col-md-12.match-right-m.mobile-sort h4 {
		font-size: 16px;
		color: #165a84;
		font-family: 'Roboto', sans-serif;
	}
	.padding-20 {
		padding: 20px;
		padding-right:30px;
	}
	.sidenav.menu-hover .closebtn {
		display: block;
		height: auto;
		border: none;
	}
	.sidenav.menu-hover .closebtn:hover{border:none;}
	body .menu-hover{display:block; width:0; padding:0; margin-right:-10px; }
	.left-menu-section ul li:hover div.sidenav.menu-hover{display:block;}
	.dealer-box .match-right {
		max-width: 100% !important;
		flex: 0 0 100%;
		text-align: center;
	}
	.menu-hover {
		display: none;
		position: fixed;
		width: unset;
	}
	.sidenav.menu-hover .closebtn {
		display: block;
	}

}

@media (max-width:767px){
	.dealer-box {
		padding-top: 60px;
	}
	.menu-hover.show {
		left: 5%;
		width: 100%;
	}

}
@media (max-width:575px){
	body .left-menu-section ul {
		border-right: none;
		border-left: none;
	}

}
</style>

<script>
import AppBanner from './BannerComponent.vue';
export default {
	mounted() {
		this.searchDealer();
	},
	data() {
		return {
			dealers: [],
			dealer_name: '',
			make: [],
			makes: [],
			distance: '',
			zip: '',
			isLocation : false,
			isMake : false,
			isDealerRating : false,
			isDealerName : false,
		}
	},
	methods : {
		searchDealer(searchBy = '') {
			if (searchBy == 'name') {
				this.axios.get('api/v2/search-dealer?name=' + this.dealer_name).then(response => {
					this.dealers = response.data.dealers;
					this.makes = response.data.make;
				});
			} else if (searchBy == 'location') {
				this.axios.get('api/v2/search-dealer?distance=' + this.distance + '&zip' + this.zip).then(response => {
					this.dealers = response.data.dealers;
					this.makes = response.data.make;
				});
			} else if (searchBy == 'make') {
				this.axios.get('api/v2/search-dealer?make=' + this.make).then(response => {
					this.dealers = response.data.dealers;
					this.makes = response.data.make;
				});
			} else {
				this.axios.get('api/v2/search-dealer').then(response => {
					this.dealers = response.data.dealers;
					this.makes = response.data.make;
				});
			}
		},
		openNav($event) {
			if ($event == 'make') {
				this.isMake = true;
			}
			if ($event == 'location') {
				this.isLocation = true;
			}
			if ($event == 'dealer_rating') {
				this.isDealerRating = true;
			}
			if ($event == 'dealer_name') {
				this.isDealerName = true;
			}
		},
		closeNav($event) {
			if ($event == 'make') {
				this.isMake = false;
			}
			if ($event == 'location') {
				this.isLocation = false;
			}
			if ($event == 'dealer_rating') {
				this.isDealerRating = false;
			}
			if ($event == 'dealer_name') {
				this.isDealerName = false;
			}
		}
	},
	components: {
		AppBanner,
	}
};
</script>
