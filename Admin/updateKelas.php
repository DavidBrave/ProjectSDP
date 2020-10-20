<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $matkulkurikulum = $_POST['matkulkurikulum'];
    $dosen=$_POST['dosen'];
    $kapasitas=$_POST['kapasitas'];
    $ruangan=$_POST['ruangan'];
    $nama=$_POST['nama'];

    $query = "UPDATE Kelas SET Matkulkurikulum_ID = '$matkulkurikulum', DosenPengajar_ID='$dosen', Kelas_Nama='$nama', Kelas_Ruangan='$ruangan'
    , Kelas_Kapasitas='$kapasitas'WHERE Kelas_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>