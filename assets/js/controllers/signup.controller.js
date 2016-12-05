
app.controller('signupController', function($scope,$http,SweetAlert,$location){
	Materialize.updateTextFields();
	$scope.register = function(valid){

		if (valid) {
			var info = {
				'name':$scope.name,
				'mobile':$scope.mobile,
				'email':$scope.email,
				'password':$scope.password
			}

			var baseUrl = '/endpoints/register.php';
			
			$http.post(baseUrl, info).success( function (response){
				if (response.status == true) {
					$scope.name = '';
					$scope.email = '';
					$scope.password = '';
					$scope.mobile = '';
					$location.path('/activate')
					
				}else{
					Materialize.toast('We could not register',2000,'red rounded')
				}
			}).error( function (response){
				console.log(response)
			})
		}else{
			console.log('Invalid form submission')
		}

	}

})