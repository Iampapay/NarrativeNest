<?php
require_once('../db/connection.php');

$edit_id=$_POST['edit_id'];
    
    $qry = "SELECT * FROM blog_post WHERE id='".$edit_id."'";
    $data=mysqli_query($conn,$qry);
    $data1=mysqli_fetch_assoc($data);
    echo json_encode($data1);
?>

