<?php
	
    require_once ('../db/connection.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION["user_id"];
        $user_name = $_POST['u_name'];
        $user_email= $_POST['u_email'];
        $user_msg= $_POST['u_massage'];
        // print_r($_SESSION);die;
        
        $qry = "INSERT INTO user_massage (fk_user_id,u_name,user_email,user_massage) VALUES('".$user_id."', '".$user_name."', '".$user_email."', '".$user_msg."')";
        $massage_insert = mysqli_query($conn, $qry);
    
                if($massage_insert){
                        $data = ['success'=>"S", 'msg'=>"massage sent"];
                }else{
                        $data = ['success'=>"E", 'msg'=>"There is an error"];
                }
    } else{
        $data = ['success'=>"E", 'msg'=>"You have to signup first"];

    }

    echo json_encode($data);
	
?>