<?php

    $con_server = "37.59.55.185";
    $con_username = "syrHdQKkXJ";
    $con_password = "pwtRRUcqFp";
    $con_database = "syrHdQKkXJ";

    $con_object = new mysqli($con_server, $con_username, $con_password, $con_database);
    if ($con_object->connect_error) {
        die("Failed: " . $con_object->connect_error);
    }

    $con_procedural = mysqli_connect($con_server, $con_username, $con_password, $con_database);
    if (!$con_procedural) {
        die("Failed : ".mysqli_connect_error());
    }

?>