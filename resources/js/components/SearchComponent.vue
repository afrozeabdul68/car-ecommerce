<template>
	<div class="main_wrapper">
		<app-banner :products="childData"></app-banner>
		<div class="filter-result">
			<div class="container">
				<div class="row">
					<filter-section @productData="updateData" :pagination="pageData" :searchdata="searchData"></filter-section>
					<filter-products @paginate="updatePagination" @searches="updateSearches" :products="childData"></filter-products>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.filter-result {
	padding: 50px 0;
}
</style>

<script>
import AppBanner from './BannerComponent.vue';
import FilterSection from './FilterSection.vue';
import FilterProducts from './FilterProducts.vue';

export default {
	data() {
		return {
			childData: {
				data : ''
			},
			pageData: {},
			searchData: {},
		}
	},
	methods : {
		updateData(variable) {
			this.childData = variable;
		},
		updatePagination(variable) {
			this.pageData = variable;
		},
		updateSearches(variable) {
			this.searchData = variable;
		}
	},
	components: {
		AppBanner,
		FilterSection,
		FilterProducts,
	}
};
</script>
