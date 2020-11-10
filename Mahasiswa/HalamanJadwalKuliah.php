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
            height: 937px;
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
                <a class = "btn dropdown-button blue" href = "#">Laporan Nilai</a>
                <a class = "btn dropdown-button blue" href = "#">Nilai Praktikum</a>
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
            <h3>Jadwal Kuliah</h3>
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Kelas</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th colspan="2">Jam</th>
                    <th>Ruangan</th>
                </tr>
            <?php
                $query = "SELECT DISTINCT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, mk.SKS, k.Kelas_Nama, d.Dosen_Nama, jk.Jadwal_Hari, SUBSTR(jk.Jadwal_Mulai,1,5) as Jadwal_Mulai, SUBSTR(jk.Jadwal_Selesai,1,5) as Jadwal_Selesai, k.Kelas_Ruangan, (CASE jk.Jadwal_Hari WHEN 'monday' THEN 1 WHEN 'tuesday' THEN 2 WHEN 'wednesday' THEN 3 WHEN 'thursday' THEN 4 WHEN 'friday' THEN 5 WHEN 'saturday' THEN 6 WHEN 'sunday' THEN 7 END) AS day 
                FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Dosen d, Jadwal_Kuliah jk, Pengambilan p, Mahasiswa mhs 
                WHERE mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND p.Kelas_ID = k.Kelas_ID AND jk.Kelas_ID = k.Kelas_ID AND k.DosenPengajar_ID = d.Dosen_ID AND p.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = $semester AND p.Pengambilan_Batal <> 1 ORDER BY day ASC";   
                $jadwal = $conn->query($query);     
                foreach ($jadwal as $key => $value) {
                    $hari = $value['Jadwal_Hari'];
                    if($hari == "monday"){
                        $hari = "Senin";
                    }else if($hari == "tuesday"){
                        $hari = "Selasa";
                    }else if($hari == "wednesday"){
                        $hari = "Rabu";
                    }else if($hari == "thursday"){
                        $hari = "Kamis";
                    }else if($hari == "friday"){
                        $hari = "Jumat";
                    }else if($hari == "saturday"){
                        $hari = "Sabtu";
                    }else if($hari == "sunday"){
                        $hari = "Minggu";
                    }
                    echo "<tr>";
                    echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[SKS]</td>";
                    echo "<td>$value[Kelas_Nama]</td>";
                    echo "<td>$value[Dosen_Nama]</td>";
                    echo "<td>$hari</td>";
                    echo "<td colspan='2'>$value[Jadwal_Mulai] - $value[Jadwal_Selesai]</td>";
                    echo "<td>$value[Kelas_Ruangan]</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <br><br>
            <h3>Jadwal Praktikum</h3>
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Praktikum</th>
                    <th>Hari</th>
                    <th colspan="2">Jam</th>
                    <th>Ruangan</th>
                </tr>
            <?php
                $query = "SELECT p.Praktikum_ID, m.Matkul_Nama, p.Praktikum_Hari, SUBSTR(p.Praktikum_Jam_Mulai,1,5) as Jadwal_Mulai, SUBSTR(p.Praktikum_Jam_Selesai,1,5) as Jadwal_Selesai, kp.Kelas_Praktikum_Ruangan, (CASE p.Praktikum_Hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 END) AS day FROM Praktikum p, Kelas_Praktikum kp, Pengambilan_Praktikum pp, Matkul_Kurikulum mk, Matkul m, Mahasiswa mhs
                WHERE mk.Matkul_Kurikulum_ID = p.Matkulkurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND p.Praktikum_ID = kp.Praktikum_ID AND kp.Kelas_Praktikum_ID = pp.Kelas_Praktikum_ID AND pp.Mahasiswa_ID = mhs.Mahasiswa_ID AND pp.Mahasiswa_ID = '$nrp' AND pp.Semester_Pengambilan_Praktikum = $semester ORDER BY day ASC";   
                $jadwal = $conn->query($query);     
                foreach ($jadwal as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Praktikum_ID]</td>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Praktikum_Hari]</td>";
                    echo "<td colspan='2'>$value[Jadwal_Mulai] - $value[Jadwal_Selesai]</td>";
                    echo "<td>$value[Kelas_Praktikum_Ruangan]</td>";
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