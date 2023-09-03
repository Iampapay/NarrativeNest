<?php
    require_once('../db/connection.php');

    $current_date_time = date('Y-m-d H:i:s');
    $b_title=$_POST['blg_title'];
    $b_desc=$_POST['blg_desc'];
    $photo= $_POST['old_pic'];
    $b_category =$_POST['blg_category'];
    $updated_id = $_POST['edit_id'];

    if($_FILES['update_photo']['name'] == '' && $photo == ''){
        $data = ['success'=>"E", 'msg'=>"Photo is required"];
    }else{
        if($_FILES['update_photo']['name'] != ''){
            $test = explode('.', $_FILES['update_photo']['name']);
            $extension = end($test);
            if ($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
                $post_photo = rand(100,999).'.'.$extension;		
                $location = '../uploads/'.$post_photo;
                move_uploaded_file($_FILES['update_photo']['tmp_name'], $location);
                    
                // Using unlink() function to delete old file
                $unlink_path = '../uploads/'.$photo;
                unlink($unlink_path);

                $qry = "UPDATE blog_post SET blog_title='".$b_title."',blog_desc='".$b_desc."',blog_photo='".$post_photo."',blog_category='".$b_category."',blog_status='D',user_type='A',created_date_time='".$current_date_time."' WHERE id= '".$updated_id."'";
                $update= mysqli_query($conn,$qry);
                if($update){
                    $data = ['success'=>"S", 'msg'=>"Blog Successfully updated"];
                } else {
                    $data = ['success'=>"E", 'msg'=>"There is an error"];
                }
            }else{
                $data = ['success'=>"E", 'msg'=>"File type does not match"];
            }
        } else {
            $post_photo = $photo; 
        }
         
    }
    
    echo json_encode($data);
?>