<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $query = "SELECT a.Hadir, a.Absen_Keterangan, m.Mahasiswa_Nama, m.Mahasiswa_ID
    FROM Absen a, Mahasiswa m 
    WHERE a.Kelas_ID = '$id' 
    AND a.Absen_Date = '$tanggal' 
    AND a.Mahasiswa_ID = m.Mahasiswa_ID";
    $listAbsen = $conn->query($query);
?>
<script>

</script>
<table>
    <tr>
        <th width=50%>Nama Mahasiswa</th>
        <th>Kehadiran</th>
    </tr>
    <?php
        $keterangan = "";
        echo "<input type='hidden' name='kelasID' value='$id'>";
        echo "<input type='hidden' name='tanggalAbsen' value='$tanggal'>";
        foreach($listAbsen as $key => $value) {
            echo "<tr>";
            echo "<td>$value[Mahasiswa_Nama]</td>";
            if ($value['Hadir'] == 1) {
                echo "<td><p><label style='position: relative;'><input type='checkbox' name='kehadiran[]' value='$value[Mahasiswa_ID]' checked/><span></span><label></p></td>";
            }
            else {
                echo "<td><p><label style='position: relative;'><input type='checkbox' name='kehadiran[]' value='$value[Mahasiswa_ID]'/><span></span><label></p></td>";
            }
            echo "</tr>";
            $keterangan = $value['Absen_Keterangan'];
        }
        echo "</table><br>";
        echo "<b>Keterangan Absen : </b> <input type='text' name='keterangan' style='width: 50%' value='$keterangan'><br>";
        echo "<button class='btn waves-effect waves-light' style='width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;' type='submit' id='btnSubmit' name='btnSubmit'>Submit</button>";
    ?>