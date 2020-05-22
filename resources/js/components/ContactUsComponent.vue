<template>
	<div>
		<div class="slider-car mw-750">
			<div class="container mt-130">
				<app-banner></app-banner>
				<!-- pagination -->			
				<div class="row site-pagination site-pagination2">
					<div class="col-lg-12 block-section">
						<h2>Contact Us</h2>
					</div>
				</div>
                <div :class="$mq == 'mobile' ? '' : ''">
                    <div class="srh-box about-dialog-bd mobile-contact-dialog">
                        <ul class="nav nav-tabs" :class="$mq == 'mobile' ? 'nav-justified' : ''" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">More Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">Customer Support</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="form-large-text">
                                    <h5>Find out how Cars.com can help your dealership</h5>
                                </div>
                                <div class="form-small-text">
                                    <h6>Thanks for your interest in CarDesta. Fill out this simple form, or call 877-939-0002 to learn more about<br v-if="$mq !== 'mobile'" />CarDesta's franchise and independent dealer solutions.</h6>
                                </div>
                                <div v-if="$mq === 'mobile'" class="col-lg-6 google-view pd-30">
                                    <div class="reviws reviw">
                                        <a class="mob-btn" :href="'tel:+1-866-415-6083'">(866) 415-6083</a>
                                    </div>
                                </div>
                                <div class="form-section mobile-form-section">
                                    <form class="mobile-form">
                                        <div class="form mobile-form-section">
                                            <div class="styled-select border-none about-border style-input">
                                                <label>First Name</label>
                                                <input type="text" name="zip" placeholder="First Name">
                                            </div>
                                            <div class="styled-select border-none about-border style-input">
                                                <label>Last Name</label>
                                                <input type="text" name="zip" placeholder="Last Name">
                                            </div>
                                            <div class="styled-select hg-23">
                                                <label>Title</label>
                                                <select name="type" @change="getMakesByType($event)">
                                                    <option value="" selected="selected">General Manager</option>
                                                    <option value="New">General Manager</option>
                                                    <option value="Used">General Manager</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="styled-select border-right-none hg-23"  :class="$mq === 'mobile' ? 'border-right' : ''">
                                                <label>Dealership Type</label>
                                                <select name="type" @change="getMakesByType($event)">
                                                    <option value="" selected="selected">Used Cars Only</option>
                                                    <option value="New">Used Cars Only</option>
                                                    <option value="Used">Used Cars Only</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="styled-select border-none about-border border-right-none style-input w-100">
                                                <label>Dealership Name</label>
                                                <input type="text" name="zip" placeholder="Dealership Name">
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>City</label>
                                                <input type="text" name="zip" placeholder="City">
                                            </div>
                                            <div class="styled-select hg-23 w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>State</label>
                                                <select name="type">
                                                    <option value="" selected="selected">State</option>
                                                    <option value="New">State</option>
                                                    <option value="Used">State</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33">
                                                <label>Zip</label>
                                                <input type="text" name="zip" placeholder="Zip">
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33">
                                                <label>Email</label>
                                                <input type="text" name="zip" placeholder="Email">
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>Shipping Country*</label>
                                                <input type="text" name="zip" placeholder="Shipping Country*">
                                            </div>
                                            <div class="styled-select border-none about-border border-right-none style-input w-33">
                                                <label>Phone</label>
                                                <input type="text" name="zip" placeholder="Phone">
                                            </div>
                                                <div class="styled-select border-none border-right-none style-input w-100">
                                                <label>Comment</label>
                                                <input type="text" name="zip" placeholder="Comment">
                                            </div>
                                        </div>
                                        <div class="about-news">
                                            <label class="con about-con">
                                                Send me Cardesta.com's monthly e-newsletter featuring tips and tricks to help sellmore cars online.
                                                <input type="checkbox" name="features">
                                                <span class="checkmark about-checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="type-btn mobile-type-btn">
                                            <input type="button" class="button" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane">
                                <div class="form-section mt-30">
                                    <form class="mobile-form">
                                        <div class="form mobile-form-section">
                                            <div class="styled-select border-none about-border style-input">
                                                <label>Dealership Name</label>
                                                <input type="text" name="zip" placeholder="Dealership Name">
                                            </div>
                                            <div class="styled-select border-none about-border style-input">
                                                <label>Contact Person</label>
                                                <input type="text" name="zip" placeholder="Contact Person">
                                            </div>
                                            <div class="styled-select hg-23">
                                                <label>Title</label>
                                                <select name="type" @change="getMakesByType($event)">
                                                    <option value="" selected="selected">General Manager</option>
                                                    <option value="New">General Manager</option>
                                                    <option value="Used">General Manager</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="styled-select border-right-none hg-23">
                                                <label>Dealership Type</label>
                                                <select name="type" @change="getMakesByType($event)">
                                                    <option value="" selected="selected">Used Cars Only</option>
                                                    <option value="New">Used Cars Only</option>
                                                    <option value="Used">Used Cars Only</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <!-- <div class="styled-select border-none about-border border-right-none style-input w-100 ">
                                                <label>Dealership Name</label>
                                                <input type="text" name="zip" placeholder="Dealership Name">
                                            </div> -->
                                            <div class="styled-select border-none about-border style-input w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>City</label>
                                                <input type="text" name="zip" placeholder="City">
                                            </div>
                                            <div class="styled-select hg-23 w-33"  :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>State</label>
                                                <select name="type">
                                                    <option value="" selected="selected">State</option>
                                                    <option value="New">State</option>
                                                    <option value="Used">State</option>
                                                </select>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="styled-select border-none about-border border-right-none style-input w-33">
                                                <label>Zip</label>
                                                <input type="text" name="zip" placeholder="Zip">
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>Email</label>
                                                <input type="text" name="zip" placeholder="Email">
                                            </div>
                                            <div class="styled-select border-none about-border style-input w-33" :class="$mq === 'mobile' ? '' : 'border-right'">
                                                <label>Shipping Country*</label>
                                                <input type="text" name="zip" placeholder="Shipping Country*">
                                            </div>
                                            <div class="styled-select border-none about-border border-right-none style-input w-33">
                                                <label>Phone</label>
                                                <input type="text" name="zip" placeholder="Phone">
                                            </div>
                                                <div class="styled-select border-none border-right-none style-input w-100">
                                                <label>Comment</label>
                                                <input type="text" name="zip" placeholder="Comment">
                                            </div>
                                        </div>
                                        <div class="about-news">
                                            <label class="con about-con">
                                                Send me Cardesta.com's monthly e-newsletter featuring tips and tricks to help sellmore cars online.
                                                <input type="checkbox" name="features">
                                                <span class="checkmark about-checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="type-btn mobile-type-btn">
                                            <input type="button" class="button" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
        <div v-if="$mq !== 'mobile'" class="google-map">
            <img src="/images/map.png">
            <div class="cardesta-info">
                <img src="/images/logo-black.png">
                <div><i class="fas fa-map-marker-alt"></i><span>4980 Centennial Blvd, Colorado Springs, CO 80919, США</span></div>
                <div><i class="fas fa-phone revert-symbol"></i><span>phone-receiver copy 2</span></div>
                <div><i class="fas fa-envelope"></i><span>hello@cardesta.com</span></div>
                <ul class="list-one mg-0">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div v-else class="">
            <div class="cardesta-info">
                <img src="/images/logo-black.png">
                <div><i class="fas fa-map-marker-alt"></i><br /><span>4980 Centennial Blvd, Colorado Springs, CO 80919, США</span></div>
                <div><a href="#" class="dot-link">Look at the map</a></div>
                <div><i class="fas fa-phone revert-symbol"></i><br /><span>phone-receiver copy 2</span></div>
                <div><i class="fas fa-envelope"></i><br /><span>hello@cardesta.com</span></div>
                <ul class="list-one mg-0">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
	</div>
