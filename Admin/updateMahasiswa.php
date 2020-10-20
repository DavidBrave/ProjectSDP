<?php
    session_start();
    require_once('../Required/Connection.php');
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $wali = $_POST['wali'];
    $pembimbing = $_POST['pembimbing'];
    $tgl = $_POST['tgl'];
    $gender = $_POST['gender'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $email = $_POST['email'];
    $noHp = $_POST['noHp'];
    $photo = $_POST['photo'];
    $password = $_POST['password'];

    $query = "UPDATE Mahasiswa SET Mahasiswa_Nama = '$nama', Dosen_Wali_ID = '$wali', Dosen_Pembimbing_ID = '$pembimbing', Mahasiswa_Tgl = '$tgl', 
    Mahasiswa_Alamat = '$alamat', Mahasiswa_Agama = '$agama', Mahasiswa_Pass = '$password', Mahasiswa_JK = '$gender', 
    Mahasiswa_Email = '$email', Mahasiswa_NoTelp = '$noHp', Mahasiswa_Photo = '$photo' WHERE Mahasiswa_ID = '$nrp'";
    $conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>