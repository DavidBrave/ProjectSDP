<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    $query = "UPDATE Kurikulum SET Kurikulum_Nama = '$nama' WHERE Kurikulum_ID = '$id'";
    $conn->query($query);

    if($conn){
        $_SESSION['kurikulum']['id'] = $id;
        $_SESSION['kurikulum']['nama'] = $nama;
        echo "1";
    }else{
        echo "0";
    }
?>