</template>

<style>
.google-view.pd-30 {
    padding-bottom: 10px;
}
.mt-130 {
    margin-top: 130px;
}
.revert-symbol {
    transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    -ms-transform: scaleX(-1);
}
.google-map {
    border-top: 11px solid #41abed;
    margin-top: 100px;
}
.cardesta-info {
    width: 445px;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    position: absolute;
    right: 15%;
    margin-top: -340px;
    background-color: white;
}
.cardesta-info img {
    width: auto !important;
    margin-bottom: 20px;
}
.cardesta-info i {
    font-size: 14px;
    color: #41abed;
    margin-bottom: 26px;
    margin-right: 11px;
}
.list-one.mg-0 {
    margin: 0;
}

.google-map img {
    width: 100%;
}
ul.list-one.mg-0 li i {
    font-size: 14px;
    color: #000;
    padding-left: 13px;
    margin-top: 13px;
}
ul.list-one.mg-0 li {
    background: #f3f3f3;
}

.mw-750 {
    max-width: 750px;
    width: 100%;
    display: table;
    margin: auto;
}
.mt-30 {
    margin-top: 30px;
}
.w-33 {
    width: 33.3% !important;
}
.hg-23 select {
    height: 23px !important;
}
.dealer-box {
	max-width: 750px;
	margin: auto;
	width:100%;
}
.text-left {
    text-align: left;
}
.text-left h5 {
    text-transform: uppercase;
    color: #000;
    font-size: 20px;
    font-weight: 700;
    font-family: 'Oswald', sans-seri
}
@media(max-width:1280px){
	body a.nav-link {
		padding: 9px 5px !important;
	}

}
@media(max-width:991px){
	.dealer-box {
		padding-top: 90px;
	}

	.dealer-box .block-section h2 {
		margin-bottom: 10px;
	}
	
	.dealer-box .match-left {
		max-width: 100% !important;
		flex: 0 0 100%;
	}

	
	.dealer-box .match-right {
		max-width: 100% !important;
		flex: 0 0 100%;
		text-align: center;
	}
}

