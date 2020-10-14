<?php

    //Jangan Diubah

    // $con_servername = "localhost";
    // $con_username = "root";
    // $con_password = "";
    // $con_database = "project_sdp";

    // $con_servername = "37.59.55.185";
    // $con_username = "syrHdQKkXJ";
    // $con_password = "pwtRRUcqFp";
    // $con_database = "syrHdQKkXJ";

    $con_servername = "185.232.14.1";
    $con_username = "u855625606_ProjectSDP";
    $con_password = "ProjectSDP2020";
    $con_database = "u855625606_ProjectSDP";

    $conn = new mysqli($con_servername, $con_username, $con_password, $con_database);
    if ($conn->connect_error) {
      die("Failed: " . $conn->connect_error);
    }

    $con_procedural = mysqli_connect($con_servername, $con_username, $con_password, $con_database);
    if (!$con_procedural) {
        die("Failed : ".mysqli_connect_error());
    }
    
?>