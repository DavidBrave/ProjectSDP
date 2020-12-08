<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT DISTINCT Tanggal_Kuliah FROM Jadwal_Kuliah WHERE Kelas_ID = '$id'";
    $tanggal = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<h5 style="font-size:20px;">Tanggal Quiz : </h5>
<select name='tanggalQuiz'>
    <option value='none' disabled selected>Pilih Tanggal Quiz</option>
    <?php
        foreach ($tanggal as $key) {
            echo "<option value='$key[Tanggal_Kuliah]'>$key[Tanggal_Kuliah]</option>";
        }
    ?>
</select>
<h5 style="font-size:20px;">Tanggal UTS : </h5>
<select name='tanggalUts'>
    <option value='none' disabled selected>Pilih Tanggal UTS</option>
    <?php
        foreach ($tanggal as $key) {
            echo "<option value='$key[Tanggal_Kuliah]'>$key[Tanggal_Kuliah]</option>";
        }
    ?>
</select>
<h5 style="font-size:20px;">Tanggal UAS : </h5>
<select name='tanggalUas'>
    <option value='none' disabled selected>Pilih Tanggal UAS</option>
    <?php
        foreach ($tanggal as $key) {
            echo "<option value='$key[Tanggal_Kuliah]'>$key[Tanggal_Kuliah]</option>";
        }
    ?>
</select>