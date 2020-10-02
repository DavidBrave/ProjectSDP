<?php
    session_start();
    require_once('../Required/Connection.php');
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $wali = $_POST['wali'];
    $pembimbing = $_POST['pembimbing'];
    $tgl = $_POST['tgl'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $email = $_POST['email'];
    $noHp = $_POST['noHp'];

    $query = "UPDATE Mahasiswa SET Mahasiswa_Nama = '$nama', Dosen_Wali_ID = '$wali', Dosen_Pembimbing_ID = '$pembimbing', Mahasiswa_Tgl = '$tgl', 
    Mahasiswa_Alamat = '$alamat', Mahasiswa_Agama = '$agama', Mahasiswa_Email = '$email', Mahasiswa_NoTelp = '$noHp' WHERE Mahasiswa_ID = '$nrp'";
    $conn->query($query);

    if($conn){
        $_SESSION['mahasiswa']['wali'] = $wali;
        $_SESSION['mahasiswa']['pembimbing'] = $pembimbing;
        $_SESSION['mahasiswa']['nama'] = $nama;
        $_SESSION['mahasiswa']['alamat'] = $alamat;
        $_SESSION['mahasiswa']['tgl'] = $tgl;
        $_SESSION['mahasiswa']['agama'] = $agama;
        $_SESSION['mahasiswa']['email'] = $email;
        $_SESSION['mahasiswa']['noHp'] = $noHp;
        echo "1";
    }else{
        echo "0";
    }
?>