<?php
    require_once("../conn.php");

    if(isset($_POST['nrp'])){
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $dosen = $_POST['dosen'];

        $query = "INSERT INTO Mahasiswa VALUES ('$nrp','$dosen','','$nama','','','','','','','$nrp')";
        $conn->query($query);

        if($conn){
            echo 1;
        }else{
            echo 0;
        }
    }
?>