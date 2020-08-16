<template>
	<div>
		<b-container class="mt-5">
			<div class="pb-5">
				<b-card-title class="position-fixed">Teachers</b-card-title>
				<b-button @click="$router.push('/teacher/register')" class="float-right fixed btn-rounded">
					<b-icon-plus></b-icon-plus>Add
				</b-button>
			</div>
			<b-table responsive small striped hover bordered
				class="elevation-1 w-100 mt-3"
				:items="teachers"
				:fields="fields"
				sort-by="id"
			>
				<template v-slot:cell(actions)="{ item }">
					<div class="text-center">
						<b-icon-pencil-square class="btn-icon" ></b-icon-pencil-square>
						<b-icon-trash-fill class="btn-icon"></b-icon-trash-fill>
					</div>
				</template>
			</b-table>
		</b-container>
	</div>
</template>

<script>
  export default {
    data: () => {
      return {
				fields: ['teacher_id','first_name', 'last_name', 'email', 'actions'],
				teachers : [],
			}
		},
		mounted()  {
			this.getTeachers();
		},
    methods: {
			getTeachers() {
				axios.get('/api/teacher')
				.then((res) => {
					console.log(res);
					this.teachers = res.data.data;
				})
				.catch((err) => {
					console.log(err);
				});
			},
    }
  }
</script>
<style>

</style>