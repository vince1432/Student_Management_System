import { getCurrentUser } from './auth.js';

const currUser = getCurrentUser()

export default{
	state:{
		user: currUser,
		isLoggedIn: !!currUser
		// students: [],
		// student:{},
		// tokenData: currUser.token_data,
	},
	getters:{
		// students : (state) => {
		// 	return state.students;
		// },
		// student : (state) => {
		// 	return state.student;
		// },
		getCurrentUser : (state) => {
			return state.user;
		},
		isLoggedIn : (state) => {
			return state.isLoggedIn;
		},
		getToken : (state) => {
			if(state.user)
				return state.user.token_data.access_token;
			else
				return null;
		}
	},
	actions:{
		// getStudents : (context) => {
		// 	axios.get('http://127.0.0.1:8000/api/student')
		// 	.then((response) => {
		// 			context.commit('updateStudents', response.data);
		// 	})
		// },
		// getStudent : (context,payload) => {
		// 	// console.log('res',response)
		// 	axios.get('http://127.0.0.1:8000/api/student/'+ payload)
		// 	.then((response) => {
		// 			context.commit('updateStudent', response.data);
		// 	})
		// },
		setUser : (context,payload) => {
			context.commit('updateUser',payload);
		}

	},
	mutations:{
		// updateStudents : (state, payload) => {
		// 	state.students = payload;
		// },
		// updateStudent : (state, payload) => {
		// 	state.student = payload;
		// },
		updateUser : (state, payload) =>{
			state.user = payload;
			state.isLoggedIn = !!payload;
		},
		checkUser : (state) => {
			return (Object.keys.length > 0 ) ? true : false
		}
	}
}