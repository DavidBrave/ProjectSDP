<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = "DELETE FROM Kurikulum WHERE Kurikulum_ID = '$id'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Delete";
            //echo 1;
        }else{
            $message = "Gagal Delete";
            //echo 0;
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>