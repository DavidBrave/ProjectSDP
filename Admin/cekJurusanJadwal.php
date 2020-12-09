<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];

    $query = "SELECT * FROM Jadwal_Pengisian_FRS WHERE id = 1";
    $periode = mysqli_fetch_array($conn->query($query));
    $periodeID = $periode['Periode_ID'];

    $query = "SELECT DISTINCT k.Kelas_Nama, k.Kelas_Ruangan, m.Matkul_Nama, k.Kelas_ID
    FROM Matkul_Kurikulum mk, Matkul m, Kelas k
    WHERE k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID
    AND mk.Jurusan_ID = '$id' 
    AND mk.Matkul_ID = m.Matkul_ID AND mk.Periode_ID = '$periodeID'";
    $jadwal = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<select name="kelas" id="kelas" onchange="gantiKelas()">
    <option value="none" disabled selected>Pilih Kelas</option>
    <?php
        foreach ($jadwal as $key => $value) {
            echo "<option value='" . $value['Kelas_ID'] . "'>" . $value['Matkul_Nama'] . " - " . $value['Kelas_Ruangan'] . " - " . $value['Kelas_Nama'] . "</option>";
        }
    ?>
</select>