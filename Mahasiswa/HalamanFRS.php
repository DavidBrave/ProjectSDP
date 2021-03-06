<?php
    session_start();
    require_once('../Required/Connection.php');

    //Cek apakah hari ini masih tanggal pengisian frs
    $query = "SELECT * FROM Jadwal_Pengisian_FRS WHERE id = 1";
    $jadwalFRS = mysqli_fetch_array($conn->query($query));
    $today = date('Y-m-d');
    if($today < $jadwalFRS['Tanggal_Buka'] || $today > $jadwalFRS['Tanggal_Tutup']){
        $_SESSION['pesan'] = "FRS belum dibuka";
        header("location: Home.php");
    }

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if(isset($_POST['btnNext'])){
        $_SESSION['matkul'] = $_POST['hidMatkul'];
        header("location: HalamanLihatFRS.php");
    }

    $nrp = $_SESSION['user']['user'];
    $query = "SELECT m.*, j.Jurusan_ID, j.Jurusan_Nama FROM Mahasiswa m, Jurusan j
              WHERE SUBSTR(m.Mahasiswa_ID,4,3) = SUBSTR(j.Jurusan_ID,2,3) AND m.Mahasiswa_ID = '$nrp'";
    $mahasiswa = mysqli_fetch_array($conn->query($query));
    $nrp = $mahasiswa['Mahasiswa_ID'];
    $semester = (int)$mahasiswa['Mahasiswa_Semester'];
    $jurusan = $mahasiswa['Jurusan_ID'];
    $semesterLalu = $semester;
    if($semester == 0){
        $sksTotal = 18;
    }else{
        $query = "SELECT p.Pengambilan_Grade FROM Mahasiswa m, Pengambilan p, Kelas k, Matkul_Kurikulum mk 
                  WHERE m.Mahasiswa_ID = p.Mahasiswa_ID AND p.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND m.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = $semesterLalu";
        $listNilai = $conn->query($query);
        $count = mysqli_num_rows($listNilai);
        $ips = 0;
        foreach ($listNilai as $key => $value) {
            if($value['Pengambilan_Grade'] == 'A'){
                $ips += 4;
            }else if($value['Pengambilan_Grade'] == 'B' || $value['Pengambilan_Grade'] == 'B+'){
                $ips += 3;
            }else if($value['Pengambilan_Grade'] == 'C' || $value['Pengambilan_Grade'] == 'C+'){
                $ips += 2;
            }else if($value['Pengambilan_Grade'] == 'D'){
                $ips += 1;
            }else if($value['Pengambilan_Grade'] == 'E'){
                $ips += 0;
            }
        }

        if($count == 0){
            $ips = $ips;
        }else{
            $ips = $ips/$count;
        }

        if($ips >= 3.5){
            $sksTotal = 22;
        }else if($ips >= 3.0){
            $sksTotal = 20;
        }else if($ips >= 2.5){
            $sksTotal = 18;
        }else if($ips >= 2.0){
            $sksTotal = 15;
        }else if($ips >= 1.5){
            $sksTotal = 12;
        }else{
            $sksTotal = 9;
        }
    }

    //Periode Sekarang
    // $tahun1 = date("Y");
    // $tahun2 = $tahun1 + 1;
    // $bulan = date("m");
    // $periodeID = $tahun1 . $tahun2;
    // if ($bulan >= 8 && $bulan <= 12 || $bulan == 1) {
    //     $periodeID = $periodeID . "11";
    // } else if ($bulan >= 2 && $bulan <= 7) {
    //     $periodeID = $periodeID . "21";
    // }
    $query = "SELECT * FROM Jadwal_Pengisian_FRS WHERE id = 1";
    $periode = mysqli_fetch_array($conn->query($query));
    $periodeID = $periode['Periode_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRS</title>
    <link rel="stylesheet" href="Mahasiswa.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="../jquery.js"></script>
    <style>
        #container{
            height: auto;
        }
        #maxSks{
            width: auto;
            position: sticky;
            top: 70px;
            z-index: 1;
            background-color: white;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#menu_nilai").click(function () {
               $("#menu_item1").toggle(); 
               $("#menu_item2").hide();
               $("#menu_item3").hide();
            });
            $("#menu_jadwal").click(function () {
               $("#menu_item1").hide(); 
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
            });
            $("#menu_rencana").click(function () {
               $("#menu_item1").hide(); 
               $("#menu_item2").hide();
               $("#menu_item3").toggle();
            });

            $(".matkul").click(function () {
                var str = $("#maxSks").html().split(": ");
                var max = parseInt(str[1]);
                var sks = [];
                $.each($("input[name='matkul']:checked"), function () {
                    var arrSks = $(this).val().split("-");
                    sks.push(arrSks[1]);
                }) 
                if(sks.length > 0) {
                    if(sks[sks.length-1] <= max){
                        var matkul = [];
                        $.each($("input[name='matkul']:checked"), function () {
                            var arr = $(this).val().split("-");
                            matkul.push(arr[0]);
                        })
                        $("#hidMatkul").val(matkul);
                        $.ajax({
                            method : "post",
                            url : "checkMatkul.php",
                            data : {
                                matkuls : matkul,
                                maxSks : <?=$sksTotal?>
                            },
                            success : function (hasil) {
                                $("#maxSks").html("Max SKS: " + hasil);
                            }
                        });
                    }else{
                        var cb = $("input[name='matkul']:checked");
                        $(this).prop("checked", false);
                        $("input[name='matkul']").prop("disabled", true);
                        cb.prop("disabled", false);
                        alert("Melebihi Max SKS");
                    }
                }
                else {
                    $("#maxSks").html("Max SKS: " + <?=$sksTotal?>);
                }
            })
        });
    </script>
