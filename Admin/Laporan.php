<?php
    session_start();
    require_once('../Required/Connection.php');

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    $arr1 = [];
    $arr2 = [];
    $query = "SELECT * FROM Jurusan";
    $jurusan = $conn->query($query);
    foreach ($jurusan as $key => $value) {
        $jurusanId = substr($value['Jurusan_ID'], 1, 3);
        $jurusanNama = $value['Jurusan_Nama'];
        $query = "SELECT * FROM Mahasiswa WHERE SUBSTR(Mahasiswa_ID,4,3) = '$jurusanId'";
        $mahasiswa = $conn->query($query);
        $totalIPK = 0;
        $countIPK = 0;
        foreach ($mahasiswa as $key => $value) {
            $nrp = $value['Mahasiswa_ID'];
            $totalIPS = 0;
            $countIPS = 0;
            for ($i=1; $i < 9; $i++) { 
                $query = "SELECT * FROM Pengambilan p, Kelas k,Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
                WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
                AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $i";
                $pengambilan = $conn->query($query);
                $counter = 0;
                $total = 0;
                foreach ($pengambilan as $key => $value)
                {
                    $grade = $value['Pengambilan_Grade'];
                    $sks = $value['SKS'];
                    $matkulId = $value['Matkul_ID'];
                    $sems = $value['Semester_Pengambilan'];
        
                    $query="SELECT * FROM Pengambilan p, Kelas k, Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
                    WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
                    AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $i AND mk.Matkul_ID = '$matkulId'
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
                        
                        if($grade != ''){
                            $counter+=$sks;
                        }
                    }
                }
                if($counter > 0){
                    $totalIPS += $total/$counter;
                    $countIPS++;
                }
            }
            if($countIPS > 0){
                $totalIPK += $totalIPS/$countIPS;
                $countIPK++;
            }
        }
        array_push($arr2, $jurusanNama);
        if($countIPK > 0){
            array_push($arr1, substr($totalIPK/$countIPK, 0, 4));
        }else{
            array_push($arr1, "0");
        }
    }
    $dataPoints = array();
    for ($i=0; $i < sizeof($arr1); $i++) { 
        array_push($dataPoints, array("label" => $arr2[$i], "y" => (float)$arr1[$i]));
    }

    $query = "SELECT * FROM Jurusan";
    $jurusan = $conn->query($query);
    $ctr = 0;
    $dataKehadiran = [];

    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    foreach ($jurusan as $key => $value) {
        $kehadiran = [];
        $listTemp = [];
        $listBulan = [];
        $query = "SELECT MONTH(a.Absen_Date) as Bulan, COUNT(a.Hadir) as Kehadiran  
        FROM Absen a, Mahasiswa m 
        WHERE a.Mahasiswa_ID = m.Mahasiswa_ID 
        AND m.Mahasiswa_Jurusan = '$value[Jurusan_ID]' 
        AND a.Hadir = 0
        GROUP BY m.Mahasiswa_Jurusan, MONTH(a.Absen_Date)";

        $temp = $conn->query($query);

        foreach($temp as $key2 => $value2) {
            array_push($listTemp, $value2['Kehadiran']);
            array_push($listBulan, $value2['Bulan']);
            
        }
        
        for($i = 0 ; $i < 12 ; $i++) {
            $cek = false;
            for($j = 0 ; $j < sizeof($listBulan) ; $j++) {
                if ($listBulan[$j]-1 == $i) {
                    $cek = true;
                    array_push($kehadiran, array("label" => $bulan[$i], "y" => $listTemp[$j]));
                }
            }
            if (!$cek) {
                array_push($kehadiran, array("label" => $bulan[$i], "y" => 0));
            }
        }

        array_push($dataKehadiran, $kehadiran);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin2.css">
    <style>
        .kotak{
            width: 200px;
            height: 100px;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        #dosen{
            background-color: green;
        }
        #mahasiswa{
            background-color: plum;
        }
        #admin{
            background-color: lightblue;
        }
    </style>
    <script src="jquery.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script type = "text/javascript" src = "https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type = "text/javascript" src = "https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".chartContainer").CanvasJSChart({ 
                animationEnabled: true,
                title: { 
                    text: "Rata-rata IPK tiap Jurusan" 
                }, 
                axisY: { 
                    title: "IPK",
                    interval: 0.5,
                    includeZero: true 
                }, 
                data: [ 
                    { 
                        type: "column", 
                        toolTipContent: "{label}: {y}", 
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    } 
                ] 
            });

            var chart = new CanvasJS.Chart("chartContainer", {
                title:{
                    text: "Jumlah Ketidakhadiran Mahasiswa per Bulan"
                },
                axisY:[{
                    title: "Jumlah Mahasiswa",
                    lineColor: "#C24642",
                    tickColor: "#C24642",
                    labelFontColor: "#C24642",
                    titleFontColor: "#C24642",
                    interval: 2,
                    includeZero: true
                }],
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "line",
                    name: "Sistem Informatika",
                    color: "#369EAD",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataKehadiran[0], JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "line",
                    name: "Desain Komunikasi Visual",
                    color: "#C24642",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataKehadiran[1], JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "line",
                    name: "Desain Produk",
                    color: "#7F6084",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataKehadiran[2], JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

        });
    </script>
