export default{
	state:{
		students: [],
		student:{}
	},
	getters:{
		students(state) {
			return state.students;
		},
		student(state) {
			return state.student;
		}
	},
	actions:{
		getStudents(context) {
			axios.get('http://127.0.0.1:8000/api/student')
			.then((response) => {
					context.commit('updateStudents', response.data);
			})
		},
		getStudent(context,payload) {
			// console.log('res',response)
			axios.get('http://127.0.0.1:8000/api/student/'+ payload)
			.then((response) => {
					context.commit('updateStudent', response.data);
			})
    }
	},
	mutations:{
		updateStudents(state, payload) {
			state.students = payload;
				},
		updateStudent(state, payload) {
			state.student = payload;
		}
	}
}