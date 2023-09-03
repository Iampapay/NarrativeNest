<?php
    require_once ('../db/connection.php');
    
    $qry = "DELETE FROM blog_post WHERE id ='".$_POST['d_id']."'";
    $delete_blog = mysqli_query($conn, $qry);
    
        if ($delete_blog){
            $qry2 = "DELETE FROM blog_comment WHERE fk_post_id ='".$_POST['d_id']."'";
            $delete_comment = mysqli_query($conn, $qry2);

            if($delete_comment){
                $qry3 = "DELETE FROM rating_info WHERE fk_post_id ='".$_POST['d_id']."'";
                $delete_like = mysqli_query($conn, $qry3);

                if($delete_like){
                    $return = ['success'=>"S", 'msg'=>"Delete Successful"];
                }else{
                    $return = ['success'=>"E", 'msg'=>"Can not delete"];
                }
            }else{
                $return = ['success'=>"E", 'msg'=>"Can not delete"];
            }
        } else{
            $return = ['success'=>"E", 'msg'=>"Can not delete"];
        }
    
    echo json_encode($return);
?>