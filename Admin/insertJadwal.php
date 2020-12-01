<?php
    require_once('../Required/Connection.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];
        $tanggal = $_POST['tanggal'];

        $id_count = 0;
        $jadwal_query = "SELECT * FROM Jadwal_Kuliah";
        $list_jadwal = $conn->query($jadwal_query);

        while ($jadwal = $list_jadwal->fetch_assoc()) {

            $ctr = null;
            $ctr = substr($jadwal['Jadwal_ID'], 3, 4);

            if ($id_count < (int) $ctr ) {
                $id_count = (int) $ctr;
            }
        }
    
        $interval = 7;
        for($i = 0 ; $i < 14 ; $i++) {
            $id_count += 1;
            $id = "JDL".str_pad($id_count, 4, "0", STR_PAD_LEFT);
            $query = "INSERT INTO Jadwal_Kuliah VALUES ('$id', '$kelas', '$hari', '$mulai', '$selesai', DATE_ADD('$tanggal', INTERVAL $interval DAY))";
            $conn->query($query);
            $interval += 7;
        }

        if($conn){
            echo '<script language = "javascript">';
            echo "alert('Berhasil Insert Jadwal Kuliah dengan ID $id')";
            echo '</script>';
        }else{
            echo '<script language = "javascript">';
            echo "alert('Gagal Insert Jadwal Kuliah dengan ID $id')";
            echo '</script>';
        }
    }
    
    $conn->close();
?>