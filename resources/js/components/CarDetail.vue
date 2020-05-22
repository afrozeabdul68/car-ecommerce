<template>
<div class="slider-car">
    <div class="container">
        <app-banner></app-banner>
        <!-- pagination -->
        <div class="row site-pagination site-pagination2" v-if="product">
            <div class="col-lg-12 block-section">
                <h2>{{product.year}} {{product.make}} {{product.model}} {{product.drivetrain}}</h2>

                <nav aria-label="Page navigation example">
                    <div v-if="$mq !== 'mobile'" class="tl-fl-left">
                        <ul class="pagination pagination2">
                            <li class="page-item prev"><a href="/search" class="page-link"><i class="fas fa-arrow-left"></i>&nbsp;All Results</a></li>
                        </ul>
                    </div>
                    <div v-else class="mb-blue-panel">
                        <a href="/search" class="pd-14"><i class="fas fa-arrow-left"></i>&nbsp;All Results</a>
                    </div>
                    <ul class="pagination pagination2">
                        <li class="page-item prev"><a :class="prev_vin == '' ? 'disabled' : ''" href="#" @click.prevent="getPrevNextProduct(prev_vin)" class="page-link"><i class="fas fa-chevron-left left"></i>Prev</a></li>
                        <li class="page-item next"><a :class="next_vin == '' ? 'disabled' : ''" href="#" @click.prevent="getPrevNextProduct(next_vin)" class="page-link">Next<i class="fas fa-chevron-right right-pagi"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Car Detail -->
        <div class="desktop-version" v-if="product">
            <div :class="$mq === 'desktop' ? 'row' : ''">
                <div class="col-lg-7 slider-img">
                    <div id="carousel-thumb" class="car_slider carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <div v-if="product.images.length > 0 && product.images[0].image !== ''">
                                <div v-for="(images, index) in product.images" class="carousel-item" :class="index == 0 ? 'active' : ''">
                                    <img class="d-block w-100" v-if="!images.original_url && images.image" :src="images.image" alt="First slide" @click="openModal();currentSlide(index + 1)" />
                                    <img class="d-block w-100" v-else-if="images.original_url && images.image" :src="images.original_url" alt="First slide" @click="openModal();currentSlide(index + 1)">
                                </div>
                            </div>
                            <div v-else class="carousel-item active">
                                <img class="d-block w-100" src="/images/no-car.png" alt="First slide">
                                <div class="em-img">Image Not Available</div>
                            </div>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a v-if="product.images.length > 0 && product.images[0].image !== ''" class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Prev</span>
                        </a>
                        <a v-if="product.images.length > 0 && product.images[0].image !== ''" class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <div class="row slider-thumbs">
                            <div class="col-lg-9">
                                <ol class="carousel-indicators">
                                    <li v-if="$mq !== 'mobile' && hidePreBtn()" @click="goPreSlide()" style="opacity: 1">
                                        <div class="cg-listingSearch-galleryPrev_67x50 prevLink btn-wrapper" style="width: 71px; height: 50px; box-sizing: border-box;"></div>
                                    </li>
                                    <li v-if="$mq !== 'mobile' && product.images.length > 0 && product.images[0].image !== '' && hideThumbnail(index + 1, product.images.length)" v-for="(images, index) in product.images" data-target="#carousel-thumb" :data-slide-to="index" :class="index == 0 ? 'active' : ''" @click="setActive(index)">
                                        <img class="d-block w-100 img-fluid" v-if="!images.original_url && images.image" :src="images.image">
                                        <img class="d-block w-100 img-fluid" v-else-if="images.original_url && images.image" :src="images.original_url">
                                    </li>
                                    <li v-if="$mq !== 'mobile' && hideNexBtn(product.images.length)" @click="goNexSlide()" style="opacity: 1">
                                        <div class="cg-listingSearch-galleryNext_67x50 nextLink btn-wrapper" style="width: 71px; height: 50px; box-sizing: border-box;"></div>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <!-- Reviews -->
                    <div class="col-lg-12 detail-box detail-new">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 dooler2">
                                <p><b>${{product.sellingprice.toLocaleString()}}</b><span>${{calculateprice}}/mo est</span></p>
                            </div>
                            <div class="col-lg-4 col-sm-4 dooler2">
                                <p><b>{{product.dealer.name.charAt(0).toUpperCase()}}{{product.dealer.name.slice(1)}}</b></p>
                            </div>
                            <div class="col-lg-4 col-sm-4 great-deals co">
                                <p><strong>{{product.dealer.address}}, {{product.dealer.state}}<br>
                                        {{product.miles.toLocaleString()}} miles away</strong></p>
                            </div>
                            <div class="col-lg-6 premium great-deals">
                                <span v-if="product.type === 'New'" class="w3-badge green1">{{product.type == "Used" ? "HIT" : "NEW"}}</span>
                                <span v-if="product.type === 'Used'" class="w3-badge orange1">{{product.type == "Used" ? "HIT" : "NEW"}}</span>
                                <a href="#" class="great_price" v-if="product.sellingprice && product.sellingprice <= product.below_price"><span><i class="fas fa-arrow-up"></i></span>Great Deal</a>
                                <a href="#" class="good_price" v-else-if="product.sellingprice && product.sellingprice <= product.average_price && product.sellingprice > product.below_price"><span><i class="fas fa-arrow-up"></i></span>Good Deal</a>
                                <a href="#" class="fair_price" v-else-if="product.sellingprice && product.sellingprice > product.above_price"><span><i class="fas fa-arrow-right"></i></span>Fair Price</a>
                            </div>
                            <div class="col-lg-6 google-view">
                            </div>
                            <div v-if="product.sellingprice && product.sellingprice > product.above_price" class="col-lg-6 mk-vl">
                                $3,000 below <br />
                                CarDesta Market Value
                            </div>
                        </div>
                        <div class="col-lg-6 google-view">
                            <div class="reviws reviw">
                                <!-- <ul>
                                    <li style="color:#f57325">4.9</li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li class="fade" ><i class="fas fa-star"></i></li>
                                    <li><span>593 Google Reviews</span></li>
                                </ul>-->
                                <a v-if="product.dealer.call_tracking_no !== ''" class="mob-btn" :href="'tel:+1' + product.dealer.call_tracking_no">{{product.dealer.call_tracking_no}}</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Reviews -->
                    <div class="row wd-cadilac">
                        <div class="col-lg-12">
                            <h3>Basics <span class="esca">{{product.year}} {{product.make}} {{product.model}} {{product.drivetrain}}</span></h3>
                        </div>
                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b1.png" alt="trans">
                                </div>
                                <p>Location<br><span class="spring">{{product.dealer.address}}, {{product.dealer.state}}<br>
                                        {{product.miles.toLocaleString()}} miles away</span></p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b2.png" alt="trans">
                                </div>
                                <p>Price<br><span class="spring">${{product.sellingprice.toLocaleString()}}</span></p>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b3.png" alt="trans">
                                </div>
                                <p>Engine<br><span class="spring">{{product.engine_description}}</span></p>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b4.png" alt="trans">
                                </div>
                                <p>Mileage:<br><span class="spring">{{product.miles.toLocaleString()}} mi</span></p>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b5.png" alt="trans">
                                </div>
                                <p>Drivertrain:<br><span class="spring">{{product.drivetrain}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b6.png" alt="trans">
                                </div>
                                <p>Fuel Type:<br><span class="spring">{{product.fuel_type}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/trans.png" alt="trans">
                                </div>
                                <p>Engine:<br><span class="spring">{{product.transmission}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b8.png" alt="trans">
                                </div>
                                <p>City MPG:<br><span class="spring">{{product.citympg}} MPG City<br>
                                        {{product.highwaympg}} MPG Highway</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b9.png" alt="trans">
                                </div>
                                <p>Interior Color:<br><span class="spring">{{product.interiorcolor}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b9.png" alt="trans">
                                </div>
                                <p>Exterior Color:<br><span class="spring">{{product.exteriorcolor}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b10.png" alt="trans">
                                </div>
                                <p>Stock #:<br><span class="spring">{{product.stock}}</span></p>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="basics-box">
                                <div class="basics-image">
                                    <img src="/images/b11.png" alt="trans">
                                </div>
                                <p>VIN:<br><span class="spring">{{product.vin}}</span></p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- contact form box -->
                <div class="col-lg-5 con-deal">
                    <div class="contact-delar">
                        <div class="contact-heading">
                            <div class="clearfix">
                                <div style="float:right;">
                                    <div id="dealerPhoneNumber" class="cg-listingDetail-phone">
                                        <i class="glyphicon glyphicon-phone"></i> {{product.dealer.call_tracking_no}}
                                    </div>
                                </div>
                                <h3>Contact Dealer </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 f-input">
                                <input class="delar" type="text" placeholder="First Name">
                            </div>
                            <div class="col-lg-6">
                                <input class="delar" type="text" placeholder="Last Name">
                            </div>
                            <div class="col-lg-6 f-input">
                                <input class="delar" type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-6">
                                <input class="delar" type="text" placeholder="Phone">
                            </div>
                            <div class="col-lg-12 contact-check">
                                <select>
                                    <option>Check availability</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <textarea rows="4" cols="50" class="delar-msg">I'd like to know if this vehicle you have listed on CarDesta is still available.</textarea>
                                <!-- send popup -->
                                <!-- Button trigger modal -->
                                <button type="button" class="contact-f-btn" data-toggle="modal" data-target="#exampleModal" data-backdrop="static">
                                    Send Message
                                </button>
                                <!-- popup end -->
                            </div>
                        </div>
                        <!--row ending -->
                        <p>*By clicking "Send Message" I agree to CarDesta providing my contact information and conversation transcript, including all details provided therein, to the dealer and to receiving calls and text messages about vehicles from the dealer selling this car at the number provided (including via autodial or prerecorded calls) or via my other contact information provided above.</p>

                        <p>This consent does not require me to buy anything. I also acknowledge that I have read and agree to the <a class="term" href="#">Terms of Use</a> and <a class="term" href="#">Privacy Policy.</a> Standard message and data rates may apply.</p>
                    </div>
                    <div class="best-deal-box">
                        <a href="#" @click="openBestDealModal()">
                            <div class="deal">
                                <p>Get Best Deal</p>
                                <div class="deal-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                            </div>
                        </a>

                        <div class="clerx">
                            <p>Get free carfax</p>
                            <ul>
                                <li>
                                    <a :href="'https://www.carfax.com/processVin.cfx?partner=CDM_V&vin=' + product.vin">
                                        <img src="/images/clar.png" alt="clar">
                                    </a>
                                </li>
                                <li>
                                    <a :href="'https://vinrcl.safercar.gov/vin/?vin=' + product.vin">
                                        <img src="/images/nhtsa.png" alt="clar">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /contact form box -->
                <div class="col-lg-7 slider-img">

                    <!-- slider notes -->
                    <div class="row siller-notes">
                        <div class="col-lg-12">
                            <h3>Seller's Notes</h3>
                            <p :class="{see_more: seeMoreText}">{{product.description}}</p>

                            <button class="sell-btn" @click="seeMoreTextFunc()" id="myBtn">See More<i class="fas fa-chevron-down seel-down"></i></button>

                        </div>
                    </div>

                    <div class="row siller-notes siller-notes2">
                        <div class="col-lg-12">
                            <h3>All Features</h3>
                            <p :class="{see_more: seeMoreText1}"><b>These features are associated with this vehicle type.<br>
                                    Contact the dealer to confirm this specific vehicle has them.</b><br><br>
                                {{product.description}}</p>

                            <button class="sell-btn" @click="seeMoreText1Func()" id="myBtn2">See More<i class="fas fa-chevron-down seel-down"></i></button>

                        </div>
                    </div>

                    <!-- homelinks -->
                    <div class="row home-links">
                        <div class="col-lg-4 link-list" v-for="category in linkCategories.categories">
                            <h5>{{category.category}}</h5>
                            <ul>
                                <li v-for="link in category.sub_link_categories"><a :href="link.link"><i class="fas fa-check home-c"></i>{{link.category}}</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row qus">
                        <div class="col-lg-12">
                            <h3>Have a question?</h3>
                            <a href="#" @click="openContactModal">Contact Seller</a>
                            <p>Get answers, see the car, or find a good time for a test drive. Take the next step and contact the seller.</p>
                        </div>
                    </div>

                    <div class="row pay-cal">

                        <div class="col-lg-12 down-pay">
                            <h3><span>//</span>Payment Calculator</h3>
                        </div>
                        <div class="col-lg-12 down-border">
                            <div class="row">
                                <div class="col-lg-6 down">
                                    <label>Down Payment:</label><br>
                                    <input class="pay-i" name="downpayment" v-model="downpayment" type="text">
                                </div>
                                <div class="col-lg-6 term" @click="calculatePrice()">
                                    <span>Term:</span>
                                    <ul>
                                        <li><input class="r-btn" id="terms_36" type="radio" v-model="terms" name="terms" value="36" @click="calculatePrice(36)"><label for="terms_36"> 36</label></li>
                                        <li><input class="r-btn" id="terms_48" type="radio" v-model="terms" name="terms" value="48" @click="calculatePrice(48)"><label for="terms_48"> 48</label></li>
                                        <li><input class="r-btn" id="terms_60" type="radio" v-model="terms" name="terms" value="60" @click="calculatePrice(60)"><label for="terms_60"> 60</label></li>
                                        <li><input class="r-btn" id="terms_72" type="radio" v-model="terms" name="terms" value="72" @click="calculatePrice(72)"><label for="terms_72"> 72</label></li>
                                    </ul>
                                </div>
                                <div class="accurate">
                                    <h6>Get a more accurate payment estimate by adding more details.</h6>
                                    <a href="#">More Details</a>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 estimate">
                            <a href="#" @click.prevent="calculatePrice()">Calculate Estimate</a>
                            <p><span><b>${{calculateprice}}</b>/ month</span></p>
                        </div>

                        <div class="col-lg-12 content">
                            <p>Title, other fees, and incentives are not included in this calculation, which is an estimate only. Monthly payment estimates are for illustrative purposes only and do not represent a financing offer from the seller. Other taxes may apply.</p>
                        </div>

                    </div>

                    <!-- test drive section -->

                    <div class="row test-drive">
                        <div class="col-lg-12">
                            <h3>Ready For a Test Drive?</h3>
                            <a class="td-btn" href="#" @click.prevent="openContactModal">Contact Seller</a><br>
                            <a href="#">Shop other New 2019 Buick Envisions</a>
                            <p>The information on vehicles provided in this service is supplied by the seller or other third parties; Cars.com is not responsible for the accuracy of such information. Cars.com provides this service and materials without representation or warranties of any kind, either expressed or implied.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Photo Viewer-->
    <div ref="photoViewer" :class="$mq === 'mobile' ? 'mobile-modal' : 'modal'">
        <div :class="$mq !== 'mobile' ? 'modal-content' : ''">
            <span v-if="$mq !== 'mobile'" class="close cursor" @click="closeModal()">&times;</span>
            <div v-else class="mb-blue-panel1">
                <a href="#" @click.prevent="closeModal()" class="pd-14"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
            </div>
            <div v-if="product.images.length > 0 && product.images[0].image !== ''" v-for="(images, index) in product.images" :class="$mq === 'mobile' ? '' : 'mySlides'">
                <div v-if="$mq !== 'mobile'" class="numbertext">{{index + 1}} / {{product.images.length}}</div>
                <img :class="$mq !== 'mobile' ? 'd-block w-100 img-fluid' : 'd-block w-100 img-fluid mt-10'" v-if="!images.original_url && images.image" :src="images.image" width="100%">
                <img :class="$mq !== 'mobile' ? 'd-block w-100 img-fluid' : 'd-block w-100 img-fluid mt-10'" v-else-if="images.original_url && images.image" :src="images.original_url" width="100%">
            </div>

            <a v-if="$mq !== 'mobile'" class="prev" @click="plusSlides(-1)">&#10094;</a>
            <a v-if="$mq !== 'mobile'" class="next" @click="plusSlides(1)">&#10095;</a>

            <div class="caption-container">
                <p id="caption"></p>
            </div>
        </div>
    </div>

    <div ref="bestDealModal" :class="$mq !== 'mobile' ? 'modal' : 'mobile-modal'">
        <div class="modal-content">
            <span class="close cursor" @click="closeBestDealModal()">&times;</span>
            <div class="contact-delar">
                <div class="contact-heading">
                    <ul>
                        <li>
                            <h4>Get Best Price</h4>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-6 f-input">
                        <input class="delar" type="text" placeholder="First Name">
                    </div>
                    <div class="col-lg-6">
                        <input class="delar" type="text" placeholder="Last Name">
                    </div>
                    <div class="col-lg-6 f-input">
                        <input class="delar" type="text" placeholder="Email">
                    </div>
                    <div class="col-lg-6">
                        <input class="delar" type="text" placeholder="Phone">
                    </div>
                    <div class="col-lg-12">
                        <textarea rows="4" cols="50" class="delar-msg">I am interested in this vehicle. I would like to come look at it but need the best price possible.</textarea>
                        <!-- send popup -->
                        <!-- Button trigger modal -->
                        <button type="button" class="contact-f-btn" data-toggle="modal" data-target="#exampleModal" data-backdrop="static">
                            Get best price now - Check Availability
                        </button>
                        <!-- popup end -->
                    </div>
                </div>
                <!--row ending -->
                <p>*By clicking "Get best price now - Check Availability" I agree to CarDesta providing my contact information and conversation transcript, including all details provided therein, to the dealer and to receiving calls and text messages about vehicles from the dealer selling this car at the number provided (including via autodial or prerecorded calls) or via my other contact information provided above.</p>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div :class="$mq !== 'mobile' ? 'modal' : 'mobile-modal'" ref="contactModal">
        <div class="modal-content">
            <span class="close cursor" @click="closeContactModal()">&times;</span>
            <contact-form :product="product"></contact-form>
        </div>
    </div>
</div>
</template>

<style>
.mt-10 {
    margin-top: 10px;
}
.em-img {
    color: #000;
    font-weight: 700;
    text-align: center;
    bottom: 50%;
    position: absolute;
    width: 100%;
    z-index: 1;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
    line-height: 1.2;
    font-size: 1.6rem;
}
.mk-vl {
    font-size: 11px;
    margin-left: 55px;
}
.mb-blue-panel {
    padding-left: 14px;
    text-align: left;
    background-color: #00a0dd;
    margin-top: 16px;
    margin-bottom: -15px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.mb-blue-panel1 {
    padding-left: 14px;
    text-align: left;
    background-color: #00a0dd;
    padding-top: 5px;
    padding-bottom: 5px;
}
.mb-blue-panel1 a {
    color: white;
}
.mb-blue-panel a {
    color: white;
}
.tl-fl-left {
    float: left;
    text-align: left;
}
.cg-listingDetail-madLibWrap {
    line-height: 32px;

}

#listingDetailFauxPage .cg-listingDetail-formWrap {
    font-size: 14px;
}

.cg-listingDetail-phone {
    margin-top: 2px;
    font-size: 17px;
}

.test-deal {
    margin-left: 69px;
    font-size: 11px;
}

.display-none {
    display: none;
}

.btn-wrapper {
    border: 2px solid #666;
    margin: auto;
}

.filter-result {
    padding: 50px 0;
}

.slider-car {
    margin-top: 130px;
    width: 100%;
    display: inline-block;
    text-align: center;
}

.row.slider-thumbs .col-lg-3 {
    padding-left: 0;
}

.car_slider .carousel-indicators {
    position: relative;
    justify-content: inherit;
    margin: 0;
    display: inline-block;
}

.pagination2 .page-item:last-child {
    display: block !important;
    color: #165a84;
}

.pagination2 .page-item:first-child .page-link {
    color: #165a84;
}

.pagination2 .page-item:last-child .page-link {
    color: #165a84;
}

.pagination2 .page-item:first-child {
    float: left;
    display: block !important;
    color: #165a84;

}

ul.pagination2 li {
    display: none !important;
}

ul.pagination2 {
    width: auto;
}

.row.site-pagination2 {
    text-align: center;
    margin-top: 21px;
    margin-bottom: 40px;
}

.row.site-pagination2 ul li {
    width: 130px;
}

.breadcrum h6 {
    color: #666666;
    font-size: 12px;
    margin: 0;
}

.breadcrum span {
    padding: 0 5px;
}

.site-pagination2 h2 {
    color: #333333;
    font-size: 54px;
    margin: 0px 0 20px 0;
    text-transform: uppercase;
}

.slider-thumbs {
    text-align: left;
}

.car_slider .carousel-indicators li {
    width: 85px;
    height: auto;
    display: inline-block;
}

/* Video Button */
.video-btn {
    display: inline-block;
    background: #fde3d3;
    padding: 20px 0px;
    margin-top: 8px;
    border-radius: 6px;
    color: #f57325;
    font-size: 16px;
    width: 100%;
    text-align: center;
    text-decoration: none;
    border: navajowhite;
}

button.video-btn:focus {
    outline: none !important;
}

.video-btn:hover {
    background: #f57325;
    color: #fff;
}

.reviw .fade:not(.show) {
    opacity: 1;
    padding-right: 0px !important;
}

.reviw span {
    font-size: 12px !important;
}

i.fas.fa-play {
    padding-right: 10px;
}

a.video-btn i {
    padding-right: 10px;
}

/* Reviews */
.google-view {
    padding-left: 0;
    text-align: right;
}

.reviw ul {
    padding-top: 15px;
}

.premium {
    padding-top: 15px !important;
}

.co {
    border: none !important;
}

.great-deals {
    border-top: 1px solid #ebebeb;
    padding-top: 10px;
    padding-left: 0;
}

.great-deals.co {
    text-align: right;
    margin-bottom: 10px;
}

.green1 {
    background: #009a00;
    padding: 4px 15px;
    display: inline-block;
    color: #fff !important;
    border-radius: 5px;
    font-size: 14px;
    margin-right: 10px;
}

.orange1 {
    background: orange;
    padding: 4px 15px;
    display: inline-block;
    color: #fff !important;
    border-radius: 5px;
    font-size: 14px;
    margin-right: 10px;
}

.slider-car .detail-box {
    margin-top: 15px;
    text-align: left;
}

.col-lg-6.col-sm-6.dooler2 {
    padding-left: 0;
    margin-bottom: 10px;
}

.dooler2 b {
    color: #333333;
    font-size: 20px;
    padding-right: 7px;
}

.detail-box span {
    color: #2374e2;
    font-size: 14px;
}

.detail-box p {
    color: #333333;
    font-size: 14px;
    margin-bottom: 2px;
}

.great-deals a {
    color: #fff;
    background: #a9d600;
    padding: 3px 10px;
    display: inline-block;
    border-radius: 4px;
    font-size: 14px;
    margin-bottom: 10px;
    text-decoration: none;
}

.detail-box a.good_price {
    background: #e7c127;
}

.detail-box a.fair_price {
    background: #bfbfbf;
}

.reviws .mob-btn {
    display: none;
}

/* form box */
.contact-delar {
    background: #fff;
    padding: 30px;
    box-shadow: 0 0px 15px 0 #0000001a;
    text-align: left;
    border-radius: 10px
}

.contact-delar h4 {
    text-transform: uppercase;
    font-size: 18px;
}

.contact-heading ul li {
    display: inline-block;
    list-style: none;
}

.contact-heading ul {
    margin: 0;
    padding: 0;
}

.contact-heading ul li h4 {
    padding-right: 120px;
    margin: 0;
}

.contact-heading {
    border-bottom: 1px solid #ebebeb;
    margin-bottom: 25px;
    padding-bottom: 20px;
    margin-top: 10px;
}

.contact-heading span {
    font-size: 20px;
    color: #033333;
    font-weight: 500;
}

input.delar {
    border: 1px solid #cccccc;
    width: 100%;
    height: 40px;
    margin-bottom: 10px;
    padding-left: 10px;
    font-size: 14px;
    color: #333333;
    border-radius: 4px;

}

input.delar:focus {
    outline: none;
}

.delar-msg {
    border: 1px solid #cccccc;
    width: 100%;
    height: 115px;
    margin-bottom: 10px;
    padding-left: 10px;
    font-size: 14px;
    color: #333333;
    border-radius: 4px;
    font-weight: 500;

}

.delar-msg:focus {
    outline: none;
}

.delar::-webkit-input-placeholder {
    /* Edge */
    color: red;
    color: #3333337d;
}

.contact-check select {
    border: 1px solid #cccccc;
    width: 100%;
    height: 40px;
    margin-bottom: 10px;
    padding-left: 10px;
    font-size: 14px;
    color: #3333337d;
    border-radius: 4px;
    font-weight: 500;

}

.f-input {
    padding-right: 0px;
}

.contact-delar .contact-f-btn {
    text-decoration: none;
    color: #333333;
    text-align: center;
    width: 100%;
    display: inline-block;
    background: #e0ebf6;
    border-radius: 5px;
    line-height: 45px;
    font-weight: 500;
    font-size: 14px;
    margin-bottom: 25px;
    border: none;
}

.contact-delar .contact-f-btn:hover {
    background: #165a84;
    color: #fff;
    outline: none;
}

.contact-f-btn:focus {
    outline: none !important;
}

.contact-delar p {
    font-size: 12px;
    color: #3333337d;
    font-weight: 500;
    line-height: 18px;
    padding: 0 5px;

}

/* deal box */
.best-deal-box {
    background: #f7f7f7;
    padding: 30px 0;
    border-radius: 10px;
    margin-top: 20px;
    border: 1px solid #ebebeb;
}

.deal {
    background: #155e87;
    width: 90%;
    margin: 0 auto;
    border-radius: 30px;
    color: #fff;
    height: 50px;
    position: relative;
}

.deal p {
    margin: 0;
    font-size: 14px;
    line-height: 50px;
}

.deal-icon i {
    margin: 3px 0 0 0;
    line-height: 30px;

}

.deal-icon {
    height: 35px;
    width: 35px;
    border-radius: 20px;
    background: #fff;
    position: absolute;
    top: 7px;
    left: 7px;
    color: #165d86;
}

.clerx {
    margin-top: 20px;
}

.clerx ul {
    margin: 0;
    padding: 0;
}

.clerx ul li {
    display: inline-block;
    list-style: none;
    margin-right: 30px;
}

.clerx p {
    font-size: 14px;
    font-weight: 500;
    color: #333333;
}

/* basic box */
.basics-box p {
    overflow: hidden;
    padding-left: 20px;
    font-size: 14px;
    color: #333333;
}

.basics-image img {
    float: left;
}

.basics-box {
    text-align: left;
}

span.spring {
    font-size: 14px;
    font-weight: 600;
    line-height: 4px;
    color: #333333;
}

.mob-version {
    display: none;
}

.wd-cadilac {
    margin-top: 60px;
    text-align: left;
}

.row.wd-cadilac h3 {
    font-size: 20px;
    margin-bottom: 40px;
    display: inline-block;
    text-transform: uppercase;
}

.wd-cadilac h3 span {
    color: #999999;
}

.row.siller-notes h3 {
    margin-bottom: 30px;
    font-size: 20px;
    text-transform: uppercase;
}

.row.siller-notes {
    text-align: left;
    margin-top: 70px;

}

.sell-btn {
    background: transparent;
    display: inline-block;
    text-align: center;
    width: 100%;
    text-decoration: none !important;
    line-height: 50px;
    border: 2px solid #e0ebf6;
    color: #333333;
    font-size: 14px;
    margin: 5px 0 60px;
    font-weight: 500;
}

.row.siller-notes p {
    font-size: 14px;
}

.seel-down {
    position: relative;
    top: 2px;
    left: 8px;
}

.siller-notes2 {
    margin-top: 0px !important;
}

.link-list ul li {
    list-style: none;
    display: inherit;
    margin-bottom: 20px;
}

.link-list ul {
    margin: 0;
    padding: 0;
}

.link-list h5 {
    text-transform: uppercase;
    font-size: 14px;
    color: #333333;
    margin-bottom: 20px;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
}

.home-links {
    text-align: left;
}

.col-lg-4.link-list ul li a {
    color: #333333;
    font-size: 14px;
    text-decoration: none !important;
}

.home-c {
    padding-right: 10px;
    color: #155c86;
}

.col-lg-4.link-list {
    margin-bottom: 30px;
    padding: 0 14px;
}

/* qus */

.row.qus h3 {
    text-transform: uppercase;
    margin-bottom: 20px;
    font-size: 20px;

}

.col-lg-6.term span {
    padding-bottom: 10px;
    display: inherit;
}

.col-lg-6.down label {
    margin-bottom: 10px;
}

.qus {
    border-top: 1px solid #ebebeb;
    padding-top: 47px;
    padding-bottom: 47px;
}

.qus a {
    text-decoration: none;
    background: #e0ebf6;
    width: 100%;
    display: inline-block;
    line-height: 50px;
    font-size: 14px;
    font-weight: 500;
    color: #333333;
    border-radius: 4px;
}

.qus p {
    font-size: 12px;
    margin-top: 15px;
    color: #999999;
    font-weight: 400;
}

/* payment-box */
.pay-cal span {
    color: #41abed;
    padding-right: 10px;
}

.pay-cal {
    text-align: left;
    background: #f7f7f7;
    padding: 40px 0 20px 0;
    border: 1px solid #ebebeb;
}

.down-pay h3 {
    padding-bottom: 30px;
}

.down-border {
    border-top: 1px solid #ebebeb;
    padding-top: 40px;
    padding: 30px 30px 20px 30px;
}

.down-pay {
    padding: 0px 30px;
}

input.pay-i {
    border: 1px solid #165a84;
    height: 60px;
    width: 100%;
    border-radius: 6px;
    color: #165a84;
    font-size: 14px;
    font-weight: 600;
    padding-left: 20px;
}

input.pay-i:focus {
    outline: none;
}

.pay-cal label {
    font-size: 14px;
    color: #333333;
    font-weight: 500;
    margin: 0;
}

.col-lg-6.term ul li {
    list-style: none;
    display: inline-block;
    margin-left: -7px !important;
}

.col-lg-6.term ul {
    padding: 0;
    margin: 0;
}

input.r-btn {
    visibility: hidden;
}

.term ul li label {
    border: 1px solid #ebebeb;
    border-radius: 6px;
    color: #165a84;
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
}

.term ul li label:hover {
    background: #165a84;
    color: #fff;
}

.term ul li label:focus {
    margin: 0;
    width: 60px;
    height: 60px;
    background: #165a84;
    color: #fff !important;
}

.term span {
    padding-left: 12px;
    padding-bottom: 10px;
    font-size: 14px;
    color: #333333 !important;
    font-weight: 500;
}

.down-border h6 {
    color: #999999;
    font-size: 12px;
    margin-top: 10px;
    margin-bottom: 0;

}

.accurate a {
    font-size: 14px;
    color: #165a84;
    text-decoration: none;
}

.accurate {
    padding-left: 15px;
}

.col-lg-12.estimate {
    border-top: 1px solid #ebebeb;
    padding: 20px 30px 20px 30px;
}

.col-lg-12.estimate a {
    font-size: 14px;
    color: #333333;
    font-weight: 500;
    display: inline-block;
    background: #e0ebf6;
    line-height: 50px;
    padding: 0 30px;
    border-radius: 6px;
    text-decoration: none;
    margin-right: 30px;
}

.estimate p {
    float: right;
    width: 66%;
    margin-top: 4px;
}

.estimate b {
    font-weight: bold;
    font-size: 28px;
    color: #165a84;
    margin-right: 10px;
}

.col-lg-12.estimate span {
    color: #333333;
    font-size: 14px;

}

input.r-btn[type="radio"]:checked+label {
    background: #165a84;
    color: #fff;
}

col-lg-12.content {
    border-top: 1px solid #ebebeb;
    padding: 30px 30px 0 40px;
}

.col-lg-12.content {
    border-top: 1px solid #ebebeb;
    padding: 20px 30px 0px 30px;
}

.col-lg-12.content p {
    font-size: 12px;
    color: #999999;
    font-weight: 400;
}

/* test drive */
.row.test-drive h3 {
    text-transform: uppercase;
    margin-bottom: 20px;
    font-size: 20px;
}

.row.test-drive {
    margin: 70px 0;
}

.test-drive .td-btn {
    text-decoration: none;
    background: #165a84;
    width: 60%;
    display: inline-block;
    line-height: 50px;
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    border-radius: 4px;
    margin-bottom: 50px;
}

.test-drive a {
    font-size: 14px;
    color: #165a84;
    text-decoration: none;
    margin-bottom: 20px;
    display: inline-block;
}

.row.test-drive p {
    color: #999999;
    font-size: 12px;
    margin: 0;
    font-weight: 400;
}

.pagination2 .page-item .page-link.disabled {
    pointer-events: none;
    cursor: default;
    color: #e1e1e1;
    border-color: #e1e1e1;
    background: #f8fafc;
}

p.see_more {
    max-height: 150px;
    overflow: hidden;
}

/* best deal modal style start*/
.contact-modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 160px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

.contact-modal .close {
    color: white !important;
    font-size: 41px !important;
    opacity: 1 !important;
}

/* best deal modal style end*/
/* modal classes*/
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 240px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}
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
/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    width: 40%;
    max-width: 1200px;
}

/* The Close Button */
.close {
    color: white;
    position: absolute;
    top: -35px;
    right: -35px;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #999;
    text-decoration: none;
    cursor: pointer;
}

.mySlides {
    display: none;
}

.cursor {
    cursor: pointer;
}

/* Next & previous buttons */
.modal .prev,
.modal .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
    background-color: rgba(255, 255, 255, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
}

.modal img {
    margin-bottom: -4px;
}

.caption-container {
    text-align: center;
    background-color: black;
    padding: 2px 16px;
    color: white;
}

.demo {
    opacity: 0.6;
}

.active {
    opacity: 1;
}

.modal .active,
.modal .demo:hover {
    opacity: 1;
}

img.hover-shadow {
    transition: 0.3s;
}

.hover-shadow:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.carousel-inner img {
    cursor: pointer !important;
}

.cg-listingDetailGallery-wrap {
    display: inline-block;
    cursor: pointer;
    margin: 2px 0;
    border: 2px solid #333;
    overflow: hidden;
    text-align: center;
    vertical-align: middle;
    zoom: 1;
    border: 2px solid #666;
}

.cg-listingSearch-galleryPrev_67x50 {
    background-position: -120px 0;
    width: 67px;
    height: 50px;
    background-image: url("https://www.cargurus.com/gfx/cg/sprites/listingSearch/listingSearchSpriteNew.png");
    background-repeat: no-repeat;
}

.cg-listingSearch-galleryNext_67x50 {
    background-position: 0 -85px;
    width: 67px;
    height: 50px;
    background-image: url("https://www.cargurus.com/gfx/cg/sprites/listingSearch/listingSearchSpriteNew.png");
    background-repeat: no-repeat;
}

@media only screen and (max-width: 991px) {

    /* Modal Content */

    .mobile-modal .close {
        color: #2d2929 !important;
        top: 0px !important;
        right: 10px !important;
    }

    .modal-content {
        width: 100% !important;
    }

    /* The Close Button */
    .contact-modal .close {
        color: #2d2929 !important;
        top: 0px !important;
        right: 0px !important;
    }

    .test-drive a {
        margin-bottom: 40px;
    }

    .pay-cal {

        margin: 0 auto;
    }

    .down-pay {
        padding: 0px 20px;
    }

    .block-section {
        display: -webkit-box;
        display: -moz-box;
        /*display: flex;*/
        -webkit-box-orient: vertical;
        -moz-box-orient: vertical;
        box-orient: vertical;
    }

    .block-section h2 {
        -webkit-box-ordinal-group: 2;
        -moz-box-ordinal-group: 2;
    }

    .site-pagination2 h2 {
        font-size: 28px;
        margin: 0px 0 20px 0;
        text-transform: uppercase;
        padding: 0 20px;
    }

    .reviw .mob-btn {
        text-decoration: none;
    }

    .breadcrum h6 {
        display: none;
    }

    .row.site-pagination2 {
        padding: 0;
    }

    .slider-car {
        margin-top: 79px;
    }

    .contact-delar p {
        padding: 0;
    }

    .col-lg-6.term span {
        padding-bottom: 0;
    }

    .mob-version {
        display: block;
    }

    .dooler2 b {

        font-size: 28px;

    }

    .contact-heading span {
        display: none;
    }

    .estimate p {
        width: 100%;
        margin-top: 0;
        margin-bottom: 0;
    }

    .test-drive .td-btn {
        width: 100%;
    }

    .desktop-version {
        /*display: none;*/
    }

    ul.pagination2 {
        width: 100%;
        border-radius: 0 !important;
    }

    .pagination {
        border-radius: 9px;
        overflow: hidden;
        margin-top: 15px;
    }

    .pagination .page-item:first-child,
    .pagination .page-item:last-child {
        display: block;
        width: 50%;
    }

    .breadcrum h2 {

        font-size: 28px;
        margin: 10px 0;
    }

    .row.site-pagination2 {
        margin-top: 0;
        margin-bottom: 0px;
    }

    .google-view {
        padding: 0;
    }

    .con-deal {
        padding: 0;
    }

    .reviws .mob-btn {
        border-radius: 5px;
    }

    .reviws {
        text-align: center;
    }

    .great-deals {
        padding-top: 0px;
        border: none;
    }

    .car_slider .carousel-indicators li {
        width: 7px;
        border-radius: 70px;
        height: 0;
        margin-top: 10px;
    }

    .car_slider .carousel-indicators li img {
        display: block !important;
        width: 5px !important;
        height: 5px;
        border-radius: 10px;
    }

    .col-lg-6.col-sm-6.dooler2 p {
        padding-top: 0px;
    }

    .detail-new {
        box-shadow: none !important;
        margin-bottom: 20px;
    }

    .contact-heading ul li {
        display: inherit;
    }

    .contact-heading ul li h4 {
        padding-right: 0;
        margin: 0;
        text-align: center;
        width: 100%;
    }

    .contact-heading {
        border-bottom: none;
        margin-bottom: 25px;
        padding-bottom: 5px;
        margin-top: 10px;
    }

    .f-input {
        padding-right: 15px;
    }

    .col-lg-6.down {
        margin-bottom: 20px;
    }

    .col-lg-6.term ul li {
        list-style: none;
        display: inline-grid;
        margin-right: 7px;
        margin-left: 0 !important;

    }

    .term span {
        padding-left: 0;

    }

    .down-border {
        padding: 30px 20px;
    }

    .col-lg-12.estimate {
        padding: 20px 20px 20px 20px;
        text-align: center;
    }

    .content {

        padding: 20px 20px 0px 20px !important;
    }

    .col-lg-12.estimate a {
        width: 100%;
        margin-bottom: 10px;
        margin-right: 0;

    }

    .great-deals.co {
        text-align: right;
        margin-bottom: 0;
    }

    .reviws ul {
        padding: 18px 0 0 0;
    }

    .slider-img {
        padding-left: 15px;
        padding: 0;
    }

    .col-lg-4.link-list {
        margin-bottom: 30px;
        padding: 0 15px
    }

    .col-lg-6.col-sm-6.dooler2 {
        padding: 0;
        margin-bottom: 0;
    }

    .great-deals {
        padding-left: 0;
    }

    .col-lg-7.basics-cadilac {
        padding: 0;
    }

    .row.test-drive .col-lg-12 {
        padding: 0;

    }

    .great-deals.co {
        text-align: left;
        padding-top: 0;
        padding-bottom: 15px;
    }

    .detail-box p {
        color: #333333;
        font-size: 12px;

    }

    .car_slider .carousel-indicators {

        display: -webkit-box;
    }

    .car_slider .carousel-indicators li {
        display: inline-block;
    }

    .car_slider .col-lg-3.video-popup {
        display: none;
    }

    .reviw {
        border-top: 1px solid #ebebeb;
    }

    .modal-dialog3 {
        max-width: 96%;
    }

    .clerx ul li {

        margin-right: 10px;
    }

    .modal-header .close {
        right: 24px;
        top: 18px;
        color: #165a84 !important;
    }

    .modal-content2 {
        width: 100% !important;

    }

    .carousel-inner img {
        height: auto;
        cursor: pointer !important;
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
}
</style>

<script>
import AppBanner from './BannerComponent.vue';
import ContactForm from './ContactForm.vue'

export default {
    props: {
        products: {
            type: Object,
            required: false
        },
        vin: {
            type: String,
            required: true
        }
    },
    mounted() {
        this.getCarDetail();
        if (localStorage.products) {
            this.products = localStorage.products;
        }

        this.getCarDetail();
        this.getLinkCategories();
    },
    data() {
        return {
            product: '',
            terms: 60,
            next_vin: '',
            prev_vin: '',
            percentage: 3.99,
            calculateprice: 0,
            downpayment: 0,
            seeMoreText: true,
            seeMoreText1: true,
            slideIndex: 1,
            currentSlideNumber: 1,
            linkCategories: [],
        }
    },
    methods: {
        getCarDetail() {
            this.axios.get('/api/v2/get-car-detail/' + this.$route.params.vin).then((response) => {
                this.product = response.data;
                console.log(this.product);
                this.calculatePrice();
                this.prev_vin = this.getPrevVin(this.product.vin);
                this.next_vin = this.getNextVin(this.product.vin);

                this.fbTrackEvent(this.product);
            });
        },
        getLinkCategories() {
            this.axios.get("/api/v2/get-link-categories").then((response) => {
                this.linkCategories = response.data;
            });
        },
        calculatePrice(terms = '') {
            if (terms != '') {
                this.terms = terms;
            }
            let price = 0;
            price = (((this.percentage / 100) * this.product.sellingprice + this.product.sellingprice) - this.downpayment) / this.terms;
            this.calculateprice = price.toFixed(0);
        },
        getPrevNextProduct(vin) {
            this.axios.get('/api/v2/get-car-detail/' + vin).then((response) => {
                this.product = response.data;
                this.calculatePrice();
                this.prev_vin = this.getPrevVin(this.product.vin);
                this.next_vin = this.getNextVin(this.product.vin);
                this.$router.push({
                    name: 'cardetail',
                    params: {
                        vin: this.product.vin,
                        products: this.products
                    }
                });
            });
        },
        getPrevVin(vin) {
            let prev_vin = '';
            let data = this.products.data;
            $.each(data, function (key, value) {
                $.each(value, function (k, v) {
                    if (v == vin) {
                        if (key > 0) {
                            prev_vin = data[key - 1].vin;
                        }
                    }
                })
            });
            return prev_vin;
        },
        getNextVin(vin) {
            let next_vin = '';
            let data = this.products.data;
            $.each(data, function (key, value) {
                $.each(value, function (k, v) {
                    if (v == vin) {
                        if (key < (data.length - 1)) {
                            next_vin = data[key + 1].vin;
                        }
                    }
                })
            });
            return next_vin;
        },
        seeMoreText1Func(event) {
            if (this.seeMoreText1) {
                this.seeMoreText1 = false;
            } else {
                this.seeMoreText1 = true;
            }
        },
        seeMoreTextFunc(event) {
            if (this.seeMoreText) {
                this.seeMoreText = false;
            } else {
                this.seeMoreText = true;
            }
        },

        fbTrackEvent(product) {
            fbq('track', 'ViewContent', {
                content_type: 'vehicle',
                content_ids: [product.id],
                postal_code: product.zip,
                country: 'United States',
                make: product.make,
                model: product.model,
                year: product.year,
                state_of_vehicle: product.type,
                exterior_color: product.exteriorcolor,
                transmission: product.transmission,
                body_style: product.body,
                fuel_type: product.fuel_type,
                drivetrain: product.drivetrain,
                price: product.sellingprice,
                currency: 'USD'
            });
        },

        openModal() {
            this.$refs.photoViewer.style.display = "block";
        },

        closeModal() {
            this.$refs.photoViewer.style.display = "none";
        },
        openBestDealModal() {
            this.$refs.bestDealModal.style.display = "block";
        },

        closeBestDealModal() {
            this.$refs.bestDealModal.style.display = "none";
        },

        openContactModal() {
            this.$refs.contactModal.style.display = "block";
        },

        closeContactModal() {
            this.$refs.contactModal.style.display = "none";
        },

        plusSlides(n) {
            this.showSlides(this.slideIndex += n);
        },
        currentSlide(n) {
            if (this.$mq !== 'mobile') {
                this.showSlides(this.slideIndex = n);
            }
        },
        showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                this.slideIndex = 1
            }
            if (n < 1) {
                this.slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[this.slideIndex - 1].style.display = "block";
            dots[this.slideIndex - 1].className += " active";
            captionText.innerHTML = dots[this.slideIndex - 1].alt;
        },
        getLastSlideNumber(length) {
            return Math.ceil((length - 18) / 8 + 2);
        },
        getSlideNumber(index, length) {
            if (index === 1) {
                return 1;
            }
            return Math.ceil((index - 9) / 8 + 1 > this.getLastSlideNumber(length) ? this.getLastSlideNumber(length) : (index - 9) / 8 + 1);
        },
        hideThumbnail(index, length) {
            if (this.getSlideNumber(index, length) === this.currentSlideNumber) {
                return true;
            }
            return false;
        },
        hidePreBtn() {
            if (this.currentSlideNumber === 1) {
                return false;
            }
            return true;
        },
        hideNexBtn(length) {
            if (this.currentSlideNumber === this.getLastSlideNumber(length) || length === 0) {
                return false;
            }
            return true;
        },
        //hard coding....
        getSlideIndex(index, length) {
            if (this.getSlideNumber(index, length) == 1) {
                return index - 1;
            } else {
                if ((index - 9) % 8 == 0) {
                    return 8;
                } else {
                    return (index - 9) % 8;
                }
            }
        },
        goNexSlide() {
            this.currentSlideNumber++;
        },
        goPreSlide() {
            this.currentSlideNumber--;
        },
        setActive(index) {
            var element = document.querySelector('[data-slide-to="' + index + '"]');
            setTimeout(function () {
                element.classList.add("active");
            }, 100);
        }
    },
    watch: {
        products() {
            localStorage.products = this.products;
        }
    },
    components: {
        AppBanner,
        ContactForm
    }
};
</script>
