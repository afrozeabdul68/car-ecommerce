<template>
<div :class="$mq == 'mobile' ? 'carousel-inner1 about-carousel-inner1' : 'carousel-inner1 about-carousel-inner1'">
    <div :class="$mq == 'mobile' ? '' : 'col-md-6 about-form-slider-section'">
        <div class="srh-box about-dialog-bd">
            <div class="form-large-text">
                <h5>Join thousands of dealers that already receive connections</h5>
            </div>
            <div class="form-small-text">
                <h6>To get started for free or to learn about our premium packages,<br v-if="$mq !== 'mobile'" />call (877) 939-0002 or fill out the form below</h6>
            </div>
            <!-- Tab panes -->
            <div class="tab-content about-tab-content">
                <div id="home" class="tab-pane active"><br>
                    <div class="form-section">
                        <form>
                            <div class="form about-form">
                                <div class="styled-select border-none about-border style-input w-100">
                                    <label>Dealership Name</label>
                                    <input type="text" name="zip" placeholder="Dealership Name">
                                </div>
                                <div class="styled-select border-none about-border style-input" :class="$mq === 'mobile' ? '' : 'border-right'">
                                    <label>First Name</label>
                                    <input type="text" name="zip" placeholder="First Name">
                                </div>
                                <div class="styled-select border-none about-border style-input">
                                    <label>Last Name</label>
                                    <input type="text" name="zip" placeholder="Last Name">
                                </div>
                                <div class="styled-select border-none about-border style-input" :class="$mq === 'mobile' ? '' : 'border-right'">
                                    <label>Email</label>
                                    <input type="text" name="zip" placeholder="Email">
                                </div>
                                <div class="styled-select border-none about-border style-input">
                                    <label>Phone</label>
                                    <input type="text" name="zip" placeholder="Phone">
                                </div>
                                <div class="styled-select border-none about-border style-input" :class="$mq === 'mobile' ? '' : 'border-right'">
                                    <label>Zip</label>
                                    <input type="text" name="zip" placeholder="ZIP">
                                </div>
                                <div class="styled-select border-none border-right-none">
                                    <label>Used Inventory Size</label>
                                    <select name="type" @change="getMakesByType($event)">
                                        <option value="" selected="selected">Used Inventory Size</option>
                                        <option value="New">Used Inventory Size</option>
                                        <option value="Used">Used Inventory Size</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="mid-text">
                                Optional: Fill out more info for faster processing <i class="fas fa-chevron-down about-down"></i>
                            </div>
                            <div class="about-news">
								<label class="con about-con">
                                    Send me Cardesta.com's monthly e-newsletter featuring tips and tricks to help sellmore cars online.
                                    <input type="checkbox" name="features">
                                    <span class="checkmark about-checkmark"></span>
                                </label>
							</div>
                            <div class="type-btn">
                                <input type="button" class="button" :value="buttonText">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style>
.styled-select.border-right {
    border-right: 1px solid #ccc !important;
}
.about-dialog-bd {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.about-carousel-inner1 {
    position: relative !important;
}
.about-news {
    padding: 25px 0 0 0;
}

.about-con {
    font-size: 11px;
    text-align: center;
}

.about-checkmark {
    top: -1px;
    left: 7%;
    background-color: #fff;
    border: 1px solid #ccc;
}

.mid-text {
    text-align: center;
    color: #41abed;
    padding: 15px 0 20px 0;
    border-bottom: 1px solid #ccc;
}
.form-large-text h5 {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    font-family: 'Oswald', sans-serif;
    color: #333333;
    border-color: #fff #ebebeb #fff #ebebeb;
    text-align: center;
    padding-top: 25px;
}
.form-small-text h6 {
    font-size: 14px;
    font-family: 'Oswald', sans-serif;
    color: #999999;
    border-color: #fff #ebebeb #fff #ebebeb;
    text-align: center;
    margin-bottom: 25px;
    margin-top: 10px;
}
ul.nav.nav-tabs li {
    text-align: center;
}

.carousel-inner1 {
    margin: auto;
    max-width: 1270px;
}

.carousel-inner1 {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    z-index: 999;
}

.col-md-6.about-form-slider-section {
    margin: auto;
}

.styled-select {
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: 3px;

    overflow: hidden;
    position: relative;
}

.styled-select,
.styled-select select {
    width: 240px;
}

select:focus {
    outline: none;
}

.styled-select select {
    height: 34px;
    padding: 5px 0 5px 5px;
    background: transparent;
    border: none;

    /*hide default down arrow in webkit */
    -webkit-appearance: none;
}

@-moz-document url-prefix() {
    .styled-select select {
        width: 110%;
    }
}

.fa-chevron-down {
    position: absolute;
    top: 42px;
    right: 21px;
    font-size: 15px;
    color: #999999;
    z-index: 0;
}

.about-down {
    position: relative !important;
    top: 3px !important;
    right: -5px !important;
    color: #41abed;
}

.srh-box {
    background: #fcfcfc;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
}

select::-ms-expand {
    display: none;
}

:-o-prefocus, 
.selector {
    .styled-select {
        background: none;
    }
}

.nav-tabs {
    border-bottom: 1px solid #ebebeb;
}

ul.nav.nav-tabs li {
    width: 50%;
}

ul.nav.nav-tabs li a {
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
    font-family: 'Oswald', sans-serif;
    color: #c4c4c4;
    background: #f7f7f7;
    border-color: #fff #ebebeb #fff #ebebeb;
    padding: 18px 10px !important;
}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
    color: #000;
    background-color: #fff;
    border-bottom: 2px solid;
    border-color: #fff #fff #41abed #fff;
}

