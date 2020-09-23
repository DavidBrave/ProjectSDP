<?php

    //Jangan Diubah

    $con_servername = "37.59.55.185";
    $con_username = "syrHdQKkXJ";
    $con_password = "pwtRRUcqFp";
    $con_database = "syrHdQKkXJ";

    $con = new mysqli($con_servername, $con_username, $con_password, $con_database);
    if ($con->connect_error) {
      die("Failed: " . $conn->connect_error);
    }

    $con_procedural = mysqli_connect($con_servername, $con_username, $con_password, $con_database);
    if (!$con_procedural) {
        die("Failed : ".mysqli_connect_error());
    }

?>