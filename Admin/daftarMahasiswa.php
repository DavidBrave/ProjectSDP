<?php
    require_once('../Required/Connection.php');
    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    $query = "SELECT m.*, d.Dosen_Nama FROM Mahasiswa m, Dosen d WHERE m.Dosen_Wali_ID = d.Dosen_ID AND m.Mahasiswa_Nama LIKE '%$nama%'";
    $listMahasiswa = $conn->query($query);

    $count = mysqli_num_rows($listMahasiswa);

    if ($count > 0) {
        ?>
        <tr>
            <?php
                if(mysqli_num_rows($listMahasiswa) == 0){
                    echo "<h4>Tidak ada data</h4>";
                }else{
                    echo "<th>NRP</th>";
                    echo "<th>Nama</th>";
                    echo "<th>Dosen Wali</th>";
                    echo "<th>Alamat</th>";
                    echo "<th>Email</th>";
                    echo "<th>No Telp</th>";
                    echo "<th>Update</th>";
                    echo "<th>Delete</th>";
                }
            ?>
        </tr>
        <?php
        foreach ($listMahasiswa as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Mahasiswa_ID]</td>";
                echo "<td>$value[Mahasiswa_Nama]</td>";
                echo "<td>$value[Dosen_Nama]</td>";
                echo "<td>$value[Mahasiswa_Alamat]</td>";
                echo "<td>$value[Mahasiswa_Email]</td>";
                echo "<td>$value[Mahasiswa_NoTelp]</td>";
            echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idMahasiswa' value='$value[Mahasiswa_ID]'></form></td>";
            echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' id='$value[Mahasiswa_ID]' onClick='DeleteClick(this.id)' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' id='Nama$value[Mahasiswa_ID]' name='idMahasiswa' value='$value[Mahasiswa_Nama]'></form></td>";
            echo "</tr>";
        }
    }
    else {
        echo "<h4>Data Tidak Ditemukan</h4>";
    }

    $conn->close();
?>