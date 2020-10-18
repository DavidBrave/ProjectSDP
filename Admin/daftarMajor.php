<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT * FROM Major WHERE Major_Nama LIKE '%$nama%'";
    $listMajor = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($listMajor) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID Major</th>";
            echo "<th>Major</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($listMajor as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Major_ID]</td>";
        echo "<td>$value[Major_Nama]</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idMajor' value='$value[Major_ID]'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idMajor' value='$value[Major_ID]'></form></td>";
        echo "</tr>";
    }

    $conn->close();
?>