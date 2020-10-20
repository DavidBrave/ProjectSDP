<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id_dosen'])){
        $id_dosen = $_POST['id_dosen'];
        $id_jabatan=$_POST['id_jabatan'];
        $nama = "";
        $query = "SELECT * FROM Dosen WHERE Dosen_ID = '$id_dosen'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Dosen_Nama'];
        }

        $query = "DELETE FROM Jabatan_Dosen WHERE Dosen_ID = '$id_dosen' AND Jabatan_ID='$id_jabatan'";
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