<template>
	<div class="d-inline">
		<b-navbar toggleable="lg" type="dark" variant="info" :sticky="true">
		<b-navbar-toggle @click="sidebar=!sidebar" target="" />

    <b-navbar-toggle target="nav_collapse" />

    <b-collapse is-nav id="nav_collapse">
      <b-navbar-nav>
        <b-nav-item href="#">Link</b-nav-item>
        <b-nav-item href="#" disabled>Disabled</b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-form>
          <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search" />
          <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>

        <b-nav-item-dropdown text="Lang" right>
          <b-dropdown-item href="#">EN</b-dropdown-item>
          <b-dropdown-item href="#">ES</b-dropdown-item>
          <b-dropdown-item href="#">RU</b-dropdown-item>
          <b-dropdown-item href="#">FA</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown right>
          <!-- Using button-content slot -->
          <template slot="button-content"><em>{{name}}</em></template>
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item href="#">Signout</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
		<SideBar :show="sidebar" id="sidebar" class="sidebar h-100 s-show "></SideBar>
		<SideBar :show="true" id="sidebar" class="sidebar h-100 l-show"></SideBar>
		</div>
</template>

<script>
import SideBar from './SideBar.vue'

export default {
	name: 'navbar',
	data(){
		return {
			drawer:true,
			mini: true,
			item: 1,
			panel: false,
			items: [
				{ text: 'Real-Time', icon: 'mdi-clock' },
				{ text: 'Audience', icon: 'mdi-account' },
				{ text: 'Conversions', icon: 'mdi-flag' },
			],
			sidebar: false,
		}
	},
	props: {
		name: {
			type: String,
			default: '',
		}
	},
	methods: {
		go() {
			this.$router.push('aa');
		},
	},
	components: {
			SideBar
		},
}
</script>
<style scoped>
 .v-expansion-panels{
	color: red !important;
 }
 .navbar{
	 background-color: #333940 !important;
 }


  @media only screen and (min-width: 992px) {
	.l-show{
		display: block !important;
		width: 250px;
	}
	.s-show{
		display: none !important;
	}
}
@media only screen and (max-width: 991px) {
	.l-show{
		display: none !important;
		width: 0px;
	}
	.s-show{
		display:block !important;
	}
}



</style>