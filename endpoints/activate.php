<?php
	header("Access-Control-Allow-Origin: *");

	require_once "core.php";
	require_once 'db_connect.php';

	$data = json_decode(file_get_contents('php://input'));

	$code = $data->code;
	

	$query = "SELECT code FROM users WHERE code = '$code'";
	$result = mysqli_query($link, $query);

	$object = array();

	if (mysqli_num_rows($result) > 0) {
		
		$q = "UPDATE users SET status = 1 WHERE code = '$code'";
		$res = mysqli_query($link, $q);

		if (mysqli_affected_rows($link) == 1) {
			$object = array(
				'status' => true,
				'message' => 'activated'
			);
		}else{
			$object = array(
				'status' => false,
				'message' => 'disabled'
			);
		}
	
	}else{
		$object = array(
			'status' => false,
			'message' => 'Sorry we found no records matching your query'
		);
	}

	echo json_encode($object);

