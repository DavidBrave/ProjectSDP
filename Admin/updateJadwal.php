<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];

        $query = "UPDATE Jadwal_Kuliah SET Kelas_ID = '$kelas', Jadwal_hari = '$hari', Jadwal_Mulai = '$mulai', Jadwal_Selesai = '$selesai'
        WHERE Jadwal_ID = '$id'";
        $conn->query($query);

        if($conn){
            echo "1";
        }else{
            echo "0";
        }
    }

    $conn->close();
?>