<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $matkul = $_POST['matkul'];
        
        $nama = "";
        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
        }

        $query = "UPDATE FRS SET FRS_Status = 'Diterima' WHERE Mahasiswa_ID = '$id' AND Matkul_Kurikulum_ID = '$matkul'";
        $conn->query($query);

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Terima Batal Mahasiswa $nama";
        }else{
            $message = "Gagal Terima Batal Mahasiswa $nama";
        }
        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>