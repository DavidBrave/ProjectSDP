<?php
    session_start();
    require_once('../Required/Connection.php');
    $dosen = $_POST['dosen'];
    $query = "SELECT sum(mk.SKS) FROM Matkul_Kurikulum mk,Kelas k WHERE k.DosenPengajar_ID=$dosen AND k.MatkulKurikulum_ID=mk.Matkul_Kurikulum_ID ";
    $_SESSION['report']['sksDosen']=$conn->query($query);

    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>
