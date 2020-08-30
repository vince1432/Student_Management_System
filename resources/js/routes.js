import Dashboard from './pages/Dashboard.vue'
import Login from './pages/Login.vue'
import StudentsRegistration from './pages/Students/StudentRegistration.vue'
import Students from './pages/Students/Students.vue'
import TeacherForm from './pages/Teachers/TeacherForm.vue'
import Teachers from './pages/Teachers/Teachers.vue'



// import TeacherRegistration from './pages/Teachers/StudentRegistration.vue'

export const routes = [
	// {
    //     path: '/',
    //     name: 'dashboard',
    //     component: Students,
	// },
	{
		path: '/students',
		name: 'students',
		component: Students,
		meta: {
			requiresAuth: true
		},
	},
	{
		path: '/student/registration',
		name: 'studentsRegister',
		component: StudentsRegistration,
		meta: {
			requiresAuth: true
		},
	},
	{
		path: '/login',
		name: 'login',
		component : Login
	},
	{
		path: '/dashboard',
		name: 'dashboard',
		component : Dashboard,
		meta: {
			requiresAuth: true
		},
		alias : ['/'],
	},
	{
		path: '/teachers',
		name: 'teachers',
		component : Teachers,
		meta: {
			requiresAuth: true
		},
	},
	{
		path: '/teacher/register',
		name: 'TeacherRegister',
		component : TeacherForm,
		meta: {
			requiresAuth: true
		}
	},
	{
		path: '/teacher/update/:id',
		name: 'TeacherUpdate',
		component : TeacherForm,
		meta: {
			requiresAuth: true
		}
	}
]
