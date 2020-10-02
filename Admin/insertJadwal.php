<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];

        $query = "INSERT INTO Jadwal_Kuliah VALUES ('$id', '$kelas', '$hari', '$mulai', '$selesai')";
        $conn->query($query);

        if($conn){
            echo 1;
        }else{
            echo 0;
        }
    }
?>