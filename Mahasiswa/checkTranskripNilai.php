<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];

    $nrp = $_SESSION['user']['user'];
    $query="SELECT * FROM Pengambilan p, Kelas k,Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
    WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID 
    AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $id
    ORDER BY m.Matkul_Nama ASC";
    $listNilai = $conn->query($query);
?>       

<table border="1" style="display: hidden;">
    <tr>
        <?php
            if(mysqli_num_rows($listNilai) == 0){
                echo "<h4>Tidak ada data</h4>";
            }else{
                echo "<th>Kelas</th>";
                echo "<th>UTS</th>";
                echo "<th>UAS</th>";
                echo "<th>Quiz</th>";
                echo "<th>Nilai Akhir</th>";
                echo "<th>Grade</th>";
                echo "<th>Pengambilan Ke-</th>";
            }
        ?>
    </tr>
    <?php
        $total = 0;
        $counter = 0;
        foreach ($listNilai as $key => $value)
        {
            if($value['Pengambilan_Grade'] == "A"){
                $total+=4;
            }else if($value['Pengambilan_Grade'] == "B" || $value['Pengambilan_Grade'] == "B+"){
                $total+=3;
            }else if($value['Pengambilan_Grade'] == "C" || $value['Pengambilan_Grade'] == "C+"){
                $total+=2;
            }else if($value['Pengambilan_Grade'] == "D"){
                $total+=1;
            }else{
                $total+=0;
            }
            echo "<tr>";
                echo "<td>$value[Matkul_Nama]</td>";
                echo "<td>$value[UTS]</td>";
                echo "<td>$value[UAS]</td>";
                echo "<td>$value[Quiz]</td>";
                echo "<td>$value[Nilai_Akhir]</td>";
                echo "<td>$value[Pengambilan_Grade]</td>";
                echo "<td>$value[Jumlah_Ambil]</td>";
            echo "</tr>";
            $counter++;
        }
        $conn->close();
    ?>        
</table>
<?php
    if($counter > 0){
        echo "<p style='float: right;'>IP Semester : ".substr($total/$counter, 0, 4)."</p>";
    }
?>