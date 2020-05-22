<template>
	<div class="copy-right" :class="$mq == 'mobile' ? 'mobile-copyright' : ''">
		<p>19 CarDesta Trademarks and brands are the property of their respective owners.</p>
	</div>
</template>

<style>
.copy-right {
	text-align: center;
	color: #212121;
	background: #000;
	padding: 15px 0;
	font-size: 14px;
	border-top: 1px solid #2a2a2a;
}
.copy-right a{
	color:#7e4c4f;
	text-decoration:none;
}
.copy-right p {
	margin: 0;
}
.footer-box a img {

	max-width: 100%;

}

</style>

<script>
export default {

};
</script>