<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $query = "SELECT a.Hadir, m.Mahasiswa_Nama 
    FROM Absen a, Mahasiswa m 
    WHERE a.Kelas_ID = '$id' 
    AND a.Absen_Date = '$tanggal' 
    AND a.Mahasiswa_ID = m.Mahasiswa_ID";
    $tanggal = $conn->query($query);
?>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<table>
    <tr>
        <th width=50%>Nama Mahasiswa</th>
        <th>Kehadiran</th>
    </tr>
    <?php
        foreach($tanggal as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Mahasiswa_Nama]</td>";
            if ($value['Hadir'] == 1) {
                echo "<td><p><input type='checkbox' disabled checked/><span></span></p></td>";
            }
            else {
                echo "<td><p><input type='checkbox' disabled/><span></span></p></td>";
            }
            echo "</tr>";
        }
    ?>
</table>