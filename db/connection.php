<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "blogging";
  session_start(); // for session

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo "Connected successfully";
  
?>