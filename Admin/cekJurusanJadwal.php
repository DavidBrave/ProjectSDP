<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT DISTINCT jk.Jadwal_ID, m.Matkul_Nama, k.Kelas_Nama, p.Periode_Nama FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Periode p, Jadwal_Kuliah jk 
    WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Periode_ID = p.Periode_ID AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID AND k.Kelas_ID = jk.Kelas_ID AND mk.Jurusan_ID = '$id'";
    $jadwal = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<select name="jadwal">
    <option value="none" disabled selected>Pilih Kelas</option>
    <?php
        foreach ($jadwal as $key => $value) {
            echo "<option value='$value[Jadwal_ID]'>".$value['Matkul_Nama']." - ".$value['Kelas_Nama']." - ".$value['Periode_Nama']."</option>";
        }
    ?>
</select>