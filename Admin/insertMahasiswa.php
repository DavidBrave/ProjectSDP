<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['nrp'])){
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $dosen = $_POST['dosen'];
        $tgl = $_POST['tgl'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $agama = $_POST['agama'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $pass = $_POST['pass'];

        $query = "INSERT INTO Mahasiswa VALUES ('$nrp','$dosen','','$nama','$jk','$alamat','$tgl','$agama','$email','$nohp','$pass','')";
        $conn->query($query);

        if($conn){
            echo 1;
        }else{
            echo 0;
        }
    }
?>