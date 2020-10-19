<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
        }

        $query = "DELETE FROM Sidang_Skripsi WHERE Mahasiswa_ID ='$id'";
        $conn->query($query);
        $query = "DELETE FROM Chat WHERE Mahasiswa_ID ='$id'";
        $conn->query($query);
        $query = "DELETE FROM Absen WHERE Mahasiswa_ID ='$id'";
        $conn->query($query);
        $query = "DELETE FROM Pengambilan WHERE Mahasiswa_ID ='$id'";
        $conn->query($query);
        $query = "DELETE FROM Mahasiswa WHERE Mahasiswa_ID = '$id'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Delete Mahasiswa $nama";
        }else{
            $message = "Gagal Delete Mahasiswa $nama";
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>