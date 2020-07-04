import Home from './pages/MainApp.vue'
import Students from './pages/Students/Students.vue'
import StudentsRegistration from './pages/Students/StudentRegistration.vue'

export const routes = [
	{
        path: '/',
        name: 'students',
        component: Students
	},
	{
        path: '/students',
        name: 'students',
        component: Students
	},
	{
        path: '/student/registration',
        name: 'students',
        component: StudentsRegistration
	},
// 	{
//         path: '/student/:id',
//         name: 'home',
//         component: Home
//     },
]
