<template>
  <div>

    <b-container >
		<b-card class="my-5 w-50 mx-auto " header="User Login">
			<b-form @submit="onSubmit" >
				<b-form-group
					id="input-group-1"
					label="Username:"
					label-for="input-1"
				>
					<b-form-input
						id="input-1"
						v-model="user.username"
						type="text"
						required
						placeholder="Enter username"
					></b-form-input>
				</b-form-group>

				<b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
					<b-form-input
					id="input-2"
					v-model="user.password"
					required
					type="password"
					placeholder="Enter password"
					></b-form-input>
				</b-form-group>
				<b-form-group id="input-group-4">
					<b-form-checkbox
						v-model="user.remember_me"
						>Remember me?
					</b-form-checkbox>
				</b-form-group>

				<b-button type="submit" variant="primary">Submit</b-button>
				<!-- <b-button type="reset" variant="danger">Reset</b-button> -->
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
          username: 'users',
          password: 'password',
          remember_me: false,
		},
		error: false,
		success: false,
      }
    },
	created : () =>{
		document.querySelector('body').style.backgroundColor = "#343a40";
	},
    methods: {
      onSubmit(evt) {
		evt.preventDefault();

		login(this.user)
		.then((response) => {
			this.success = true;
			this.error = false;
			// storeToken(response.data.token_data)
			storeUser(response.data)
		})
		.catch((err) => {
			this.error = true;
			this.success = false;
		})
		.finally(() => {
			let variant, msg, title;

			if(this.success){
				variant = 'success';
				msg = 'Successfully Logged In.';
				title = 'Success!';
			}
			else{
				variant = 'danger';
				msg = 'Invalid Credentials.';
				title = 'Unsuccessful!';
			}

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
		},1000);
	  },
	  logout: function () {
			this.$store.dispatch(AUTH_LOGOUT)
			.then(() => {
			this.$router.push('/login')
			})
		}
    }
  }
</script>

<style scoped>

</style>