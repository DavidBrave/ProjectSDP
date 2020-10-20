<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT * FROM Dosen WHERE Dosen_Nama LIKE '%$nama%'";
    $listDosen = $conn->query($query);

    $count = mysqli_num_rows($listDosen);

    if ($count > 0) {
        ?>
        <tr>
            <?php
                if(mysqli_num_rows($listDosen) == 0){
                    echo "<h4>Tidak ada data</h4>";
                }else{
                    echo "<th>ID Dosen</th>";
                    echo "<th>Nama</th>";
                    echo "<th>Username</th>";
                    echo "<th>Password</th>";
                    echo "<th>Jabatan</th>";
                    echo "<th>Update</th>";
                    echo "<th>Delete</th>";
                }
            ?>
        </tr>

        <?php
            foreach ($listDosen as $key => $value) {
                echo "<tr>";
                echo "<td>$value[Dosen_ID]</td>";
                echo "<td>$value[Dosen_Nama]</td>";
                echo "<td>$value[Dosen_User]</td>";
                echo "<td>$value[Dosen_Pass]</td>";
                echo "<td>$value[Dosen_Jabatan]</td>";
                echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idDosen' value='$value[Dosen_ID]'></form></td>";
                echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idDosen' value='$value[Dosen_ID]'></form></td>";
                echo "</tr>";
            }
        }
    else {
        echo "<h4>Data Tidak Ditemukan</h4>";
    }

    $conn->close();
?>