<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $query = "SELECT m.Mahasiswa_ID, m.Mahasiswa_Nama 
    FROM Pengambilan p, Mahasiswa m 
    WHERE p.Kelas_ID = '$id' 
    AND p.Mahasiswa_ID = m.Mahasiswa_ID";
    $listMhs = $conn->query($query);
?>
<script>

</script>
<table>
    <tr>
        <th width=50%>Nama Mahasiswa</th>
        <th>Kehadiran</th>
    </tr>
    <?php
        echo "<input type='hidden' name='kelasID' value='$id'>";
        foreach($listMhs as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Mahasiswa_Nama]</td>";
            echo "<td><p><label style='position: relative;'><input type='checkbox' name='kehadiran[]' value='$value[Mahasiswa_ID]'/><span></span><label></p></td>";
            echo "</tr>";
        }
        echo "</table><br>";
        echo "<b>Keterangan Absen : </b> <input type='text' name='keterangan' style='width: 50%'><br>";
        echo "<button class='btn waves-effect waves-light' style='width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;' type='submit' id='btnSubmit' name='btnSubmit'>Submit</button>";
    ?>