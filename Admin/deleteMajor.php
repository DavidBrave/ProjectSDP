<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Major WHERE Major_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Major_Nama'];
        }

        $query = "DELETE FROM Major WHERE Major_ID = '$id'";
        $conn->query($query);

        $message = "";
        if($conn){
            $message = "Berhasil Delete Major $nama";
        }else{
            $message = "Gagal Delete Major $nama";
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>