<?php

require_once('../db/connection.php');

if(isset($_SESSION['user_id'])){
  $user_id =$_SESSION['user_id'];
}else{
  $user_id = '';
}

$blog_id=$_POST['bg_id'];

$is_liked_qry = "SELECT * FROM rating_info WHERE fk_user_id='".$user_id."' AND fk_post_id='".$blog_id."' AND rating_action='Like'";
$is_liked_data_obj = mysqli_query($conn, $is_liked_qry);

if(mysqli_num_rows($is_liked_data_obj) > 0) {
    $data1 = ['success'=>"E", 'msg'=>"You can't like a blog twice"];
}else{
    if(isset($_SESSION['user_id'])){
        $qry= "INSERT INTO rating_info (fk_user_id,fk_post_id,rating_action) VALUES('".$user_id."', '".$blog_id."','Like')";
        $data= mysqli_query($conn, $qry);
        if($data){
            $qry1="SELECT count(*) as total FROM rating_info WHERE fk_post_id = '".$blog_id."'";
            $like=mysqli_query($conn, $qry1);
            $l_array=mysqli_fetch_assoc($like);
            $data1 = ['success'=>"S", 'msg'=>"You liked the post", 'total_like'=>$l_array['total']];
        }else{
            $data1 = ['success'=>"E", 'msg'=>"Error occure"];
        }
    } else{
      $data1 = ['success'=>"E", 'msg'=>"You have to signup first"];
    }
}

echo json_encode($data1);

?>