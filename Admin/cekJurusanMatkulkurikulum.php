<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, p.Periode_Nama FROM Matkul_Kurikulum mk, Matkul m, Jurusan j, Periode p 
    WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = j.Jurusan_ID AND mk.Periode_ID = p.Periode_ID AND j.Jurusan_ID = '$id'";
    $listMatkulKurikulum = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<select name="matkulkurikulum">
    <option value="none" disabled selected>Pilih Matkul Kurikulum</option>
    <?php               
        foreach ($listMatkulKurikulum as $key => $value) {
            echo "<option value='$value[Matkul_Kurikulum_ID]'>".$value['Matkul_Nama']." - ".$value['Periode_Nama']."</option>";
        }
    ?>
</select>