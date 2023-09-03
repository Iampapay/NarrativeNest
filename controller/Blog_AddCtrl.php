<?php
	
    require_once ('../db/connection.php');
    // print_r($_FILES);die;
    
    $b_title = $_POST['title'];
	$b_description = $_POST['desc'];
    $b_category = $_POST['category'];


    if(isset($_FILES['picture']['name'])){
        $test = explode('.', $_FILES['picture']['name']);
        $extension = end($test);
        if ($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg'){
            $b_photo = rand(100,999).'.'.$extension;		
            $location = '../uploads/'.$b_photo;
            move_uploaded_file($_FILES['picture']['tmp_name'], $location);
            $qry = "INSERT INTO blog_post (blog_title,blog_desc,blog_photo,blog_category,blog_status,user_type) VALUES('".$b_title."', '".$b_description."', '".$b_photo."','".$b_category."','D','A')";
	        $post_insert = mysqli_query($conn, $qry);

            if($post_insert){
                $data = ['success'=>"S", 'msg'=>"Content Successfully Saved"];
            }else{
                $data = ['success'=>"E", 'msg'=>"sorry,There is an error"];
            }
        } else{
            $data = ['success'=>"E", 'msg'=>"File type does not match"];
        }
    } else {
        $b_photo = '';
    }

    echo json_encode($data);
	
?>