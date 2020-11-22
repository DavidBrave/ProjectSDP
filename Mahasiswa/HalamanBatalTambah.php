<?php
    session_start();
    require_once("../Required/Connection.php");

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if(isset($_POST['btnNext'])){
        $_SESSION['matkul'] = $_POST['matkul'];
        header("location: HalamanLihatTambah.php");
    }

    $nrp = $_SESSION['user']['user'];
    $query = "SELECT m.*, j.Jurusan_ID, j.Jurusan_Nama FROM Mahasiswa m, Jurusan j
              WHERE SUBSTR(m.Mahasiswa_ID,4,3) = SUBSTR(j.Jurusan_ID,2,3) AND m.Mahasiswa_ID = '$nrp'";
    $mahasiswa = mysqli_fetch_array($conn->query($query));
    $nrp = $mahasiswa['Mahasiswa_ID'];
    $semester = (int)$mahasiswa['Mahasiswa_Semester'];
    $jurusan = $mahasiswa['Jurusan_ID'];

    if(isset($_POST['btnBatal'])){
        $id = $_POST['hidId'];
        // $query = "SELECT k.Kelas_ID FROM Kelas k, Matkul_Kurikulum mk WHERE k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_Kurikulum_ID = '$id'";
        // $kelas = $conn->query($query);
        // foreach ($kelas as $key => $value) {
        //     $kelasId = $value['Kelas_ID'];
        //     $query = "UPDATE Pengambilan SET Pengambilan_Batal = 1 WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId' AND Semester_Pengambilan = $semester";
        //     $conn->query($query);
        // }
        $query = "UPDATE FRS SET FRS_Status = 'Batal' WHERE Mahasiswa_ID = '$nrp' AND Matkul_Kurikulum_ID = '$id'";
        $conn->query($query);
    }

    $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, jk.Jadwal_Hari, jk.Jadwal_Mulai, jk.Jadwal_Selesai,mk.Semester, mk.SKS 
    FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Jadwal_Kuliah jk, Pengambilan p, Mahasiswa mhs, FRS f
    WHERE p.Kelas_ID = k.Kelas_ID AND mk.Matkul_ID = m.Matkul_ID AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID AND k.Kelas_ID = jk.Kelas_ID AND p.Mahasiswa_ID = '$nrp' AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND p.Semester_Pengambilan = mhs.Mahasiswa_Semester AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID
    AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal'";
    $selectedMatkuls = $conn->query($query);

    //Periode Sekarang
    $tahun1 = date("Y");
    $tahun2 = $tahun1 + 1;
    $bulan = date("m");
    $periodeID = $tahun1 . $tahun2;
    if ($bulan >= 8 && $bulan <= 12 || $bulan == 1) {
        $periodeID = $periodeID . "11";
    } else if ($bulan >= 2 && $bulan <= 7) {
        $periodeID = $periodeID . "21";
    }
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
            width: 800px;
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
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanJadwalKuliah.php">Jadwal Kuliah</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Dosen</a>
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
            <h4>Mata kuliah yang ingin dibatalkan</h4><br>
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Matkul</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Semester</th>
                    <th>SKS</th>
                </tr>
            <?php
                if(mysqli_num_rows($selectedMatkuls) > 0){
                    foreach ($selectedMatkuls as $key => $value) {
                        $matkulkurikulumid = $value['Matkul_Kurikulum_ID'];
                        $matkulnama = $value['Matkul_Nama'];
                        $semester = $value['Semester'];
                        $jadwalHari = $value['Jadwal_Hari'];
                        $jadwalMulai = $value['Jadwal_Mulai'];
                        $jadwalSelesai = $value['Jadwal_Selesai'];
                        $sks = $value['SKS'];
                        echo "<tr>";
                        echo "<td>$matkulkurikulumid</td>";
                        echo "<td>$matkulnama</td>";
                        echo "<td>$jadwalHari</td>";
                        echo "<td>$jadwalMulai</td>";
                        echo "<td>$jadwalSelesai</td>";
                        echo "<td>$semester</td>";
                        echo "<td>$sks</td>";
                        echo "<td><form action='#' method='post'><input type='submit' name='btnBatal' value='Batal' class='btn waves-effect red darken-3' style='height: 35px;'><input type='hidden' name='hidId' value='$matkulkurikulumid'></form></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='7' style='text-align: center;'>Tidak ada matkul yang dipilih</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <br>
            <h4>Mata kuliah yang ingin ditambahkan</h4><br>
            <form action="#" method="post">
                <?php
                    for ($i=1; $i < 9; $i++) { 
                    ?>
                    <h5>Semester <?=$i?></h5>    
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
                            if($sksSemester["Semester"]%2 != $semester%2){
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]"."' disabled/><span></span></label></p></td>";
                            }else{
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]"."'/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table><br><br><br>";
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