</head>
<body>
    <div id="col-kiri">
        <div id="menu">
            <a href="HalamanBiodata.php" style="width: 100%; color: black; padding-left: 0px;">
                <div id="profile">
                    <?php 
                        if($_SESSION['user']['photo'] == ""){
                        ?>
                            <img src="../Photo/profile.png" alt="" id="photo">
                        <?php
                        }else{
                        ?>
                            <img src="../Photo/<?=$_SESSION['user']['photo']?>" alt="" id="photo">
                        <?php
                        }
                    ?>
                    <div id="text-profile">
                        <p><?=$_SESSION['user']['name']?></p>
                        <p><?=$_SESSION['user']['user']?></p>
                    </div>
                </div>
            </a>
            <a class = "btn dropdown-button blue lighten-2" href = "Home.php"><i class="material-icons left">home</i>Beranda</a>
            <a class = "btn dropdown-button blue lighten-2" id="menu_nilai"><i class="material-icons left">school</i>Nilai</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanNilai.php">Laporan Nilai</a>
                <a class = "btn dropdown-button blue" href = "HalamanNilaiPraktikum.php">Nilai Praktikum</a>
                <a class = "btn dropdown-button blue" href = "HalamanTranskripNilai.php">Transkrip Nilai</a>
                <a class = "btn dropdown-button blue" href = "Laporan.php">Grafik</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanJadwalKuliah.php">Jadwal Kuliah</a>
                <a class = "btn dropdown-button blue" href = "HalamanJadwalUjian.php">Jadwal Ujian</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "HalamanAbsen.php"><i class="material-icons left">event_available</i>Absen</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_rencana"><i class="material-icons left">event_note</i>Rencana Studi</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanFRS.php">FRS</a>
                <a class = "btn dropdown-button blue" href = "HalamanBatalTambah.php">Batal Tambah</a>
            </div>
        </div>
    </div>
    <div id="col-kanan">
        <div id="header">
            <h5 style="margin-top:20px; float:left; margin-left: 10px;">Sistem Informasi Mahasiswa</h5>
            <form action="#" method="post" style="float: right; margin-top:10px; margin-right: 10px;">
                <button class="btn waves-effect blue-grey lighten-3" style="width: 150px; height: 30px; padding-bottom: 2px; margin: 0px; margin-top:10px;" type="submit" name="btnLogout">Logout
                    <i class="material-icons right" style="margin: 0px;">exit_to_app</i>
                </button>
            </form>
        </div>
        <div id="container" style="padding: 20px;">
            <h2>FRS</h2>
            <h5 id="maxSks">Max SKS: <?=$sksTotal?></h5><br>
            <form action="#" method="post">
                <?php
                    for ($i=1; $i < 9; $i++) { 
                    ?>
                    <h4>Semester <?=$i?></h4>    
                    <?php
                        $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = $i AND mk.Periode_ID = '$periodeID'";
                        $sems = $conn->query($query);
                        $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = $i AND mk.Periode_ID = '$periodeID'";
                        $sksSemester = mysqli_fetch_array($conn->query($query));
                        echo "<table style='width: 600px;'>";
                        echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester[total]</th></tr>";
                        foreach ($sems as $key => $value) {
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            if($sksSemester["Semester"]%2 == $semester%2){
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul' value='$value[Matkul_Kurikulum_ID]"."-".$value['SKS']."' disabled/><span></span></label></p></td>";
                            }else{
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul' value='$value[Matkul_Kurikulum_ID]"."-".$value['SKS']."'/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                    <?php
                    }
                ?>
                <br>
                <input type="hidden" name="hidMatkul" id="hidMatkul">
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnNext" name="btnNext"><i class="material-icons right">navigate_next</i> Next</button>    
            </form>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>