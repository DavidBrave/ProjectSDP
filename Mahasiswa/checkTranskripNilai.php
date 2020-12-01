<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = $_POST['id'];

    $nrp = $_SESSION['user']['user'];
    $query="SELECT * FROM Pengambilan p, Kelas k, Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
    WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
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
            }
        ?>
    </tr>
    <?php
        $total = 0;
        $counter = 0;
        foreach ($listNilai as $key => $value)
        {
            $grade = $value['Pengambilan_Grade'];
            $sks = $value['SKS'];
            $status = $value['Pengambilan_Status'];
            $matkul = $value['Matkul_Nama'];
            $matkulId = $value['Matkul_ID'];
            $uts = $value['UTS'];
            $uas = $value['UAS'];
            $quiz = $value['Quiz'];
            $nilaiAkhir = $value['Nilai_Akhir'];
            $sems = $value['Semester_Pengambilan'];

            $query="SELECT * FROM Pengambilan p, Kelas k, Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
            WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
            AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $id AND mk.Matkul_ID = '$matkulId'
            ORDER BY m.Matkul_Nama ASC";
            $listNilai2 = $conn->query($query);
            $hide = false;
            foreach ($listNilai2 as $key => $value) {
                if($matkulId == $value['Matkul_ID'] && $sems < $value['Semester_Pengambilan']){
                    $hide = true;
                }else if($matkulId == $value['Matkul_ID'] && $sems >= $value['Semester_Pengambilan']){
                    $hide = false;
                }
            }

            if(!$hide){
                if($grade == "A"){
                    $total+=4*$sks;
                }else if($grade == "B" || $grade == "B+"){
                    $total+=3*$sks;
                }else if($grade == "C" || $grade == "C+"){
                    $total+=2*$sks;
                }else if($grade == "D"){
                    $total+=1*$sks;
                }else{
                    $total+=0;
                }
                
                if($status == "Lulus" || $grade == '') {
                    echo "<tr>";
                }else{
                    echo "<tr style='background-color: crimson;'>";
                }
                    echo "<td>$matkul</td>";
                    echo "<td>$uts</td>";
                    echo "<td>$uas</td>";
                    echo "<td>$quiz</td>";
                    echo "<td>$nilaiAkhir</td>";
                    echo "<td>$grade</td>";
                echo "</tr>";
                
                if($grade != ''){
                    $counter+=$sks;
                }
            }
        }
        $conn->close();
    ?>        
</table>
<?php
    if($counter > 0){
        echo "<p style='float: right;'>IP Semester : ".substr($total/$counter, 0, 4)."</p>";
    }
?>