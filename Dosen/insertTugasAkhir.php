<?php
    require_once('../Required/Connection.php');

    $penguji1 = $_POST['penguji1'];
    $penguji2 = $_POST['penguji2'];
    $penguji3 = $_POST['penguji3'];
    $mahasiswa = $_POST['mahasiswa'];
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    $ruangan = $_POST['ruangan'];

    $query = "INSERT INTO Skripsi VALUES('', '$penguji1', '$penguji2', '$penguji3', '$mahasiswa', '$judul', '$tanggal', '$mulai', '$selesai', '$ruangan')";
    $conn->query($query);

    $conn->close();
?>