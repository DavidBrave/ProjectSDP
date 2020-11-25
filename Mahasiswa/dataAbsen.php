<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];

    $query = "SELECT a.Absen_Keterangan, a.Absen_Date, a.Hadir FROM Absen a, Kelas k, Matkul_Kurikulum mk, Matkul m
    WHERE a.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND mk.Matkul_Kurikulum_ID = '$id'";
    $absen = $conn->query($query);
    $ctr = 1;
    echo "<table style='width: 800px;'>";
    echo "<tr>";
    echo "<th>Minggu ke-</th>";
    echo "<th>Keterangan</th>";
    echo "<th>Tanggal</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    foreach ($absen as $key => $value) {
        echo "<tr>";
        echo "<td>$ctr</td>";
        echo "<td>$value[Absen_Keterangan]</td>";
        echo "<td>$value[Absen_Date]</td>";
        if($value['Hadir'] == 1){
            echo "<td><i class='material-icons'>check</i></td>";
        }else{
            echo "<td><i class='material-icons'>clear</i></td>";
        }
        echo "</tr>";
        $ctr++;
    }
    echo "</table>";
?>       