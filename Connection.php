<?php

    $con_server = "37.59.55.185";
    $con_username = "syrHdQKkXJ";
    $con_password = "pwtRRUcqFp";

    $con = mysqli_connect($con_server, $con_username, $con_password);

    if (!$con) {
        die("Failed : ".mysqli_connect_error());
    }

?>