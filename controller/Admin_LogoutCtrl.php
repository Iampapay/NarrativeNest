<?php

require_once ('../db/connection.php');

// for admin logout 
if(isset($_SESSION['admin_id'])){
    unset($_SESSION['admin_id']);
    session_destroy();
    header('location: ../view/index.php');
}

?>