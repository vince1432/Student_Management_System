
export function logout(){

}

export function login(user){
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

export function storeUser(user){
	localStorage.setItem('user',JSON.stringify(user));
}

//for checking if logged in before going to different routes
export function isLoggedIn(router,store){
		router.beforeEach((to, from, next) => {
		if (to.matched.some(record => record.meta.requiresAuth)) {
			if(!store.getters.isLoggedIn  && to.path !== '/login'){
				next({path: '/login'});
			}
			else{
				next();
			}
		}
		else if(store.getters.isLoggedIn  && to.path === '/login'){
			next({path: '/dashboard'});
		}
		else{
			next();
		}
	  });
}

//for checking saved user in local storage
export function getCurrentUser(){
	return JSON.parse(localStorage.getItem('user'));
}
