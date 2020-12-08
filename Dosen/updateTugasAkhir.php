<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['idSkripsi'])){
        $id = $_POST['idSkripsi'];
        $penguji1 = $_POST['penguji1'];
        $penguji2 = $_POST['penguji2'];
        $penguji3 = $_POST['penguji3'];
        $judul = $_POST['judul'];
        $tanggal = $_POST['tanggal'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];
        $ruangan = $_POST['ruangan'];

        $query = "UPDATE Skripsi 
        SET Dosen_Penguji1 = '$penguji1', 
        Dosen_Penguji2 = '$penguji2', 
        Dosen_Penguji3 = '$penguji3', 
        Judul_Skripsi = '$judul', 
        Tanggal_Skripsi = '$tanggal', 
        Jam_Mulai = '$mulai', 
        Jam_Selesai = '$selesai', 
        Ruangan_Skripsi = '$ruangan' 
        WHERE Skripsi_ID = $id";
        $conn->query($query);
    }

    $conn->close();
?>