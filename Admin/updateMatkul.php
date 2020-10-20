<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $standar=$_POST['standar'];

    $query = "UPDATE Matkul SET Matkul_Nama = '$nama', Matkul_Standar='$standar' WHERE Matkul_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>