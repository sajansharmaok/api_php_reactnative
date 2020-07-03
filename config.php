<?php
    //database configuration file
    $Host = "localhost";
    $DBname = "react_native";
    $Username = "root";
    $Password = "";

    $conn = new mysqli($Host, $Username, $Password,$DBname);
    
    if($conn->connect_errno){
        die("Invalid Database Connection");
    }

?>