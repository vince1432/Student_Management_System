<template>
	<div >
		<div id="app">
			<v-app id="inspire">
				<v-data-table :headers="headers" :items="students" sort-by="id" class="elevation-1" >
					<template v-slot:top>
						<v-toolbar flat color="white">
							<v-toolbar-title>Students</v-toolbar-title>
							<v-divider class="mx-4" inset vertical
							></v-divider>
							<v-spacer></v-spacer>
							<v-dialog v-model="dialog" max-width="500px">
								<template v-slot:activator="{ on }">
									<v-btn color="primary" dark class="mb-2" v-on="on" @click="addStudent">New Item</v-btn>
								</template>
								<v-card>
									<v-card-title>
										<span class="headline">{{actionType}} Student </span>
									</v-card-title>
									<v-card-text>
										<v-container>
											<AddStudent @closeDialog="closeDialog" :id="studentId" :dialog="dialog" :actionType="actionType"/>
										</v-container>
									</v-card-text>
								</v-card>
							</v-dialog>
						</v-toolbar>
					</template>
					<template v-slot:item.actions = {item}>
						<!-- <v-btn small class="mr-2 success"  @click="getStudent(item.id),dialog = true" ><v-icon>mdiPencil</v-icon> </v-btn>
						<v-btn small class="error" @click="deleteStudent(item.id)" ><v-icon>delete</v-icon></v-btn> -->
						<v-icon @click="getStudent(item.id),dialog = true">settings</v-icon>
						<v-icon @click="deleteStudent(item.id)">done</v-icon>
						<!-- {{item.index}} -->
					</template>
					<template v-slot:no-data>
						<v-btn color="primary" >Reset</v-btn>
					</template>
				</v-data-table>
			</v-app>
		</div>
  </div>
</template>

<script>
import AddStudent from './AddStudent.vue'

export default {
	data(){
		return {
			dialog: false,
			 headers: [
        {
          text: 'ID',
          align: 'start',
          sortable: false,
          value: 'id',
        },
        { text: 'First Name', value: 'first_name' },
        { text: 'Last Name', value: 'last_name' },
        { text: 'Birthdate', value: 'birthdate' },
        { text: 'Actions', value: 'actions' },
      ],

			studentId: null,
			actionType: 'Add'
		}
	},
	props: {
		students: Array
	},
	components: {
		AddStudent
	},
	methods:{
		getStudent(id){
			this.studentId = id
			this.actionType = 'Edit'
		},
		deleteStudent(id){
			axios.delete('http://127.0.0.1:8000/api/student/' + id)
			this.$store.dispatch('getStudents')
		},
		addStudent(){
			this.actionType = 'Add'
		},
		close(){

		},
		save(){
		},
		closeDialog(value){
			this.dialog = value
		}
	}
}
</script>