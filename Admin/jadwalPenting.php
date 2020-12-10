<?php
session_start();
require_once('../Required/Connection.php');

$id = $_POST['id'];
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<?php
$query = "SELECT * FROM Jurusan";
$jurusan = $conn->query($query);
foreach ($jurusan as $key => $value) {
    $jurusanID = $value['Jurusan_ID'];
    echo "<h3>$value[Jurusan_Nama]</h3>";
?>
    <h4>Jadwal Quiz</h4>
    <table border="1" style="width: 500px;">
        <tr>
            <?php
            $query = "SELECT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m
            WHERE jp.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'quiz' AND mk.Jurusan_ID = '$jurusanID' AND mk.Periode_ID = '$id' ORDER BY Penting_Date";
            $listQuiz = $conn->query($query);
            if (mysqli_num_rows($listQuiz) == 0) {
                echo "<h5>Tidak ada data</h5>";
            } else {
                echo "<th>Matkul</th>";
                echo "<th>Tanggal</th>";
            }
            ?>
        </tr>
        <?php
        foreach ($listQuiz as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Matkul_Nama]</td>";
            echo "<td>$value[Penting_Date]</td>";
            echo "</tr>";
        }
        ?>
    </table><br><br>

    <h4>Jadwal UTS</h4>
    <table border="1" style="width: 500px;">
        <tr>
            <?php
            $query = "SELECT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m
            WHERE jp.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'uts' AND mk.Jurusan_ID = '$jurusanID' AND mk.Periode_ID = '$id' ORDER BY Penting_Date";
            $listUts = $conn->query($query);
            if (mysqli_num_rows($listUts) == 0) {
                echo "<h5>Tidak ada data</h5>";
            } else {
                echo "<th>Matkul</th>";
                echo "<th>Tanggal</th>";
            }
            ?>
        </tr>
        <?php
        foreach ($listUts as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Matkul_Nama]</td>";
            echo "<td>$value[Penting_Date]</td>";
            echo "</tr>";
        }
        ?>
    </table><br><br>

    <h4>Jadwal UAS</h4>
    <table border="1" style="width: 500px;">
        <tr>
            <?php
            $query = "SELECT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m
            WHERE jp.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'uas' AND mk.Jurusan_ID = '$jurusanID' AND mk.Periode_ID = '$id' ORDER BY Penting_Date";
            $listUas = $conn->query($query);
            if (mysqli_num_rows($listUas) == 0) {
                echo "<h5>Tidak ada data</h5>";
            } else {
                echo "<th>Matkul</th>";
                echo "<th>Tanggal</th>";
            }
            ?>
        </tr>
        <?php
        foreach ($listUas as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Matkul_Nama]</td>";
            echo "<td>$value[Penting_Date]</td>";
            echo "</tr>";
        }
        ?>
    </table><br><br><br><br>
<?php
}
?>