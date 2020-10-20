<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Dosen WHERE Dosen_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Dosen_Nama'];
        }

        $query = "DELETE FROM Sidang_Skripsi WHERE Dosen_Pengamat_ID = '$id'";
        $conn->query($query);
        $query = "UPDATE Mahasiswa SET Dosen_Wali_ID = '' WHERE Dosen_Wali_ID = '$id'";
        $conn->query($query);
        $query = "UPDATE Mahasiswa SET Dosen_Pembimbing_ID = '' WHERE Dosen_Pembimbing_ID = '$id'";
        $conn->query($query);
        $query = "DELETE FROM Dosen WHERE Dosen_ID = '$id'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Delete Dosen $nama";
        }else{
            $message = "Gagal Delete Dosen $nama";
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>