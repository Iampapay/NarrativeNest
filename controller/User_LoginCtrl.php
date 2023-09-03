<?php

	require_once('../db/connection.php');

	$uid = $_POST['user_name'];
	$pswd = $_POST['user_pass'];
    // print_r($_POST);die;

	$qry="SELECT * FROM user_info WHERE user_name='".$uid."' and user_pass='".$pswd."'";
	$data = mysqli_query($conn, $qry);
	
    if(mysqli_num_rows($data) == 1) {
    	$data2 = mysqli_fetch_assoc($data);
        $_SESSION["user_id"] = $data2['id'];
    	$return = ['success'=>"S", 'msg'=>"Login Successful"];
	} else {
		$return = ['success'=>"E", 'msg'=>"Invalid username or password"];
	}
    echo json_encode($return);

?> 

