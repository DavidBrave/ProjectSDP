<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jabatan = $_POST['jabatan'];
    $photo = $_POST['photo'];

    $query = "UPDATE Dosen SET Dosen_Nama = '$nama', Dosen_User = '$username', Dosen_Pass = '$password', Dosen_Jabatan = '$jabatan', Dosen_Photo = '$photo' WHERE Dosen_ID = '$id'";
    $conn->query($query);

    if($conn){
        $_SESSION['dosen']['nama'] = $nama;
        $_SESSION['dosen']['username'] = $username;
        $_SESSION['dosen']['password'] = $password;
        $_SESSION['dosen']['jabatan'] = $jabatan;
        $_SESSION['dosen']['photo'] = $photo;
        echo "1";
    }else{
        echo "0";
    }
?>