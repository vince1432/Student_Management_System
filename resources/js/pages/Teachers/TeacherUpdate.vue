<template>
	<div class="bg-default">
		<b-container class="w-100 p-4 ">
			<b-card>
				<b-card-title>Teacher Registration</b-card-title>
				<b-card-body>
					<hr>
					<!-- form -->
					<b-form @submit="onSubmit"  v-if="show1">
						<!-- Name -->
						<b-row id="name-row" class="mt-3 mb-3" title="">
							<!-- first name -->
							<b-col lg="6" sm="12">
								<b-form-group>
									<b-form-input
										v-model="teacher.last_name"
										required
										placeholder="Last name"
									></b-form-input>
								</b-form-group>
							</b-col>
							<!-- last name -->
							<b-col lg="6" sm="12">
								<b-form-group>
									<b-form-input
										v-model="teacher.first_name"
										required
										placeholder="First name"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<b-row  class="mb-3">
							<!-- Birthday -->
							<b-col >
								<b-form-group>
									<b-form-datepicker
										label-no-date-selected="Birthday"
										id="example-datepicker" class="mb-2"
										:date-format-options="{ year: 'numeric', month: '2-digit', day: '2-digit' }"
   									locale="en"
										v-model="teacher.birthday"
										:hide-header="true"
									></b-form-datepicker>
								</b-form-group>
							</b-col>
						</b-row>
						<b-row  class="mb-3">
							<!-- gender -->
							<b-col >
								<b-form-group >
									<b-form-radio-group>
										<b-form-radio v-model="teacher.gender" name="some-radios" value="male">Male</b-form-radio>
										<b-form-radio v-model="teacher.gender" name="some-radios" value="female">Female</b-form-radio>
									</b-form-radio-group>
								</b-form-group>
							</b-col>
						</b-row>
						<hr>
						<b-row class="mb-3">
							<!-- email -->
							<b-col >
								<b-form-group>
									<b-form-input
										id="input-1"
										v-model="teacher.email"
										type="email"
										required
										placeholder="Email"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<b-row>
						<!-- contact number -->
							<b-col >
								<b-form-group>
									<b-form-input
										id="input-1"
										v-model="teacher.contact_number"
										required
										placeholder="Contact Number"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<hr>
						<!-- address -->
						<b-row  class="mb-3">
							<!-- house number -->
							<b-col md="6">
								<b-form-group>
									<b-form-input
										id="input-1"
										v-model="teacher.building"
										required
										placeholder="House number/Apartment/Bldg.\Street"
									></b-form-input>
								</b-form-group>
							</b-col>
							<!-- Street -->
							<b-col md="6">
								<b-form-group>
									<b-form-input
										id="input-1"
										v-model="teacher.barangay"
										required
										placeholder="Barangay"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<b-row  class="mb-3">
							<!-- City -->
							<b-col md="6">
								<b-form-group>
									<b-form-input
										v-model="teacher.city"
										required
										placeholder="City"
									></b-form-input>
								</b-form-group>
							</b-col>
							<!-- Province -->
							<b-col md="6">
								<b-form-group>
									<b-form-input
										v-model="teacher.province"
										required
										placeholder="Province"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<b-row  class="mb-3">
							<!-- Other -->
							<b-col>
								<b-form-group>
									<b-form-input
										v-model="teacher.other"
										placeholder="Other"
									></b-form-input>
								</b-form-group>
							</b-col>
						</b-row>
						<b-button type="submit" class="btn-rounded float-right" variant="success">Register</b-button>
					</b-form>
				</b-card-body>
			</b-card>
		</b-container>
	</div>
</template>

<script>
  export default {
    data: () => {
      return {
				teacher: {
          last_name: '',
          first_name: '',
          birthday: '',
          gender: '',
          email: '',
          contact_number: '',
          building: '',
          barangay: '',
          city: '',
          province: '',
          other: '',
        },
        show1: true
			}
		},
		// mounted()  {
		// 	this.getTeachers();
		// },
    methods: {
			onSubmit(evt) {
				evt.preventDefault()
				let msg,variant,title;
				axios.post('/api/teacher',this.teacher)
				.then(res => {
					variant = 'success';
					msg = 'Teacher successfully created.';
					title = 'Success!';
				})
				.catch(err => {
					variant = 'danger';
					msg = 'Please check the fields.';
					title = 'Unsuccessful!';
				})
				.finally(()=> {
					this.makeToast(msg,variant,title);
					this.teacher = {};
					this.$router.push('/teachers');
				});
      },
			makeToast(msg,variant,title) {
				setTimeout(() => {
					this.$bvToast.toast(msg, {
					title: title,
					variant: variant,
					solid: true
					})
				},500);
	  	},
    }
  }
</script>
<style>

</style>