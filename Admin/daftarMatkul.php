<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT * FROM Matkul WHERE Matkul_Nama LIKE '%$nama%'";
    $listMatkul = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($listMatkul) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID Matkul</th>";
            echo "<th>Nama</th>";
            echo "<th>Nilai Standar</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($listMatkul as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Matkul_ID]</td>";
        echo "<td>$value[Matkul_Nama]</td>";
        echo "<td>$value[Matkul_Standar]</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idMatkul' value='$value[Matkul_ID]'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idMatkul' value='$value[Matkul_ID]'></form></td>";
        echo "</tr>";
    }
?>