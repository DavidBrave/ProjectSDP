<?php
    session_start();
    require_once('../Required/Connection.php');

    if(isset($_SESSION['pesan'])){
        echo '<script language = "javascript">';
        echo "alert('$_SESSION[pesan]')";
        echo '</script>';
        unset($_SESSION['pesan']);
    }

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <h4>Jadwal Kuliah Hari Ini</h4>
            <?php
                $date = strtolower(date("l"));
                $query = "SELECT m.Matkul_Nama, jk.Jadwal_Mulai, jk.Jadwal_Selesai, k.Kelas_Ruangan, d.Dosen_Nama FROM Dosen d, Mahasiswa mhs, Kelas k, Matkul_Kurikulum mk, Matkul m, Jadwal_Kuliah jk, Pengambilan p
                WHERE mhs.Mahasiswa_ID = p.Mahasiswa_ID AND k.Kelas_ID = p.Kelas_ID AND k.Kelas_ID = jk.Kelas_ID AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID
                AND mk.Matkul_ID = m.Matkul_ID AND d.Dosen_ID = k.DosenPengajar_ID AND mhs.Mahasiswa_ID = '$nrp' AND p.Semester_Pengambilan = $semester AND jk.Jadwal_Hari = '$date'";
                $matkul = $conn->query($query);
            ?>
            <table style="width: 800px;">
                <tr>
                    <th>Matkul</th>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                    <th>Dosen</th>
                </tr>
                <?php
                    if (mysqli_num_rows($matkul) > 0) {
                        foreach ($matkul as $key => $value) {
                            echo "<tr>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[Jadwal_Mulai] - $value[Jadwal_Selesai]</td>";
                            echo "<td>$value[Kelas_Ruangan]</td>";
                            echo "<td>$value[Dosen_Nama]</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4' style='text-align: center;'>Tidak ada jadwal</td>";
                        echo "</tr>";
                    }
                ?>
            </table><br><br>
            <h4>Jadwal Praktikum Hari Ini</h4>
            <?php
                $date = strtolower(date("l"));
                if($date == "monday"){
                    $date = "Senin";
                }else if($date == "tuesday"){
                    $date = "Selasa";
                }else if($date == "wednesday"){
                    $date = "Rabu";
                }else if($date == "thursday"){
                    $date = "Kamis";
                }else if($date == "friday"){
                    $date = "Jumat";
                }else if($date == "saturday"){
                    $date = "Sabtu";
                }else if($date == "sunday"){
                    $date = "Minggu";
                }
                $query = "SELECT * FROM Mahasiswa mhs, Praktikum p, Kelas_Praktikum kp, Pengambilan_Praktikum pp, Matkul_Kurikulum mk, Matkul m
                WHERE mhs.Mahasiswa_ID = pp.Mahasiswa_ID AND pp.Kelas_Praktikum_ID = kp.Kelas_Praktikum_ID AND kp.Praktikum_ID = p.Praktikum_ID 
                AND p.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND p.Praktikum_ID = mk.Praktikum_ID AND mk.Matkul_ID = m.Matkul_ID
                AND mhs.Mahasiswa_ID = '$nrp' AND pp.Semester_Pengambilan_Praktikum = $semester AND p.Praktikum_Hari = '$date'";
                $praktikum = $conn->query($query);
            ?>
            <table style="width: 800px;">
                <tr>
                    <th>Praktikum</th>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                </tr>
                <?php
                    if (mysqli_num_rows($praktikum) > 0) {
                        foreach ($praktikum as $key => $value) {
                            echo "<tr>";
                            echo "<td>$value[Praktikum_Nama]</td>";
                            echo "<td>$value[Praktikum_Jam_Mulai] - $value[Praktikum_Jam_Selesai]</td>";
                            echo "<td>$value[Kelas_Praktikum_Ruangan]</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4' style='text-align: center;'>Tidak ada jadwal</td>";
                        echo "</tr>";
                    }
                ?>
            </table><br><br>
            <?php
                $query = "SELECT * FROM Skripsi WHERE Mahasiswa_ID = '$nrp'";
                $skripsi = mysqli_fetch_array($conn->query($query));
                $count = mysqli_num_rows($conn->query($query));
                if($count != 0){
                ?>
                    <h4>Jadwal Sidang Skripsi</h4>
                    <table style="width: 800px;">
                        <tr>
                            <th>Judul Skripsi</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                        </tr>
                        <tr>
                            <td><?=$skripsi['Judul_Skripsi']?></td>
                            <td><?=$skripsi['Tanggal_Skripsi']?></td>
                            <td><?=substr($skripsi['Jam_Mulai'], 0, 5)?> - <?=substr($skripsi['Jam_Selesai'], 0, 5)?></td>
                            <td><?=$skripsi['Ruangan_Skripsi']?></td>
                        </tr>
                    </table>
                <?php
                }
            ?>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>