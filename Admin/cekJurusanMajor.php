<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT * FROM Major WHERE Jurusan_ID = '$id'";
    $majors = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<select name='major'>
    <option value='none' selected>Pilih Major</option>
    <?php
        foreach ($majors as $key) {
            echo "<option value='$key[Major_ID]'>$key[Major_Nama]</option>";
        }
    ?>
</select>