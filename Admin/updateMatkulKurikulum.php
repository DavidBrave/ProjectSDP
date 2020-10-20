<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $matkul = $_POST['matkul'];
    $jurusan=$_POST['jurusan'];
    $major=$_POST['major'];
    $kurikulum=$_POST['kurikulum'];
    $periode=$_POST['periode'];
    $semester=$_POST['semester'];
    $sks=$_POST['sks'];

    $query = "UPDATE Matkul_Kurikulum SET Matkul_Kurikulum_ID = '$id', Matkul_ID='$matkul', Jurusan_ID='$jurusan', Major_ID='$major'
    , Kurikulum_ID='$kurikulum', Periode_ID='$periode', Semester=$semester, SKS=$sks WHERE Matkul_Kurikulum_ID = '$id'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>