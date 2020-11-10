<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];
        $ruangan = $_POST['ruangan'];

        $query = "INSERT INTO Jadwal_Kuliah VALUES ('$id', '$kelas', '$hari', '$mulai', '$selesai', '$ruangan')";
        $conn->query($query);

        if($conn){
            echo '<script language = "javascript">';
            echo "alert('Berhasil Insert Jadwal Kuliah dengan ID $id')";
            echo '</script>';
        }else{
            echo '<script language = "javascript">';
            echo "alert('Gagal Insert Jadwal Kuliah dengan ID $id')";
            echo '</script>';
        }
    }
    
    $conn->close();
?>