<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $matkul = $_POST['matkul'];
        
        $nama = "";
        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
        }

        $query = "DELETE FROM FRS WHERE Mahasiswa_ID = '$id' AND Matkul_Kurikulum_ID = '$matkul'";
        $conn->query($query);

        $query = "SELECT k.Kelas_ID FROM Kelas k, Pengambilan p WHERE k.Kelas_ID = p.Kelas_ID AND p.Mahasiswa_ID = '$id' AND k.Matkulkurikulum_ID = '$matkul'";
        $temp = $conn->query($query);
        $kelas = "";
        foreach($temp as $key => $value) {
            $kelas = $value['Kelas_ID'];
        }

        $query = "DELETE FROM Pengambilan WHERE Mahasiswa_ID = '$id' AND Kelas_ID = '$kelas'";

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Terima Batal Mahasiswa $nama";
        }else{
            $message = "Gagal Terima Batal Mahasiswa $nama";
        }
        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>