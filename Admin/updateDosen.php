<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jabatan = $_POST['jabatan'];
    $jabatan2=$_POST['jabatan2'];
    $photo = $_POST['photo'];

    if ($jabatan2!="none")
    {
        $query="SELECT Jabatan_ID FROM Jabatan WHERE Jabatan_Nama=$jabatan2 ";
        $result = $conn->query($query);
        $id_jabatan="";
        foreach($result as $key => $value) {
            $id_jabatan = $value['Jabatan_Nama'];
        }
        $query = "INSERT INTO Jabatan_Dosen VALUES('$id', '$id_jabatan')";
        $conn->query($query);
    }

    $query = "UPDATE Dosen SET Dosen_Nama = '$nama', Dosen_User = '$username', Dosen_Pass = '$password', Dosen_Jabatan = '$jabatan', Dosen_Photo = '$photo' WHERE Dosen_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>