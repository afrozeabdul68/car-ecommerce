/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

import Carousel from 'vue-owl-carousel';
Vue.use(Carousel);

import VueLazyload from 'vue-lazyload';
Vue.use(VueLazyload);

import {VueMasonryPlugin} from 'vue-masonry';
Vue.use(VueMasonryPlugin);

import VueMasonry from 'vue-masonry-css';
Vue.use(VueMasonry);

import Notifications from 'vue-notification';
Vue.use(Notifications);

import VueMq from 'vue-mq';
Vue.use(VueMq,{
	breakpoints: {
		mobile: 450,
		laptop: 1250,
		desktop: Infinity,
	}
});

import HomeComponent from './components/HomeComponent.vue';
import SearchComponent from './components/SearchComponent.vue';
import CarDetail from './components/CarDetail.vue';
import DealerComponent from './components/DealerComponent.vue';
import PrivacyComponent from './components/PrivacyComponent.vue';
import TOSComponent from './components/TOSComponent.vue';
import AboutUsComponent from './components/AboutUsComponent.vue';
import ContactUsComponent from './components/ContactUsComponent.vue';
const routes = [
{
	name: 'home',
	path: '/',
	component: HomeComponent
},{
	name: 'search',
	path: '/search',
	component: SearchComponent
},{
	name: 'cardetail',
	path: '/car-detail/:vin',
	component: CarDetail,
	props: true
},{
	name: 'dealer',
	path: '/find-dealers',
	component: DealerComponent
},{
	name: 'privacy',
	path: '/privacy',
	component: PrivacyComponent
},
{
	name: 'terms-of-service',
	path: '/terms-of-service',
	component: TOSComponent
},
{
	name: 'about-us',
	path: '/about-us',
	component: AboutUsComponent
},
{
	name: 'contact-us',
	path: '/contact-us',
	component: ContactUsComponent
},
{
	name: 'advertise',
	path: '/advertise',
	component: AboutUsComponent
},
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
