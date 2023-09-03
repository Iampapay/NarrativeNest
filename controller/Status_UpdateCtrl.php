<?php

    require_once ('../db/connection.php');

    $b_id =$_POST['blog_id'];
    $b_status =$_POST['blog_status'];

    $qry = "UPDATE blog_post SET blog_status='".$b_status."' WHERE id='".$b_id."'";
    $status_update = mysqli_query($conn,$qry);
    if($status_update){
        if($b_status == 'P'){
            $update = ['success' =>"S", 'msg'=>"Blog activated"];
        }else{
            $update = ['success' =>"E", 'msg'=>"Blog inactivated"];
        }
    }
    echo json_encode($update);

?>