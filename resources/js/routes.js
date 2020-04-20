import Home from './components/MainApp.vue'

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
	},
	{
        path: '/student/:id',
        name: 'home',
        component: Home
    },
]
