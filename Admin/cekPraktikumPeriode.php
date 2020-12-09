<?php
session_start();
require_once('../Required/Connection.php');

$id = $_POST['id'];
$query = "SELECT DISTINCT p.Praktikum_ID, p.Praktikum_Nama, pe.Periode_Nama 
FROM Praktikum p, Matkul_Kurikulum mk, Periode pe
WHERE p.Praktikum_ID = mk.Praktikum_ID AND mk.Periode_ID = pe.Periode_ID AND pe.Periode_ID = '$id'";
$listPraktikum = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<select name="praktikum">
    <option value="none" disabled selected>Pilih Praktikum</option>
    <?php
    foreach ($listPraktikum as $key => $value) {
        echo "<option value='$value[Praktikum_ID]'>" . $value['Praktikum_ID'] . " - " . $value['Praktikum_Nama'] . " - " . $value['Periode_Nama'] . "</option>";
    }
    ?>
</select>