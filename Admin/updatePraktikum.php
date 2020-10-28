<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $matkulkurikulum = $_POST['matkulkurikulum'];
    $nama=$_POST['nama'];
    $hari=$_POST['hari'];
    $ruangan=$_POST['ruangan'];
    $mulai=$_POST['mulai'];
    $selesai=$_POST['selesai'];
    $kapasitas=$_POST['kapasitas'];
    $standar=$_POST['standar'];

    $query = "UPDATE Praktikum SET Matkulkurikulum_ID = '$matkulkurikulum', Praktikum_Nama='$nama', Praktikum_Hari='$hari', Praktikum_Jam_Mulai='$mulai', Praktikum_Jam_Selesai='$selesai', Praktikum_Standar=$standar WHERE Praktikum_ID = '$id'";
    $conn->query($query);

    $query = "UPDATE Matkul_Kurikulum SET Praktikum_ID = '' WHERE Praktikum_ID = '$id'";
    $conn->query($query);

    $query = "UPDATE Matkul_Kurikulum SET Praktikum_ID = '$id' WHERE Matkul_Kurikulum_ID = '$matkulkurikulum'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>