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

    $nrp = $_SESSION['user']['user'];
    $query = "SELECT m.*, j.Jurusan_ID, j.Jurusan_Nama FROM Mahasiswa m, Jurusan j
              WHERE SUBSTR(m.Mahasiswa_ID,4,3) = SUBSTR(j.Jurusan_ID,2,3) AND m.Mahasiswa_ID = '$nrp'";
    $mahasiswa = mysqli_fetch_array($conn->query($query));
    $nrp = $mahasiswa['Mahasiswa_ID'];
    $semester = (int)$mahasiswa['Mahasiswa_Semester'];
    $jurusan = $mahasiswa['Jurusan_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah</title>
    <link rel="stylesheet" href="Mahasiswa.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="../jquery.js"></script>
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
    <style>
        #container{
            min-height: 937px;
            height: auto;
        }
    </style>
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
                <a class = "btn dropdown-button blue" href = "#">Drop</a>
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
        <h4>Jadwal Quiz</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Jadwal_Kuliah jk, Kelas k, Matkul_Kurikulum mk, Matkul m, Pengambilan p
                    WHERE p.Kelas_ID = k.Kelas_ID AND jp.Jadwal_ID = jk.Jadwal_ID AND jk.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'quiz' AND p.Kelas_ID = k.Kelas_ID AND p.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = '$semester' AND p.Pengambilan_Batal <> 1 ORDER BY Penting_Date";
                    $listQuiz = $conn->query($query);
                    if(mysqli_num_rows($listQuiz) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listQuiz as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "</tr>";
                }
            ?>
            </table><br><br>

            <h4>Jadwal UTS</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Jadwal_Kuliah jk, Kelas k, Matkul_Kurikulum mk, Matkul m, Pengambilan p
                    WHERE p.Kelas_ID = k.Kelas_ID AND jp.Jadwal_ID = jk.Jadwal_ID AND jk.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'uts' AND p.Kelas_ID = k.Kelas_ID AND p.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = '$semester' AND p.Pengambilan_Batal <> 1 ORDER BY Penting_Date";
                    $listUts = $conn->query($query);
                    if(mysqli_num_rows($listUts) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listUts as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "</tr>";
                }
            ?>
            </table><br><br>

            <h4>Jadwal UAS</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date FROM Jadwal_Penting jp, Jadwal_Kuliah jk, Kelas k, Matkul_Kurikulum mk, Matkul m, Pengambilan p
                    WHERE p.Kelas_ID = k.Kelas_ID AND jp.Jadwal_ID = jk.Jadwal_ID AND jk.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND jp.Keterangan = 'uas' AND p.Kelas_ID = k.Kelas_ID AND p.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = '$semester' AND p.Pengambilan_Batal <> 1 ORDER BY Penting_Date";
                    $listUas = $conn->query($query);
                    if(mysqli_num_rows($listUas) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listUas as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>