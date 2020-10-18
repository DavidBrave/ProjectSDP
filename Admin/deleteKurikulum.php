<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Kurikulum WHERE Kurikulum_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $temp['Kurikulum_Nama'];
        }

        $query = "DELETE FROM Kurikulum WHERE Kurikulum_ID = '$id'";
        $conn->query($query);

        

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Delete Kurikulum $nama";
            //echo 1;
        }else{
            $message = "Gagal Delete Kurikulum $nama";
            //echo 0;
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>