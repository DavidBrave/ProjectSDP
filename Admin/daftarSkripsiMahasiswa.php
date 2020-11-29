<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT m.Mahasiswa_ID, m.Mahasiswa_Nama, s.Judul_Skripsi FROM Skripsi s, Mahasiswa m, Jurusan j 
    WHERE s.Mahasiswa_ID = m.Mahasiswa_ID AND SUBSTR(m.Mahasiswa_ID, 4, 3) = SUBSTR(j.Jurusan_ID, 2, 3) AND j.Jurusan_ID = '$id' ORDER BY 1 ASC";
    $listSkripsi = $conn->query($query);
?>

<table style="width: 1000px;">
    <tr>
        <th>NRP</th>
        <th>Nama</th>
        <th>Judul Skripsi</th>
        <th>Detail</th>
    </tr>
    <?php
        foreach ($listSkripsi as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Mahasiswa_ID]</td>";
            echo "<td>$value[Mahasiswa_Nama]</td>";
            echo "<td>$value[Judul_Skripsi]</td>";
            echo "<td><form action='#' method='post'><button class='btn waves-effect blue lighten-1' type='submit' name='btnDetail' style='width: 100px;'>Detail</button><input type='hidden' name='mahasiswa' value='$value[Mahasiswa_ID]'></form></td>";
            echo "</tr>";
        }
    ?>
</table>