</head>
<body>
    <div id="header">
        <h5 style="margin-top:10px; float:left; margin-left: 10px;">Sistem Informasi Mahasiswa</h5>
        <form action="#" method="post" style="float: right; margin-top:10px; margin-right: 10px;">
            <button class="btn waves-effect red accent-4" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" name="btnLogout">Logout
                <i class="material-icons right" style="margin: 0px;">settings_power</i>
            </button>
        </form>
    </div>
    <div id="content">
        <div id="col-kiri">
            <a class = "btn dropdown-button blue lighten-2" href = "Admin.php" style="width: 100%; color: black; padding-left: 0px;">Dashboard</a>
            
            <ul id = "dropdown" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataMahasiswa.php">Data Mahasiswa</a></li>
                <li><a href = "insertDataMahasiswa.php">Insert Data Mahasiswa</a></li>
                <li><a href = "halamanSkripsiMahasiswa.php">Skripsi Mahasiswa</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Mahasiswa<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown2" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataDosen.php">Data Dosen</a></li>
                <li><a href = "insertDataDosen.php">Insert Data Dosen</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown2" style="width: 100%; color: black;">Dosen<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown3" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanJurusan.php">Data Jurusan</a></li>
                <li><a href = "insertDataJurusan.php">Insert Data Jurusan</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown3" style="width: 100%; color: black;">Jurusan<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown4" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMajor.php">Data Major</a></li>
                <li><a href = "insertDataMajor.php">Insert Data Major</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown4" style="width: 100%; color: black;">Major<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMataKuliah.php">Data Mata Kuliah</a></li>
                <li><a href = "insertDataMataKuliah.php">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown5" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown6" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanKurikulum.php">Data Kurikulum</a></li>
                <li><a href = "insertDataKurikulum.php">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown6" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown7" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanPeriode.php">Data Periode</a></li>
                <li><a href = "insertPeriode.php">Insert Periode</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown7" style="width: 100%; color: black;">Periode<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown8" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMatkulKurikulum.php">Data Matkul Kurikulum</a></li>
                <li><a href = "insertMatkulKurikulum.php">Insert Data Matkul Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown8" style="width: 100%; color: black;">Matkul Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown9" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataPraktikum.php">Data Praktikum</a></li>
                <li><a href = "insertDataPraktikum.php">Insert Data Praktikum</a></li>
                <li><a href = "insertKelasPraktikum.php">Insert Kelas Praktikum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown9" style="width: 100%; color: black;">Praktikum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown10" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanJadwalKuliah.php">Data Jadwal Kuliah</a></li>
                <li><a href = "insertJadwalKuliah.php">Insert Jadwal Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown10" style="width: 100%; color: black;">Jadwal Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown11" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataKelas.php">Data Kelas</a></li>
                <li><a href = "insertDataKelas.php">Insert Data Kelas</a></li>
                <li><a href = "halamanPembagianKelas.php">Pembagian Kelas</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown11" style="width: 100%; color: black;">Kelas<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        
            <ul id = "dropdown12" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataJadwalPenting.php">Data Jadwal Ujian & Quiz</a></li>
                <li><a href = "insertDataJadwalPenting.php">Insert Data Jadwal Ujian & Quiz</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown12" style="width: 100%; color: black;">Jadwal Ujian & Quiz<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        </div> 
        <div id="col-kanan">
            <h3>Laporan</h3><br>
            <h4>Beban Ajar Dosen</h4>
            <table style="width: 50%;">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Beban SKS</th>
                </tr>
                <?php
                    $query = "SELECT d.Dosen_ID, d.Dosen_Nama, SUM(mk.SKS) as total FROM Dosen d, Kelas k, Matkul_Kurikulum mk
                    WHERE d.Dosen_ID = k.DosenPengajar_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID
                    GROUP BY d.Dosen_ID";
                    $laporan1 = $conn->query($query);
                    foreach ($laporan1 as $key => $value) {
                        echo "<tr>";
                        echo "<td>$value[Dosen_ID]</td>";
                        echo "<td>$value[Dosen_Nama]</td>";
                        echo "<td>$value[total] SKS</td>";
                        echo "</tr>";
                    }
                ?>
            </table><br><br><br>
            <div class="chartContainer" style="height: 500px; width: 50%"></div><br><br>
            <div id="chartContainer" style="height: 370px; width: 70%;"></div>
        </div>
    </div>
</body>
</html>