
app.controller("activateController", function($scope,$http,$location) {

	Materialize.updateTextFields();

	$scope.activateAccount =  function (){

		let info = {'code':$scope.code}
		let baseUrl = '/endpoints/activate.php';

		$http.post(baseUrl, info).success( function(response){
			console.log(response)
			if (response.status == true) {
				$location.path('/login')
			}else{
				Materialize.toast(response.message,2000,'red rounded');
			}
		}).error( function(response){
			console.log(response.sms)
		})
	}
})