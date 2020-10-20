<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT * FROM Praktikum WHERE Praktikum_Nama LIKE '%$nama%'";
    $listPraktikum = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($listPraktikum) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID Praktikum</th>";
            echo "<th>Nama Praktikum</th>";
            echo "<th>Mata Kuliah</th>";
            echo "<th>Jurusan</th>";
            echo "<th>Hari</th>";
            echo "<th>Ruangan</th>";
            echo "<th>Waktu</th>";
            echo "<th>Kapasitas</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($listPraktikum as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Praktikum_ID]</td>";
        echo "<td>$value[Praktikum_Nama]</td>";
        $praktikumId = $value['Praktikum_ID'];
        $matkulKurikulumId = $value['Matkulkurikulum_ID'];
        $hari = $value['Praktikum_Hari'];
        $ruangan = $value['Praktikum_Ruangan'];
        $waktu = substr($value['Praktikum_Jam_Mulai'],0,5)." - ".substr($value['Praktikum_Jam_Selesai'],0,5);
        $kapasitas = $value['Praktikum_Kapasitas'];
       
        $query = "SELECT * FROM Matkul_Kurikulum WHERE Matkul_Kurikulum_ID = '$matkulKurikulumId'";
        $listMatkulKurikulum = $conn->query($query);
        foreach ($listMatkulKurikulum as $key) {
            $idMatkul = $key['Matkul_ID'];
            $idJurusan = $key['Jurusan_ID'];

            $query = "SELECT * FROM Matkul";
            $listMatkul = $conn->query($query);
            foreach ($listMatkul as $key => $value) {
                if($value['Matkul_ID'] == $idMatkul){
                    $namaMatkul = $value['Matkul_Nama'];
                }
            }

            $query = "SELECT * FROM Jurusan";
            $listJurusan = $conn->query($query);
            foreach ($listJurusan as $key => $value) {
                if($value['Jurusan_ID'] == $idJurusan){
                    $namaJurusan = $value['Jurusan_Nama'];
                }
            }
        }
        echo "<td>$namaMatkul</td>";
        echo "<td>$namaJurusan</td>";
        echo "<td>$hari</td>";
        echo "<td>$ruangan</td>";
        echo "<td>$waktu</td>";
        echo "<td>$kapasitas</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 110px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='praktikumId' value='$praktikumId'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 110px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='praktikumId' value='$praktikumId'></form></td>";
        echo "</tr>";
    }

    $conn->close();
?>