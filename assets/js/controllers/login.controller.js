
app.controller('loginController', function($scope,SweetAlert,$location,$http){
	Materialize.updateTextFields();
	$scope.signin = function(){

		let info = {
			'email':$scope.email,
			'password':$scope.password,
			'remember':$scope.remember
		}

		let baseurl = '/endpoints/login.php';
		$http.post(baseurl, info).success( function(response){

			console.log(response);
			
			if (response.islogged == true) {
				localStorage.setItem("token",JSON.stringify({user:response}));
				$location.path("/admin")
			}else{
				
				$scope.username = "";
				$scope.password = "";
				Materialize.toast(response.status, 3000,'red rounded')

			}
		}).error( function(response){

		})
	}

})