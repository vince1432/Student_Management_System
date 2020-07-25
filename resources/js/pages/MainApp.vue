<template>
	<div >
		<!-- <v-app> -->
			<!-- <Header></Header> -->
			<b-container fluid >aaa
				<!-- <b-row class="body">
					<b-col>
						<SideBar></SideBar>
					</b-col>
					<b-col cols="9"> -->
						<router-view></router-view>
					<!-- </b-col> -->
				<!-- </b-row> -->
			</b-container>aaa
		<!-- </v-app> -->
	</div>
</template>

<script>
import Header from '../components/Header.vue'
import SideBar from '../components/SideBar.vue'
    export default {
		data(){
			return {
				// studentss:{}
			}
		},
		name: 'main-app',
		components: {
			Header,
			SideBar
		}
    }
</script>

<style scoped>
::v-deep .body{
	width: 100% !important;
	height: 100% !important;
}
</style>