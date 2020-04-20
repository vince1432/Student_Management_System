<template>

	<div class="container">
		<Header></Header>

		<StudentsTable :students="students"/>

	</div>
</template>

<script>
import Header from './Header.vue'
import StudentsTable from './StudentsTable.vue'

    export default {
		data(){
			return {
				// students:[]
			}
		},
		name: 'main-app',
		components: {
			Header,
			StudentsTable
		},
		computed:{
			students(){
            		return this.$store.getters.students
        		}
		},
		mounted(){
			this.$store.dispatch('getStudents')
		}
    }
</script>
