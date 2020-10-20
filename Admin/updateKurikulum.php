<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = "UPDATE Kurikulum SET Kurikulum_Nama = '$nama' WHERE Kurikulum_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>