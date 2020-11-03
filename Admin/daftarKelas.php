<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT kls.Kelas_ID, kls.Kelas_Nama, mk.Matkul_Nama, j.Jurusan_Nama, d.Dosen_Nama, kls.Kelas_Ruangan, kls.Kelas_Kapasitas FROM Kelas kls, Matkul_Kurikulum mkl, Matkul mk, Jurusan j, Dosen d
    WHERE kls.Matkulkurikulum_ID = mkl.Matkul_Kurikulum_ID AND mkl.Matkul_ID = mk.Matkul_ID AND mkl.Jurusan_ID = j.Jurusan_ID AND kls.DosenPengajar_ID = d.Dosen_ID AND mk.Matkul_Nama LIKE '%$nama%'";
    $listKelas = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($listKelas) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID Kelas</th>";
            echo "<th>Nama</th>";
            echo "<th>Matkul</th>";
            echo "<th>Jurusan</th>";
            echo "<th>Dosen</th>";
            echo "<th>Ruangan</th>";
            echo "<th>Kapasitas</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($listKelas as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Kelas_ID]</td>";
        echo "<td>$value[Kelas_Nama]</td>";
        echo "<td>$value[Matkul_Nama]</td>";
        echo "<td>$value[Jurusan_Nama]</td>";
        echo "<td>$value[Dosen_Nama]</td>";
        echo "<td>$value[Kelas_Ruangan]</td>";
        echo "<td>$value[Kelas_Kapasitas]</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 110px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idKelas' value='$value[Kelas_ID]'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 110px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idKelas' value='$value[Kelas_ID]'></form></td>";
        echo "</tr>";
    }

    $conn->close();
?>