<template>
	<v-form>
		<v-card-title>Student Registration</v-card-title>
      <v-container class="w-75">
        <v-row>
          <!-- <v-col cols="12" sm="6" md="3"> -->
			<v-text-field
				label="First Name"
				required
				:rules="[rules.required]"
			></v-text-field>
        </v-row>
		<v-row>
			<v-text-field
				label="Last Name"
				:rules="[rules.required]"
			></v-text-field>
          <!-- </v-col> -->
        </v-row>
		<v-row>
			<v-menu v-model="fromDateMenu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y  max-width="290px"  min-width="290px">
				<template v-slot:activator="{ on }">
					<v-text-field label="Birthdate" readonly  v-on="on" :rules="[rules.required]" ></v-text-field>
				</template>
				<v-date-picker locale="en-in"  no-title @input="fromDateMenu = false"  ></v-date-picker>
			</v-menu>
        </v-row>
		<v-row>
			<v-text-field
				label="Adress"
				:rules="[rules.required]"
			></v-text-field>
		</v-row>
		<v-row>
			<v-text-field
				label="Contact Number"
				:rules="[rules.required]"
			></v-text-field>
		</v-row>
		<v-row>
			<v-text-field
				label="Email Address"
				:rules="[rules.required]"
			></v-text-field>
		</v-row>
		<v-row align="right">
			<v-spacer></v-spacer>
			<v-btn class="success m-1" >Register</v-btn>
			<v-btn class="error m-1">Cancel</v-btn>
		</v-row>
      </v-container>
    </v-form>
</template>

<script>
export default {
	data(){
		return {
			rules:{
				required: value => !!value || "This field is required."
			},
			fromDateMenu: false,
			fromDateVal: null,
			student:{}
		}
	}
}
</script>

<style scoped>
 *>>>.v-text-field{
      margin-left: 25px !important;
      margin-right: 25px !important;
	  max-width: 400px;
}
</style>