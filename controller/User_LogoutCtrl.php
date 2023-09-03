<?php

require_once ('../db/connection.php');

// for user logout
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    session_destroy();
    header('location: ../view/index.php');
}

?>