
app.controller('dashboardController', function($scope,SweetAlert,$location){

	let session = JSON.parse(localStorage.getItem('token'));
		if (localStorage['token'] != undefined) {
			let user = JSON.parse(localStorage.getItem('token'));
			Materialize.toast('You are successfully logged in',3000,'indigo');
		}else{
			localStorage.clear();
			$location.path('/login')
		}

})