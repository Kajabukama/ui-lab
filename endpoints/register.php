<?php

	header("Access-Control-Allow-Origin: *");

	require_once "Services/Twilio.php";
	require_once 'db_connect.php';
	require_once "core.php";


	$sid = 'AC704e2243741d245cc450f5dcd929516c';
    $token = '';

    $client = new Services_Twilio($sid,$token);
    $from = 'example';

	

	$data = json_decode(file_get_contents('php://input'));

	$name = clean($data->name);
	$phone = prepare(clean($data->mobile));
	$email = clean($data->email);
	$password = sha1(clean($data->password));
	$token = generate(6);

	$query = "INSERT INTO users(name,phone,email,password,code) VALUES('$name','$phone','$email','$password','$token')";
	$result = mysqli_query($link, $query);

	$obj = array();
	
	$sms = "Dear {$name} use this code : {$token} to unlock your account";

	if (mysqli_affected_rows($link) == 1) {
		$send = $client->account->messages->sendMessage($from,$phone,$sms);
		if ($send) {
			$obj = array('status'=>true,'sms'=>'SMS sent');
		}else{
			$obj = array('status'=>false,'sms'=>'SMS not sent');
		}
	}

	echo json_encode($obj);

