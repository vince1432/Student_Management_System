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
				:busy="loading"
			>
				<template v-slot:cell(actions)="{ item }">
					<div class="text-center">
						<b-icon-pencil-square class="btn-icon" @click="$router.push(`/teacher/update/${item.user_id}`)"></b-icon-pencil-square>
						<b-icon-trash-fill class="btn-icon"></b-icon-trash-fill>
					</div>
				</template>
				<template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
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
				fields: ['user_id','first_name', 'last_name', 'email', 'actions'],
				teachers: [],
				loading: true,
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
					this.loading = false;
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