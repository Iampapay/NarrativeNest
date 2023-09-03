<?php
	
    require_once ('../db/connection.php');
    // print_r($_SESSION);die;

    if(isset($_SESSION['user_id'])){
        $post_id = $_POST['post_id'];
        $user_comment= $_POST['comments'];
        $user_id = $_SESSION["user_id"];
        
        $qry = "INSERT INTO blog_comment (fk_post_id,comment,fk_user_id) VALUES('".$post_id."', '".$user_comment."', '".$user_id."')";
        $comment_insert = mysqli_query($conn, $qry);
    
                if($comment_insert){
                        $data = ['success'=>"S", 'msg'=>"comment done"];
                }else{
                        $data = ['success'=>"E", 'msg'=>"There is an error"];
                }
    } else{
        $data = ['success'=>"E", 'msg'=>"You have to signup first"];

    }

    echo json_encode($data);
	
?>