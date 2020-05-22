<template>
	<div>
        <notifications group="contact" position="top right"/>
		<app-header></app-header>
		<router-view></router-view>
		<app-footer></app-footer>
		<copy-right></copy-right>
	</div>
</template>

<style>
@import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
@import url('https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap');

.font-strong{
	font-weight: 600;
}
.opacity-50{
	opacity: 0.5;
}
.opacity-40{
	opacity: 0.4;
}
.opacity-30{
	opacity: 0.3;
}

body{
	margin:0;
	padding:0;
	font-family: 'Roboto', sans-serif;
	background-color: #fff;
}

header {
	padding: 25px 0;
	background: none;
	position: absolute;
	z-index: 999;
	width: 100%;
}

nav.navbar.navbar-expand-md {
	padding: 0;
}

.nav-mobile{
	padding-top: 3px;
}

ul.navbar-nav {
	width: 100%;
	text-align: center;
	display: inline-block;
}
ul.navbar-nav li {float:none; display:inline-block;}
a.phone-btn {
	float: right;
	color: #fff;
	font-size: 18px;
	font-weight: bold;
}
a.phone-btn i {
	background: rgba(67, 66, 65, 1);
	transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    -ms-transform: scaleX(-1);

	width: 42px;
	height: 42px;
	border-radius: 25px;
	line-height: 42px;
	text-align: center;
	margin-right: 13px;
}
body a.nav-link {
	color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	letter-spacing: 1px;
	padding: 9px 14px!important;
}

.fade-enter-active, .fade-leave-active {
	transition: opacity .5s;
}
.fade-enter, .fade-leave-active {
	opacity: 0;
}
</style>

<script>
import AppHeader from './components/Header.vue';
import AppFooter from './components/Footer.vue';
import CopyRight from './components/Copyright.vue';
export default{
	components: {
		AppHeader,
		AppFooter,
		CopyRight,
	}
};
</script>
