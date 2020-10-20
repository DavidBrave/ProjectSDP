<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT * FROM Jurusan WHERE Jurusan_Nama LIKE '%$nama%'";
    $listJurusan = $conn->query($query);

    $count = mysqli_num_rows($listJurusan);

    if ($count > 0) {
        ?>
        <tr>
            <?php
                if(mysqli_num_rows($listJurusan) == 0){
                    echo "<h4>Tidak ada data</h4>";
                }else{
                    echo "<th>ID Jurusan</th>";
                    echo "<th>Nama Jurusan</th>";
                    echo "<th>Update</th>";
                    echo "<th>Delete</th>";
                }
            ?>
        </tr>
        
        <?php
            foreach ($listJurusan as $key => $value) {
                echo "<tr>";
                echo "<td>$value[Jurusan_ID]</td>";
                echo "<td>$value[Jurusan_Nama]</td>";
                echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idJurusan' value='$value[Jurusan_ID]'></form></td>";
                echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idJurusan' value='$value[Jurusan_ID]'></form></td>";
                echo "</tr>";
            }
        }
    else {
        echo "<h4>Data Tidak Ditemukan</h4>";
    }
    
    $conn->close();
?>