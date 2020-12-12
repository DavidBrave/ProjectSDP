<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT mkl.Matkul_Kurikulum_ID, mk.Matkul_Nama, j.Jurusan_Nama, mkl.Major_ID, k.Kurikulum_Nama, p.Periode_Nama, mkl.Semester, mkl.sks FROM Matkul_Kurikulum mkl, Matkul mk, Jurusan j, Periode p, Kurikulum k 
    WHERE mkl.Matkul_ID = mk.Matkul_ID AND mkl.Jurusan_ID = j.Jurusan_ID AND mkl.Periode_ID = p.Periode_ID AND mkl.Kurikulum_ID = k.Kurikulum_ID AND mk.Matkul_Nama LIKE '%$nama%'";
    $listMatkulKurikulum = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($listMatkulKurikulum) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID Matkul Kurikulum</th>";
            echo "<th>Matkul</th>";
            echo "<th>Jurusan</th>";
            echo "<th>Major</th>";
            echo "<th>Kurikulum</th>";
            echo "<th>Periode</th>";
            echo "<th>Semester</th>";
            echo "<th>SKS</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($listMatkulKurikulum as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Matkul_Kurikulum_ID]</td>";
        echo "<td>$value[Matkul_Nama]</td>";
        echo "<td>$value[Jurusan_Nama]</td>";
        $MatkulKurikulumID = $value['Matkul_Kurikulum_ID'];
        $kurikulumNama = $value['Kurikulum_Nama'];
        $periodeNama = $value['Periode_Nama'];
        $semester = $value['Semester'];
        $sks = $value['sks'];
        if($value['Major_ID'] == "" || $value['Major_ID'] == "none"){
            echo "<td>Tidak Ada</td>";
        }else{
            $query = "SELECT Major_Nama FROM Major WHERE Major_ID = '$value[Major_ID]'";
            $major = $conn->query($query);
            foreach ($major as $key => $value) {
                echo "<td>$value[Major_Nama]</td>";
            }
        }
        echo "<td>$kurikulumNama</td>";
        echo "<td>$periodeNama</td>";
        echo "<td>$semester</td>";
        echo "<td>$sks</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 110px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idMatkul' value='$MatkulKurikulumID'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 110px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idMatkul' value='$MatkulKurikulumID'></form></td>";
        echo "</tr>";
    }

    $conn->close();
?>