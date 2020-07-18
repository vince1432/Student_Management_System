import Home from './pages/MainApp.vue'
import Students from './pages/Students/Students.vue'
import StudentsRegistration from './pages/Students/StudentRegistration.vue'
import Login from './pages/Login.vue'
import Dashboard from './pages/Dashboard.vue'

export const routes = [
	{
        path: '/',
        name: 'students',
        component: Students,
	},
	{
        path: '/students',
        name: 'students',
        component: Students
	},
	{
        path: '/student/registration',
        name: 'students',
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
		component : Dashboard
	}
// 	{
//         path: '/student/:id',
//         name: 'home',
//         component: Home
//     },
]
