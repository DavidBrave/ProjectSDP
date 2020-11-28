<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $dosen = $_SESSION['user']['user'];
    $query = "SELECT mhs.Mahasiswa_ID, mhs.Mahasiswa_Nama FROM Mahasiswa mhs, Kelas k, Pengambilan p
    WHERE p.Kelas_ID = k.Kelas_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND k.DosenPengajar_ID = '$dosen' AND k.Kelas_ID = '$id'";
    $mahasiswa = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<select name="mahasiswa" id="mahasiswa">
    <option value="none" disabled selected>Pilih Mahasiswa</option>
    <?php
        foreach ($mahasiswa as $key => $value) {
            echo "<option value='$value[Mahasiswa_ID]'>$value[Mahasiswa_Nama]</option>";
        }
    ?>
</select>