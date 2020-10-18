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
        $photo = $_POST['photo'];

        $query = "INSERT INTO Mahasiswa VALUES ('$nrp','$dosen','','$nama','$jk','$alamat','$tgl','$agama','$email','$nohp','$pass','$photo')";
        $conn->query($query);

        if($conn){
            echo '<script language = "javascript">';
            echo "alert('Berhasil Insert Mahasiswa $nama')";
            echo '</script>';
        }else{
            echo '<script language = "javascript">';
            echo "alert('Gagal Insert Mahasiswa $nama')";
            echo '</script>';
        }
    }
?>