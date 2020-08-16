
export function logout(){
	axios.post('/api/logout')
	.then((res) => {
		console.log(res);
	})
	.catch((err) => {
		console.log(err);
	});
}

export function login(user,store){
	var promise = new Promise((resolve,reject) => {
		axios.post('/api/user/login',user)
		.then((response) => {
			resolve(response);
		})
		.catch((err) => {
			reject('Invalid credentials');
		})
	});

	return promise;
}

export function storeUser(user,store){
	localStorage.setItem('user',JSON.stringify(user));
	store.dispatch('setUser',user);
	addHeader();
}

//for checking if logged in before going to different routes
export function isLoggedIn(router,store){
	addHeader();
	interceptor(store,router);
	router.beforeEach((to, from, next) => {
		if (to.matched.some(record => record.meta.requiresAuth)) {
			if(!store.getters.isLoggedIn  && to.path !== '/login')
				next({path: '/login'});
			else
				next();
		}
		else if(store.getters.isLoggedIn  && to.path === '/login')
			next({path: '/dashboard'});
		else
			next();
	});
}

//for checking saved user in local storage
export function getCurrentUser(token){
	return JSON.parse(localStorage.getItem('user'));
}

//add header for axios requests
let addHeader = () => {
	let user = JSON.parse(localStorage.getItem('user'));
	if(user)
		axios.defaults.headers.common['Authorization'] = `Bearer ${user.token_data.access_token}`;
	else
		axios.defaults.headers.common['Authorization'] = null;
};

//401 checker
let interceptor = (store,router) =>{
	axios.interceptors.response.use((response) => {
		return response;
	},(error) => {
		if (error.response.status === 401) {
			store.dispatch('setUser',null);
			router.push('/login');
		}
		return Promise.reject(error);
	})
}