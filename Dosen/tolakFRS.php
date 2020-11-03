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

        $query = "UPDATE Ambil SET Ambil_Status = 'Ditolak' WHERE Mahasiswa_ID = '$id'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Tolak FRS Mahasiswa $nama";
        }else{
            $message = "Gagal Tolak FRS Mahasiswa $nama";
        }
        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>