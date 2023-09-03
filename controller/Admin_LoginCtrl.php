<?php

    require_once ('../db/connection.php');

    $admin_id = $_POST['user_name'];
    $pass_word = $_POST['admin_pass'];
        

        $sql = "SELECT * FROM admin_log WHERE user_name ='".$admin_id."' AND password ='".$pass_word."'";
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_fetch_assoc($result);
        $num = mysqli_num_rows($result);

        if($num ==1){
            $return = ['success'=>"S", 'msg'=>"Login Successful"];
            $_SESSION["admin_id"] = $result2['id'];
        }else{
            $return = ['success'=>"E", 'msg'=>"Invalid user id or password"];
        }
        
        echo json_encode($return);
    
?>
