<template>
<div class="shop-by-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><span>//</span> SHOP BY BODY STYLE</h2>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 product-mg" v-for="(style, index) in bodystyles" :key="index">
                <a href="#">
                    <div class="all-products">
                        <img :src="imageUrl(style.body)" :alt="style.body">
                        <h3>{{style.body}}</h3>

                        <p>{{ style.count }} cars</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</template>

<style>
.shop-by {
    /*background-image:url("../images/shop-make-bg.jpg");*/
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    padding: 275px 0 135px;
}

.shop-by h2 {
    font-size: 40px;
    color: #fff;
    font-weight: 600;
    text-align: center;
    margin-bottom: 50px;
}

.shop-by h2 span {
    color: #41abed;
    padding-right: 10px;
}

.shop-by-body {
    text-align: center;
}

.shop-by-body h2 {
    font-size: 40px;
    color: #000000;
    font-weight: 500;
    margin: 0px 0 35px 0;
    padding: 0 0 0 0;
}

.shop-by-body h2 span {
    color: #5cb7f0;
    margin-right: 10px;
}

.all-products {
    background: #fff;
}

.all-products h3 {
    font-size: 14px;
    color: #165a84;
    font-weight: 400;
    margin: 20px 0 0 0;
    padding: 0 0 0 0;
}

.all-products p {
    font-size: 14px;
    color: #999;
    font-weight: 400;
    margin: 5px 0 0 0;
    padding: 0 0 0 0;
}

.shop-by-body a {
    text-decoration: none;
}

.all-products img {
    max-width: 100%;
}

.all-products {
    border: 1px solid #d7d7d7;
    padding: 10px 10px 20px 10px;
    border-radius: 8px;
}

.col-sm-6.col-md-4.col-lg-3.product-mg {
    margin: 10px 0 0 0;
    padding-left: 5px;
    padding-right: 5px;
}
</style>

<script>
export default {
    mounted() {
        this.getAllBodyStyles();
    },
    methods: {
        getAllBodyStyles() {
            this.axios.get('api/v2/get-all-bodystyles').then(response => {
                this.bodystyles = response.data;
            });
        },

        imageUrl(body) {
            return body ? `/images/${body}.jpg` : '/images/no-car.png';
        }
    },
    data() {
        return {
            bodystyles: [],
            items: [{
                    image_name: 'sedans.jpg',
                    name: 'Sedan'
                },
                {
                    image_name: 'coupe.jpg',
                    name: 'Coupe'
                },
                {
                    image_name: 'SUV.jpg',
                    name: 'SUV'
                },
                {
                    image_name: 'crossover.jpg',
                    name: 'Crossover'
                },
                {
                    image_name: 'wagon.jpg',
                    name: 'Wagon/Hatchback'
                },
                {
                    image_name: 'creec.jpg',
                    name: 'Creec Car / Hybrid'
                },
                {
                    image_name: 'convertible.jpg',
                    name: 'Convertible'
                },
                {
                    image_name: 'sport-car.jpg',
                    name: 'Sports Car'
                },
                {
                    image_name: 'pickup-trucks.jpg',
                    name: 'Pickup Truck'
                },
                {
                    image_name: 'minivan.jpg',
                    name: 'Minivan/Van'
                },
                {
                    image_name: 'luxury-car.jpg',
                    name: 'Luxury Car'
                },
                {
                    image_name: 'certified-pre-owned.jpg',
                    name: 'Certified Pre-Owned'
                },
            ]
        }
    }
};
</script>
