<?php

    require_once ('../db/connection.php');

    $username = $_POST["username"];
    $password = $_POST["password"];

    //check weather the username Exists
    $exist_qry = "SELECT * FROM user_info WHERE user_name = '".$username."'";
    $result = mysqli_query($conn, $exist_qry);
    $numExistRows = mysqli_num_rows( $result );
    if($numExistRows > 0){
        $data = ['success'=>"E", 'msg'=>"User name already exist"];
    }
    else {
            $qry = "INSERT INTO user_info (user_name,user_pass) VALUES('".$username."', '".$password."')";
	        $user_insert = mysqli_query($conn, $qry);

			if($user_insert){
					$data = ['success'=>"S", 'msg'=>"Signup Done"];
			} else{
					$data = ['success'=>"E", 'msg'=>"There is an error"];
            }
    }
              
    echo json_encode($data);
         
?>
