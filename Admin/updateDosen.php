<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jabatan = $_POST['jabatan'];
    $photo = $_POST['photo'];

    if ($jabatan != "")
    {
        $query = "INSERT INTO Jabatan_Dosen VALUES(null, '$id', '$jabatan')";
        $conn->query($query);
    }

    $query = "UPDATE Dosen SET Dosen_Nama = '$nama', Dosen_User = '$username', Dosen_Pass = '$password', Dosen_Photo = '$photo' WHERE Dosen_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>
