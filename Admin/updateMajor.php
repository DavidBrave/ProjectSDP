<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jurusan=$_POST['jurusan'];

    $query = "UPDATE Major SET Major_Nama = '$nama' Jurusan_ID='$jurusan' WHERE Major_ID = '$id'";
    $conn->query($query);

    if($conn){
        $_SESSION['major']['id'] = $id;
        $_SESSION['major']['nama'] = $nama;
        $_SESSION['major']['jurusan'] = $jurusan;
        echo "1";
    }else{
        echo "0";
    }
?>