<template>
	<div>
		<!-- <v-app> -->
			<!-- <Header></Header> -->
			<b-container fluid class="w-100 ">
				<router-view></router-view>
			</b-container>
		<!-- </v-app> -->
	</div>
</template>

<script>
import Header from '../components/Header.vue'

    export default {
		data(){
			return {
				// studentss:{}
			}
		},
		name: 'main-app',
		components: {
			Header
		},
    }
</script>
