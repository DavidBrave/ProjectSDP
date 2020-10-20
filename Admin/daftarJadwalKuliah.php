<?php
    require_once('../Required/Connection.php');
    
    $query = "SELECT * FROM Jadwal_Kuliah";
    $list_jadwal = $conn->query($query);
?>
<tr>
    <?php
        if(mysqli_num_rows($list_jadwal) == 0){
            echo "<h4>Tidak ada data</h4>";
        }else{
            echo "<th>ID</th>";
            echo "<th>Kelas</th>";
            echo "<th>Hari</th>";
            echo "<th>Jam Mulai</th>";
            echo "<th>Jam Selesai</th>";
            echo "<th>Update</th>";
            echo "<th>Delete</th>";
        }
    ?>
</tr>

<?php
    foreach ($list_jadwal as $key => $value) {
        echo "<tr>";
        echo "<td>$value[Jadwal_ID]</td>";
        echo "<td>$value[Kelas_ID]</td>";
        echo "<td>$value[Jadwal_Hari]</td>";
        echo "<td>$value[Jadwal_Mulai]</td>";
        echo "<td>$value[Jadwal_Selesai]</td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='hidId' value='$value[Jadwal_ID]'></form></td>";
        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' id='$value[Jadwal_ID]' onClick='DeleteClick(this.id)' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='hidId' value='$value[Jadwal_ID]'></form></td>";
        echo "</tr>";
    }

    $conn->close();
?>