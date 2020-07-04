<template>
	<div class="container">
		<b-table :headers="headers" :items="students.data" sort-by="id" class="elevation-1" >
			<template v-slot:top>
				<b-toolbar flat color="white">
					<b-toolbar-title>Students</b-toolbar-title>
					<b-divider class="mx-4" inset vertical
					></b-divider>
					<b-spacer></b-spacer>
						<b-btn color="success" rounded  class="mb-2" to="/student/registration">New Item</b-btn>
					<b-dialog v-model="dialog" max-width="500px">
						<b-card>
							<b-card-title>
								<span class="headline">{{actionType}} Student </span>
							</b-card-title>
							<b-card-text>
								<b-container>
									<AddStudent @closeDialog="closeDialog" :student="student" :dialog="dialog" :actionType="actionType"/>
								</b-container>
							</b-card-text>
						</b-card>
					</b-dialog>
				</b-toolbar>
			</template>
			<template v-slot:item.actions = {item}>
				<!-- <v-btn small class="mr-2 success"  @click="getStudent(item.id),dialog = true" ><v-icon>mdiPencil</v-icon> </v-btn>
				<v-btn small class="error" @click="deleteStudent(item.id)" ><v-icon>delete</v-icon></v-btn> -->
				<b-icon @click="getStudent(item.student_id),dialog = true">edit</b-icon>
				<b-icon @click="deleteStudent(item.student_id)">delete</b-icon>
				<!-- {{item.index}} -->
			</template>
			<template v-slot:no-data>
				<b-btn color="primary" >Reset</b-btn>
			</template>
		</b-table>
		<!-- <notify></notify> -->
	</div>
</template>

<script>
import AddStudent from '../../components/AddStudent.vue'
    export default {
		data(){
			return {
				dialog: false,
				headers: [
					{
					text: 'ID',
					align: 'start',
					value: 'student_id',
					class: "center"
					},
					{ text: 'First Name', value: 'first_name' },
					{ text: 'Last Name', value: 'last_name' },
					{ text: 'Birthdate', value: 'birthday' },
					{ text: 'Actions', value: 'actions' },
				],

				studentId: null,
				actionType: 'Add',
				student:{},
			}
		},
		methods:{
			getStudent(id){
				this.studentId = id;
				this.actionType = 'Edit';
				axios.get('http://127.0.0.1:8000/api/student/' + id)
				.then((response) => {
					this.student = response.data
				});
			},
			deleteStudent(id){
				axios.delete('http://127.0.0.1:8000/api/student/' + id);
				this.$store.dispatch('getStudents');
			},
			addStudent(){
				this.actionType = 'Add'
				this.student = {}
			},
			close(){

			},
			save(){
			},
			closeDialog(value){
				this.dialog = value
			}
		},
		components: {
			AddStudent
		},
		computed:{
			students(){
				return this.$store.getters.students
			}
		},
		mounted(){
			this.$store.dispatch('getStudents');
		}
    }
</script>
