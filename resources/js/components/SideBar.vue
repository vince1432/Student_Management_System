<template>
  <div >
    <div :class="(show)?'nav h-100 active':'hide nav h-100'" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<!-- <b-card></b-card> -->
			<b-list-group class="w-100 ">
				<b-list-group-item >
				</b-list-group-item>
				<!-- Dashboard -->
				<b-list-group-item  @click="redirect('/dashboard')">
					<b-icon-card-list variant="secondary" font-scale="1.5"></b-icon-card-list>
					<span class="ml-2">Dashboard</span>
				</b-list-group-item>
				<!-- Teacher Management -->
				<b-list-group-item @click="menu.teacher=!menu.teacher">
					<div>
						<b-icon-list variant="secondary" font-scale="1.5"></b-icon-list>
						<span class="ml-2">
							Teacher Management
						</span>
						<b-icon-chevron-down class="ml-3" :flip-v="menu.teacher" variant="secondary"></b-icon-chevron-down>
					</div>
				</b-list-group-item>
				<!-- Teacher Management items-->
				<b-collapse v-model="menu.teacher">
					<b-list-group>
						<b-list-group-item class="pl-5" @click="redirect('/teachers')">
							<span class="ml-2">Teacher List</span>
						</b-list-group-item>
						<b-list-group-item class="pl-5">
							<span class="ml-2">Teacher Enrollment</span>
						</b-list-group-item>
					</b-list-group>
				</b-collapse>
				<!-- Student Management -->
				<b-list-group-item >
					<b-icon-book-half variant="secondary" @click="redirect('/student/registration')" font-scale="1.5"></b-icon-book-half>
					<span class="ml-2">
						Student Management
					</span>
					<b-icon-chevron-down class="ml-3" variant="secondary"></b-icon-chevron-down>
				</b-list-group-item><b-list-group-item >
					<b-icon-book-half variant="secondary"  font-scale="1.5"></b-icon-book-half>
					<span class="ml-2">
						Teacher Management
					</span>
				</b-list-group-item><b-list-group-item >
					<b-icon-book-half variant="secondary"  font-scale="1.5"></b-icon-book-half>
					<span class="ml-2">
						Teacher Management
					</span>
				</b-list-group-item>
			</b-list-group>
		</div>
		<!-- <div class="tab-content" id="v-pills-tabContent">
			<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
			<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
			<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
			<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
		</div> -->
  </div>
</template>

<script>
  export default {
    data: () => ({
      menu : {
				teacher : false,
			},
    }),
    methods: {
      redirect(path) {
        this.$router.push(path)
          .catch(()=>{});
      }
		},
		props: {
			show: Boolean,
		}
  }
</script>

<style scoped>
*>>>.nav{
		position:fixed ;
		border-right: 1px solid #E5E5E5;
		overflow: hidden;
		font-size: 13px;
		background-color: white !important;
		z-index: 3;
		height: 100%;

	}
	@media only screen and (max-width: 991px) {
	.nav.active{
		-webkit-animation-name: slideIn;
		-webkit-animation-duration: 0.4s;
		animation-name: slideIn;
		animation-duration: 0.4s;
	}
	.nav.inactive{
		-webkit-animation-name: slideOut;
		-webkit-animation-duration: 0.4s;
		animation-name: slideOut;
		animation-duration: 0.4s;
	}
}
</style>