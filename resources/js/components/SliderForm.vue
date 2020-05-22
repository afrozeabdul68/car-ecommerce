<template>
<div :class="$mq == 'mobile' ? 'col-md-5 form-slider-section desktop-s' : 'carousel-inner1'">
    <div class="" :class="$mq == 'mobile' ? '' : 'col-md-5 form-slider-section'">
        <div class="srh-box">
            <ul class="nav nav-tabs" :class="$mq == 'mobile' ? 'nav-justified' : ''" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Search by Make</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Search by Body Style</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <div class="form-section">
                        <form>
                            <div class="form">
                                <div class="styled-select">
                                    <label>Makes</label>
                                    <select @change="getModelsByMake($event)" v-model="search.make">
                                        <option value="">All Makes</option>
                                        <option v-for="make in makes" :key="make" :value="make">{{ make }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Cars</label>
                                    <select name="type" @change="getMakesByType($event)" v-model="search.type">
                                        <option value="" selected="selected">New & Used Cars</option>
                                        <option value="New">New Cars</option>
                                        <option value="Used">Used Cars</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Models</label>
                                    <select v-model="search.model">
                                        <option value="">All Models</option>
                                        <option v-for="model in models" :key="model" :value="model">{{ model }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Price</label>
                                    <select v-model="search.price">
                                        <option value="0">No Max Price</option>
                                        <option v-for="price in prices" :key="price" :value="price">${{ price }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select border-none">
                                    <label>Mileage</label>
                                    <select v-model="search.radius">
                                        <option value="9999">All Miles from</option>
                                        <option v-for="mileage in mileages" :key="mileage" :value="mileage">{{ mileage }} Miles from</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select border-none style-input">
                                    <label>Zip Code</label>
                                    <input type="tel" name="zip" placeholder="ZIP" v-model="search.zip">
                                </div>
                            </div>
                            <div class="type-btn">
                                <input type="button" @click.stop.prevent="submit()" class="button" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <div class="form-section">
                        <form>
                            <div class="form">
                                <div class="styled-select">
                                    <label>Body Style</label>
                                    <select name="body" v-model="search.body">
                                        <option value="">All Body Style</option>
                                        <option v-for="style in bodystyles" :key="style.body" :value="style.body">{{ style.body }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Makes</label>
                                    <select v-model="search.make">
                                        <option value="">All Makes</option>
                                        <option v-for="make in makes" :key="make" :value="make">{{ make }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Price</label>
                                    <select v-model="search.price">
                                        <option value="0">No Max Price</option>
                                        <option v-for="price in prices" :key="price" :value="price">${{ price }}</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select">
                                    <label>Mileage</label>
                                    <select v-model="search.radius">
                                        <option value="9999">All Miles from</option>
                                        <option v-for="mileage in mileages" :key="mileage" :value="mileage">{{ mileage }} Miles from</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="styled-select border-none style-input">
                                    <label>Zip Code</label>
                                    <input type="tel" v-model="search.zip" placeholder="ZIP" name="zip">
                                </div>
                            </div>
                            <div class="type-btn">
                                <input type="button" @click.stop.prevent="submit()" class="button" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>
</div>
</template>

<style>
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

.col-md-5.form-slider-section {
    float: right;
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

.styled-select label {
    width: 100%;
    font-size: 12px;
    color: #999999;
    text-align: left;
    margin: 0;
}

.styled-select.border-none {
    border-bottom: none !important;
}

.tab-content {
    padding: 2px 10px 0px;
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
        transform: translateY(00%);
        left: 0;
        z-index: 9;
        display: inline-block;
        width: 100%;
        margin-bottom: 30px;
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
    mounted() {
        this.getAllMakes();
        this.getAllModels();
        this.getAllBodyStyles();
        this.getAllMileages();
        this.getAllPrices();
    },
    data() {
        return {
            makes: [],
            models: [],
            prices: [],
            mileages: [],
            bodystyles: [],
            search: {
                type: 'New',
                zip: '',
                make: '',
                model: '',
                radius: 20,
                price: 0,
                body: '',
            },
        }
    },
    methods: {
        getAllMakes() {
            this.axios.get('api/v2/get-all-makes').then(response => {
                this.makes = response.data;
            });
        },
        getMakesByType() {
            this.axios.get('api/v2/get-makes-by-type/' + event.target.value).then(response => {
                this.makes = response.data;
            });
        },
        getModelsByMake(event) {
            this.axios.get('api/v2/get-models-by-make/' + event.target.value).then(response => {
                this.models = response.data;
            });
        },
        getAllModels() {
            this.axios.get('api/v2/get-all-models').then(response => {
                this.models = response.data;
            });
        },
        getAllPrices() {
            this.axios.get('api/v2/get-all-prices').then(response => {
                this.prices = response.data;
            });
        },
        getAllMileages() {
            this.axios.get('api/v2/get-all-mileages').then(response => {
                this.mileages = response.data;
            });
        },
        getAllBodyStyles() {
            this.axios.get('api/v2/get-all-bodystyles').then(response => {
                this.bodystyles = response.data;
            });
        },
        submit() {
            let searches = this.getStringData(this.search);
            if (this.search.zip) {
                this.$router.push("/search?" + searches);
            } else {
                alert("ZIP Code is required");
            }
        },
        getStringData($object) {
            let data = '';
            $.each(this.search, function (key, value) {
                data += key + '=' + value + '&';
            });

            return data;
        },
    }
};
</script>
