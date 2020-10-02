<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = "UPDATE Jurusan SET Jurusan_Nama = '$nama' WHERE Jurusan_ID = '$id'";
    $conn->query($query);

    if($conn){
        $_SESSION['jurusan']['nama'] = $nama;
        echo "1";
    }else{
        echo "0";
    }
?>