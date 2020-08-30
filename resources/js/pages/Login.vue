<template>
  <div class="bg-gray">
    <b-container class="pt-5">
		<b-card class="mt-5 w-50 mx-auto " header="User Login"	>
			<!-- login form -->
			<b-form  >
				<b-form-group
					id="input-group-1"
					label="Username:"
					label-for="input-1"
				>
					<!-- username -->
					<b-form-input
						id="input-1"
						v-model="user.userable_id"
						type="text"
						required
						placeholder="Enter username"
						:class="(error)?'invalid':''"
						@input="(error)?error=false:error=error"
					></b-form-input>
				</b-form-group>
				<!-- password -->
				<b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
					<b-form-input
						id="input-2"
						v-model="user.password"
						required
						type="password"
						placeholder="Enter password"
						:class="(error)?'invalid':''"
						@input="(error)?error=false:error=error"
					></b-form-input>
				</b-form-group>
				<!-- remember me -->
				<b-form-group id="input-group-4">
					<b-form-checkbox
						v-model="user.remember_me"
						>Remember me?
					</b-form-checkbox>
				</b-form-group>
				<!-- login button -->
				<b-button @click="Login" variant="primary">Login</b-button>
			</b-form>
		</b-card>
	</b-container>
  </div>
</template>

<script>
import {login,storeUser} from '../auth.js'
  export default {
    data :() => {
      return {
        user: {
          userable_id: '2019-12-9548',
          password: '2019-12-9548',
          remember_me: false,
				},
				error: false,
				success: false,
      }
    },
		mounted : () =>{
			// document.querySelector('body').style.backgroundColor = "#343a40";
		},
    methods: {
			Login() {
				let variant, msg, title;
				login(this.user)
				.then((response) => {
					this.success = true;
					this.error = false;
					storeUser(response.data,this.$store);
					variant = 'success';
					msg = 'Successfully Logged In.';
					title = 'Success!';
					this.$router.push('/dashboard')
				})
				.catch((err) => {
					this.error = true;
					this.success = false;
					variant = 'danger';
					msg = 'Invalid Credentials.';
					title = 'Unsuccessful!';
				})
				.finally(() => {
					this.makeToast(msg,variant,title);
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

<style scoped>
::v-deep body {
	background-color: red !important;
}
</style>