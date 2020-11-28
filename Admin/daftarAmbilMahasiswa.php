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

<table>
    <tr>
        <th>NRP</th>
        <th>Nama</th>
        <th>Action</th>
    </tr>
    <?php
        foreach ($listMahasiswa as $key => $value) {
            $mahasiswa = $value['Mahasiswa_ID'];
            $nama = $value['Mahasiswa_Nama'];
            $query = "SELECT * FROM Pengambilan";
            $pengambilan = $conn->query($query);
            $isExist = false;
            foreach ($pengambilan as $key => $value) {
                if($value['Mahasiswa_ID'] == $mahasiswa && $value['Kelas_ID'] == $id){
                    $isExist = true;
                }
            }
            if(!$isExist){
                echo "<tr>";  
                echo "<td>$mahasiswa</td>"; 
                echo "<td>$nama</td>"; 
                echo "<td><form action='' method='post'><input type='hidden' name='kelas' value='$id'><input type='hidden' name='mahasiswa' value='$mahasiswa'><button class='btn waves-effect grey lighten-1' style='width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;' type='submit' name='btnInsert'>Insert</button></form></td>";    
                echo "<tr>";
            }
        }
    ?>
</table>