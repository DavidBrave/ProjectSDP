<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = "DELETE FROM Jadwal_Kuliah WHERE Jadwal_ID = '$id'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Delete Jadwal Kuliah dengan ID $id";
            //echo 1;
        }else{
            $message = "Gagal Delete Jadwal Kuliah dengan ID $id";
            //echo 0;
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>