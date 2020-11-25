<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $semester = 0;
        
        $nama = "";
        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$id'";
        $temp = $conn->query($query);
        foreach($temp as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
            $semester = $value['Mahasiswa_Semester'];
        }

        $query = "UPDATE FRS SET FRS_Status = 'Diterima' WHERE Mahasiswa_ID = '$id'";
        $conn->query($query);

        $query = "SELECT * FROM FRS WHERE Mahasiswa_ID = '$id'";
        $matkuls = $conn->query($query);
        foreach($matkuls as $key => $value) {
            $query = "INSERT INTO Pengambilan VALUES('', '$id', '', 0,0,0,0,'',0,0,1, $semester)";
            $conn->query($query);
        }

        $message = "Gagal Delete";
        if($conn){
            $message = "Berhasil Terima FRS Mahasiswa $nama";
        }else{
            $message = "Gagal Terima FRS Mahasiswa $nama";
        }
        
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $conn->close();
?>