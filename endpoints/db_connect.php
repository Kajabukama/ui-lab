<?php

	$link = mysqli_connect("localhost","root","root","demo_db");
	if (!$link) {
		die("Sorry there was an error :".mysqli_error($link));
	}