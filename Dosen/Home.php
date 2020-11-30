<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = "";

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    }

    if (isset($_SESSION['user']['user'])){
        $id = $_SESSION['user']['user'];
    }

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="Dosen.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="../jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("#menu_jadwal").click(function () {
               $("#menu_item1").toggle();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
            });
            $("#menu_mahasiswa").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
            });
            $("#menu_frs").click(function () {
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
            <a href="#" style="width: 100%; color: black; padding-left: 0px;">
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

            <a href = "halamanInsertNilai.php" class = "btn dropdown-button blue lighten-2" id="menu_nilai"><i class="material-icons left">school</i>Nilai</a>

            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Mengajar</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ujian</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Dosen</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ruangan</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_mahasiswa"><i class="material-icons left">event_note</i>Mahasiswa</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "#">Lihat Mahasiswa</a>
                <a class = "btn dropdown-button blue" href = "halamanAbsen.php">Absen</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_frs"><i class="material-icons left">event_note</i>FRS</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "halamanFRSpending.php">FRS Pending</a>
                <a class = "btn dropdown-button blue" href = "halamanFRS.php">Lihat FRS</a>
                <a class = "btn dropdown-button blue" href = "halamanBatalTambah.php">Batal Tambah</a>
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
        <div id="container">
        <h4>Jadwal Mengajar Hari Ini</h4>
            <?php
                $date = strtolower(date("l"));
                $query = "SELECT m.Matkul_Nama, jk.Jadwal_Mulai, jk.Jadwal_Selesai, k.Kelas_Ruangan, jk.Jadwal_Hari 
                FROM Kelas k, Matkul_Kurikulum mk, Matkul m, Jadwal_Kuliah jk
                WHERE k.Kelas_ID = jk.Kelas_ID 
                AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID
                AND mk.Matkul_ID = m.Matkul_ID 
                AND k.DosenPengajar_ID = '$id' 
                AND jk.Jadwal_Hari = '$date'";
                $matkul = $conn->query($query);
            ?>
            <table style="width: 800px;">
                <tr>
                    <th>Matkul</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                </tr>
                <?php
                    if (mysqli_num_rows($matkul) > 0) {
                        foreach ($matkul as $key => $value) {
                            $date = "";
                            if($value['Jadwal_Hari'] == "monday"){
                                $date = "Senin";
                            }else if($value['Jadwal_Hari'] == "tuesday"){
                                $date = "Selasa";
                            }else if($value['Jadwal_Hari'] == "wednesday"){
                                $date = "Rabu";
                            }else if($value['Jadwal_Hari'] == "thursday"){
                                $date = "Kamis";
                            }else if($value['Jadwal_Hari'] == "friday"){
                                $date = "Jumat";
                            }else if($value['Jadwal_Hari'] == "saturday"){
                                $date = "Sabtu";
                            }else if($value['Jadwal_Hari'] == "sunday"){
                                $date = "Minggu";
                            }

                            echo "<tr>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$date</td>";
                            echo "<td>$value[Jadwal_Mulai] - $value[Jadwal_Selesai]</td>";
                            echo "<td>$value[Kelas_Ruangan]</td>";
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
                $query = "SELECT s.Judul_Skripsi, m.Mahasiswa_Nama, s.Tanggal_Skripsi, s.Jam_Mulai, s.Jam_Selesai, s.Ruangan_Skripsi 
                FROM Skripsi s, Mahasiswa m 
                WHERE (Dosen_Penguji1 = '$id' 
                OR Dosen_Penguji2 = '$id' 
                OR Dosen_Penguji3 = '$id') 
                AND s.Mahasiswa_ID = m.Mahasiswa_ID";
                $skripsi = $conn->query($query);
            ?>
            <h4>Jadwal Sidang Skripsi</h4>
            <table style="width: 800px;">
                <tr>
                    <th>Judul Skripsi</th>
                    <th>Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                </tr>
                <?php
                    if (mysqli_num_rows($skripsi) > 0) {
                        foreach ($skripsi as $key => $value) {
                            echo "<tr>";
                            echo "<td>$value[Judul_Skripsi]</td>";
                            echo "<td>$value[Mahasiswa_Nama]</td>";
                            echo "<td>$value[Tanggal_Skripsi]</td>";
                            echo "<td>$value[Jam_Mulai] - $value[Jam_Selesai]</td>";
                            echo "<td>$value[Ruangan_Skripsi]</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4' style='text-align: center;'>Tidak ada jadwal</td>";
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