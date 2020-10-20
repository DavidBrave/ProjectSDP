<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Jurusan WHERE Jurusan_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Jurusan_Nama'];
        }

        $query = "DELETE FROM Major WHERE Jurusan_ID = '$id'";
        $conn->query($query);
        $query = "DELETE FROM Matkul_Kurikulum WHERE Jurusan_ID = '$id'";
        $conn->query($query);
        $query = "DELETE FROM Jurusan WHERE Jurusan_ID = '$id'";
        $conn->query($query);

        $message = "";
        if($conn){
            $message = "Berhasil Delete Jurusan $nama";
        }else{
            $message = "Gagal Delete Jurusan $nama";
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>