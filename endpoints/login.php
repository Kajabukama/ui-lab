<?php
	header("Access-Control-Allow-Origin: *");

	require_once 'core.php';
	require_once 'db_connect.php';

	$data = json_decode(file_get_contents('php://input'));

	$email = clean($data->email);
	$password = sha1(clean($data->password));

	$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 1 LIMIT 1";
	$result = mysqli_query($link, $query);

	$obj = array();
	$token;

	if (mysqli_num_rows($result) > 0) {
		
		$token = uniqid() . uniqid() . uniqid();

		$q = "UPDATE users SET email = '$email', password = '$password', token = '$token' WHERE email = '$email'";
		$res = mysqli_query($link, $q);

		if (mysqli_affected_rows($link) == 1) {
			$obj = array(
				'token' => $token,
				'islogged' => true
			);
		}else{
			$obj = array(
				'token' => null,
				'islogged' => false
			);
		}

	}else{
		$obj = array(
				'status' => 'Our records do not match your query',
				'islogged' => false
			);
	}

	echo json_encode($obj);

