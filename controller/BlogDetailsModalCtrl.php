<?php
    require_once ('../db/connection.php');

    $blg_id = $_POST['blog_id'];
    
    $qry ="SELECT * FROM blog_post WHERE id= '".$blg_id."'";
    $data =mysqli_query($conn, $qry);
    $data1 =mysqli_fetch_assoc($data);
    $alldata = [];
    if(sizeof($data1) >0){
        $alldata = [
            'blog_title'=>$data1['blog_title'],
            'blog_description'=>$data1['blog_desc'],
            'blog_photo'=>$data1['blog_photo'],
            'blog_category'=>$data1['blog_category'],
            'created_date_time'=>date("M d Y, h:i a", strtotime($data1['created_date_time']))
        ];
    }

    $qry1 = "SELECT blog_comment.*, user_info.user_name FROM blog_comment
    INNER JOIN user_info ON blog_comment.fk_user_id=user_info.id WHERE fk_post_id= '".$blg_id."'";
    $comment =mysqli_query($conn, $qry1);
    $allcomment = [];
    while($comment2 =mysqli_fetch_assoc($comment)){
        $allcomment[] = [
            'blog_comment'=>$comment2['comment'],
            'commented_by'=>$comment2['user_name'],
            'date_time'=>date("M d Y, h:i a", strtotime($comment2['commented_date_time']))
        ];
    }

    if (sizeof($data1) > 0){
        $return = ['success'=>"S", 'userdata'=>$alldata, 'comment'=>$allcomment];
    } else{
        $return = ['success'=>"E"];
    }
    
    echo json_encode($return);
?>