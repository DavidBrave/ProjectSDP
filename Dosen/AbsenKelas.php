<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['kelas'])){
        $kelas = $_POST['kelas'];
    }else{
        $kelas = "";
    }

    $query = "SELECT a.Absen_Date, a.Hadir, m.Mahasiswa_Nama
    FROM Absen a, Mahasiswa m 
    WHERE a.Kelas_ID = '$kelas'
    AND m.Mahasiswa_ID = a.Mahasiswa_ID";
    $listAbsen = $conn->query($query);

    $count = mysqli_num_rows($listAbsen);

    if ($count > 0) {
        ?>
        <table border=1>
        <tr>
            <?php
                if(mysqli_num_rows($listAbsen) == 0){
                    echo "<h4>Tidak ada data</h4>";
                }else{
                    echo "<th>Nama Mahasiswa</th>";
                    echo "<th>Tanggal</th>";
                    echo "<th>Kehadiran</th>";
                }
            ?>
        </tr>

        <?php
            foreach ($listAbsen as $key => $value) {
                echo "<tr>";
                echo "<td>$value[Mahasiswa_Nama]</td>";
                echo "<td>$value[Absen_Date]</td>";
                if ($value['Hadir'] == 1) {
                    echo "<td><input type='checkbox' class='matkul' checked disabled><span></span></td>";
                }
                else {
                    echo "<td><input type='checkbox' class='matkul' disabled><span></span></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    else {
        echo "<h4>Data Tidak Ditemukan</h4>";
    }

    $conn->close();
?>