.styled-select select {
    width: 100%;
    float: left;
    border: none;
    padding: 0 10px;
    color: #165a84;
    font-weight: 600;
    line-height: 16px;
    height: 20px;
    position: relative;
    z-index: 9;
}

.form-section .form {
    width: 100%;
    display: inline-block;
    border: 1px solid #d7d7d7;
    border-radius: 10px;
    overflow: hidden;
}

.form-section .about-form {
    border-radius: 0px;
}

.styled-select label {
    width: 100%;
    font-size: 12px;
    color: #999999;
    text-align: left;
    margin: 0;
}

.styled-select.border-right-none {
    border-right: none !important;
}
.styled-select.about-border {
    border-bottom: 1px solid #d7d7d7 !important;
    border-radius: 0 !important;
}

.w-100 {
    width: 100% !important;
}

.tab-content {
    padding: 2px 10px 0px;
}
.about-tab-content {
    padding: 0 !important;
}
.type-btn {
    margin: 25px -26px 0;
}

.styled-select {
    width: 50%;
    float: left;
    border: none;
    padding: 15px 20px;
    border-bottom: 1px solid #d7d7d7;
    border-right: 1px solid #d7d7d7;
    background: #fff;
}

.type-btn .button {
    border: none;
    background: #41abed;
    width: 100%;
    display: inline-block;
    margin: 0;
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
    padding: 20px 0;
}

.type-btn .button:hover {
    background: #000;
}

.styled-select:nth-child(2n) {
    border-right: none;
}

.styled-select.border-none.style-input input {
    border: none;
    height: 20px;
    color: #165a84;
    margin: 0 0 0px 0 !important;
    display: inline-block;
    padding: 0 10px;
    font-weight: bold;
    width: 100%;
}

.styled-select.border-none.style-input input:focus {
    outline: 0;
    border-bottom: 1px solid #165a84;
}

@media (max-width:1130px) {
    .carousel-inner1 {
        position: relative;
        right: 0;
        top: 0%;
        transform: translateY(-50%);
        left: 0;
        z-index: 9;
        width: 95%;
        display: table;
    }
    .about-checkmark {
        left: 4%;
    }
    .col-md-5.form-slider-section {

        float: right;
        width: 100%;
        max-width: 100%;
        padding: 0;

    }

    header .col-lg-6.col-md-9 {
        padding: 0;
    }

    .type-btn {
        margin: 18px 0 0;
    }

    a.phone-btn i {
        background: rgba(255, 255, 255, 0.5);
        width: 32px;
        height: 32px;
        border-radius: 25px;
        line-height: 33px;
        text-align: center;
        margin-right: 5px;
        font-size: 13px;
    }

    a.phone-btn {
        font-size: 16px;
    }
}

@media (max-width: 768px) {
    ul.nav.nav-tabs li a {
        font-size: 12px !important;
    }

    .col-md-5.form-slider-section {
        padding-top: 50px;
        padding-right: 20px;
        padding-left: 20px;
    }

    .styled-select label {
        display: none;
    }

    .fa-chevron-down {
        top: 15px;
    }

    .type-btn {
        margin: 0;
    }

    .form-slider-section.desktop-s .tab-content,
    .form-slider-section.desktop-s .tab-content .container {
        padding: 0;
    }

    .form-slider-section.desktop-s .tab-content .container br {
        display: none;
    }

    .form-section .form {
        border-radius: 0;
    }
}
</style>

<script>
export default {
    props: {
		buttonText: {
			type: String
        },
    },
    mounted() {
        console.log(this.buttonText);
    }
};
</script>