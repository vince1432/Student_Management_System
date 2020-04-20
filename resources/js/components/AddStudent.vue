<template>
  <div>
		<v-form ref="form" @submit.prevent="add" lazy-validation >
			<v-text-field v-model="student.first_name"  label="First Name" required ></v-text-field>
			<v-text-field v-model="student.last_name"  label="Last Name" required ></v-text-field>
			<!-- <v-date-picker v-model="student.birthdate"  label="Birthdate" required ></v-date-picker> -->

			<v-menu v-model="fromDateMenu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y  max-width="290px"  min-width="290px">
				<template v-slot:activator="{ on }">
					<v-text-field label="Birthdate" readonly :value="student.birthdate" v-on="on" ></v-text-field>
				</template>
				<v-date-picker locale="en-in" v-model="student.birthdate" no-title @input="fromDateMenu = false" :min="minDate" ></v-date-picker>
			</v-menu>

		</v-form>
		<v-card-actions>
			<v-spacer></v-spacer>
			<v-btn color="blue darken-1" text  @click="closeDialog">Cancel</v-btn>
			<v-btn color="blue darken-1" text @click="(isAdd) ? add():update(id) ">Save</v-btn>
		</v-card-actions>
  </div>
</template>

<script>

export default {
	name: 'AddStudent',
	props: {
		id: Number,
		actionType:String,
		dialog : Boolean
	},
	data() {
		return {
			fromDateMenu: false,
     	fromDateVal: null
		}
	},
	methods: {
		add(){
			axios({
				method: 'post',
				url: 'http://127.0.0.1:8000/api/student',
				data: this.student
			})
			.then((result) => {
				this.$store.dispatch('getStudents')
				this.closeDialog()
			}).catch((err) => {
				console.log(err)
			});
		},
		update(id){
				axios({
				method: 'patch',
				url: `http://127.0.0.1:8000/api/student/${id}`,
				data: this.student
			})
			.then((response) => {
				this.$store.dispatch('getStudents')
				this.closeDialog()
			})
			},
			closeDialog(){
				this.$emit('closeDialog', false)
			}
	},
	computed:{
		isAdd(){
			if(this.actionType === 'Add')
			{
				return true
			}
			else if(this.actionType === 'Edit'){
				return false
			}
			else{
				return false
			}
		},
		student(){
			let student = {
				first_name: '',
				last_name: '',
				birthdate: ''
			}
			if(this.actionType === 'Edit'){
				if(this.id !== this.$store.getters.student.id){
					this.$store.dispatch('getStudent',this.id)
				}
				return this.$store.getters.student
			}
			else if(this.actionType === 'Add'){
				return student
			}
		}
	}
}
</script>