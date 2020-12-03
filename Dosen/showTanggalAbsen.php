<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT DISTINCT * FROM Absen WHERE Kelas_ID = '$id'";
    $tanggal = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<select id='tanggal' onchange="gantiTanggal()">
    <option value='none' disabled selected>Pilih Tanggal</option>
    <?php
        foreach ($tanggal as $key) {
            echo "<option value='$key[Absen_Date]'>$key[Absen_Date]</option>";
        }
    ?>
</select>