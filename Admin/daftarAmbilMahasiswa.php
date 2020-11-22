<?php
    require_once('../Required/Connection.php');
    $id = $_POST['id'];
    $query = "SELECT DISTINCT m.Mahasiswa_ID, m.Mahasiswa_Nama FROM Pengambilan p, FRS a, Kelas k, Mahasiswa m WHERE p.Mahasiswa_ID = a.Mahasiswa_ID
    AND k.Matkulkurikulum_ID = a.Matkul_Kurikulum_ID AND m.Mahasiswa_ID = a.Mahasiswa_ID AND k.Kelas_ID = '$id' AND k.Kelas_Kapasitas > 0 AND p.Kelas_ID = ''";
    $listMahasiswa = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<select name='mahasiswa' id='mahasiswa'>
<option value='none' selected disabled>Pilih Mahasiswa</option>
<?php
    foreach ($listMahasiswa as $key => $value) {
        echo "<option value='$value[Mahasiswa_ID]'>".$value['Mahasiswa_Nama']."</option>";        
    }
?>
</select>