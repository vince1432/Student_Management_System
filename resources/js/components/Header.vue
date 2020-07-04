<template>
	 <div>
		 <v-navigation-drawer
			v-model="drawer"
			:mini-variant.sync="mini"
			disable-route-watcher
			enable-resize-watcher
			app
			permanent
      >
        <v-list-item class="px-2">
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
          </v-list-item-avatar>

          <v-list-item-title>John Leider</v-list-item-title>

          <v-btn
            icon
            @click.stop="mini = !mini"
          >
            <v-icon>edit</v-icon>
          </v-btn>
        </v-list-item>

        <v-divider></v-divider>
		<v-list dense>
		<!-- Students -->
			<v-list-item link :class="mini ? '' :'p-0'">
				<!-- Icon -->
				<v-list-item-icon v-if="mini">
					<v-icon >edit</v-icon>
				</v-list-item-icon>

 				<v-list-item-content :class="mini ? '' :'p-0'">
					 <!-- Expansion -->
					 <v-expansion-panels >
						<v-expansion-panel d>
							<!-- Header -->
							<v-expansion-panel-header><p><v-icon class="pr-5">edit</v-icon>Students</p></v-expansion-panel-header>
							<!-- Content -->
							<v-expansion-panel-content>
								<v-list dense>
									<v-list-item-group color="primary">
										<!-- Items -->
										<v-list-item>
											<v-list-item-content>
												<v-list-item-title >Student List</v-list-item-title>
											</v-list-item-content>
										</v-list-item>
										<v-list-item>
											<v-list-item-content>
												<v-list-item-title >Registration</v-list-item-title>
											</v-list-item-content>
										</v-list-item>
									</v-list-item-group>
								</v-list>
							</v-expansion-panel-content>
						</v-expansion-panel>
					</v-expansion-panels>
				</v-list-item-content>
			</v-list-item>

			<!-- Teachers -->
			<v-list-item link :class="mini ? '' :'p-0'">
				<!-- Icon -->
				<v-list-item-icon v-if="mini">
					<v-icon >edit</v-icon>
				</v-list-item-icon>

 				<v-list-item-content :class="mini ? '' :'p-0'">
					 <!-- Expansion -->
					 <v-expansion-panels>
						<v-expansion-panel>
							<!-- Header -->
							<v-expansion-panel-header><p><v-icon class="pr-5">edit</v-icon>Teachers</p></v-expansion-panel-header>
							<!-- Content -->
							<v-expansion-panel-content >
								<v-list dense>
									<v-list-item-group color="primary">
										<!-- Items -->
										<v-list-item class="m-1">
											<v-list-item-content>
												<v-list-item-title >Teacher List</v-list-item-title>
											</v-list-item-content>
										</v-list-item>
										<v-list-item>
											<v-list-item-content>
												<v-list-item-title >Registration</v-list-item-title>
											</v-list-item-content>
										</v-list-item>
									</v-list-item-group>
								</v-list>
							</v-expansion-panel-content>
						</v-expansion-panel>
					</v-expansion-panels>
				</v-list-item-content>
			</v-list-item>
		</v-list>
      </v-navigation-drawer>
      <!-- <v-app-bar
        color="deep-purple accent-4"
        dense
        dark
      >
        <v-app-bar-nav-icon></v-app-bar-nav-icon>

        <v-toolbar-title>Page title</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon>Students</v-icon>
        </v-btn>

        <v-btn icon>
          <v-icon>Teacher</v-icon>
        </v-btn>

        <v-menu
          left
          bottom
        >
          <template v-slot:activator="{ on }">
            <v-btn icon v-on="on">
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>

          <v-list>
            <v-list-item
              v-for="n in 5"
              :key="n"
              @click="() => {}"
            >
              <v-list-item-title>Option {{ n }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-app-bar> -->
    </div>
</template>

<script>
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
		}
	},
	methods: {
		go() {
			this.$router.push('aa');
		}
	}
}
</script>
<style scoped>
 .v-expansion-panels{
	color: red !important;
 }
</style>