<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        
        $nama = "";
        $query = "SELECT * FROM Matkul WHERE Matkul_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Matkul_Nama'];
        }

        $query = "DELETE FROM Matkul WHERE Matkul_ID = '$id'";
        $conn->query($query);

        $message = "";
        if($conn){
            $message = "Berhasil Delete Mata Kuliah $nama";
        }else{
            $message = "Gagal Delete Mata Kuliah $nama";
        }

        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>