@media (max-width:767px){
	.dealer-box {
		padding-top: 60px;
	}
    .mb-dealer-box {
        width: 80%;
    }
    .styled-select.w-33 {
        width: 100% !important;
    }
    div.cardesta-info {
        width: 100%;
        border-radius: 0;
        padding: 30px;
        box-shadow: none;
        position: relative;
        right: 0;
        margin-top: 50px;
        text-align: center;
    }
    .cardesta-info img {
        width: auto !important;
        margin-bottom: 20px;
    }
    .cardesta-info i {
        font-size: 14px;
        color: #41abed;
        margin-bottom: 13px;
        margin-right: 11px;
        margin-top: 20px;
    }
    .list-one.mg-0 {
        margin: 0;
        margin-top: 20px;
    }
    .cardesta-info .dot-link{
        border-bottom: 1px dotted #41abed;
    }
    .mt-130 {
        margin-top: 130px;
        padding-right: 0;
        padding-left: 0;
    }
    .srh-box.mobile-contact-dialog {
        border-radius: 0;
        box-shadow: none;
    }
    .mobile-form-section {
        border-radius: 10px 10px 0 0 !important;
        border: none !important;
        border-bottom: 1px solid #ccc !important;
    }
    .mobile-type-btn input {
        border-radius: 0 0 10px 10px;
    }
    .mobile-form {
        border-radius: 10px;
        border: 1px solid #ccc;
    }
}

</style>

<script>
import AppBanner from './BannerComponent.vue';
export default {
	components: {
		AppBanner,
    },
    mounted() {
        $(".mobile-footer").hide();
    }
};
</script>
