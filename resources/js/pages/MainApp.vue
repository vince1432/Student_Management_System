<template>
	<div id="app">
		<b-container fluid class="p-0 position-relative">
			<div v-if="!isLogin" class="d-inline">
				<Header></Header>
			</div>
			<div class="main-app">
				<router-view></router-view>
			</div>
		</b-container>
	</div>
</template>

<script>
import Header from '../components/Header.vue'
    export default {
		data(){
			return {
				isLogged : this.$store.getters.isLoggedIn,
			}
		},
		name: 'main-app',
		components: {
			Header,
		},
		computed: {
			isLogin() {
				return this.$route.name === 'login'
			}
		},
    }
</script>

<style scoped>
/* ::v-deep .body{
	width: 100% !important;
	height: 100% !important;
} */
@media only screen and (min-width: 992px) {
	.main-app{
		margin-left: 232px;
	}
}
</style>