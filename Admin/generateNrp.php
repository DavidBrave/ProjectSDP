<?php
    require_once('../Required/Connection.php');
    $jurusan = $_POST['jurusan'];
    $tahun = $_POST['tahun'];
    $nohp = $_POST['nohp'];
    $query = "SELECT * FROM Mahasiswa WHERE SUBSTR(Mahasiswa_ID,4,3) = '$jurusan'";
    $list = $conn->query($query);
    if(mysqli_num_rows($list) < 10){
        $kdjurusan = mysqli_num_rows($list) + 1;
        echo "<input disabled type='text' id='nrp' value='".$tahun.$jurusan."000".$kdjurusan."'>";
    }else if(mysqli_num_rows($list) > 9 && mysqli_num_rows($list) < 100){
        $kdjurusan = mysqli_num_rows($list) + 1;
        echo "<input disabled type='text' id='nrp' value='".$tahun.$jurusan."00".$kdjurusan."'>";
    }else if(mysqli_num_rows($list) > 99 && mysqli_num_rows($list) < 1000){
        $kdjurusan = mysqli_num_rows($list) + 1;
        echo "<input disabled type='text' id='nrp' value='".$tahun.$jurusan."0".$kdjurusan."'>";
    }else{
        $kdjurusan = mysqli_num_rows($list) + 1;
        echo "<input disabled type='text' id='nrp' value='".$tahun.$jurusan.$kdjurusan."'>";
    }

    $conn->close();
?>