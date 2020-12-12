<?php
    session_start();
    require_once('../Required/Connection.php');
    $dosenID = $_SESSION['user']['user'];

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['idSkripsi'];

        $query = "DELETE FROM Skripsi WHERE Skripsi_ID = $id";
        $conn->query($query);

        echo "<script>alert(Berhasil delete Skripsi)</script>";
    }

    if(isset($_POST['btnUpdate'])) {
        $_SESSION['TA'] = $_POST['idSkripsi'];
        header("location: ../Dosen/halamanUpdateTugasAkhir.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Jadwal Ujian</title>
    <link rel="stylesheet" href="Dosen.css">
    <script src="../jquery.js"></script>
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
    <script>
        $(document).ready(function () {
            $('select').material_select();

            $("#menu_jadwal").click(function () {
               $("#menu_item1").toggle();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
               $("#menu_item4").hide();
            });
            $("#menu_mahasiswa").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
               $("#menu_item4").hide();
            });
            $("#menu_frs").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").hide();
               $("#menu_item3").toggle();
               $("#menu_item4").hide();
            });
            $("#menu_ta").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
               $("#menu_item4").toggle();
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
            <a class = "btn dropdown-button blue lighten-2" href = "halamanInsertNilai.php"><i class="material-icons left">school</i>Nilai</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "halamanJadwalMengajar.php">Jadwal Mengajar</a>
                <a class = "btn dropdown-button blue" href = "halamanJadwalUjian.php">Jadwal Ujian</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_mahasiswa"><i class="material-icons left">event_note</i>Mahasiswa</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "halamanInputAbsen.php">Input Absen</a>
                <a class = "btn dropdown-button blue" href = "halamanAbsen.php">Lihat Absen</a>
                <a class = "btn dropdown-button blue" href = "halamanEditAbsen.php">Edit Absen</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_frs"><i class="material-icons left">event_note</i>FRS</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "halamanFRSpending.php">FRS Pending</a>
                <a class = "btn dropdown-button blue" href = "halamanFRS.php">Lihat FRS</a>
                <a class = "btn dropdown-button blue" href = "halamanBatalTambah.php">Batal Tambah</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_ta"><i class="material-icons left">event_note</i>Tugas Akhir</a>
            <div id="menu_item4" hidden>
                <a class = "btn dropdown-button blue" href = "halamanTugasAkhir.php">Lihat TA</a>
                <a class = "btn dropdown-button blue" href = "halamanInsertTugasAkhir.php">Input TA</a>
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
        <div id="container" style="padding: 10px;">
            <h4>Jadwal Quiz</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date, k.Kelas_Ruangan 
                    FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m 
                    WHERE jp.Kelas_ID = k.Kelas_ID 
                    AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID 
                    AND mk.Matkul_ID = m.Matkul_ID 
                    AND jp.Keterangan = 'quiz'
                    AND k.DosenPengajar_ID = '$dosenID' 
                    ORDER BY Penting_Date";
                    $listQuiz = $conn->query($query);
                    if(mysqli_num_rows($listQuiz) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                        echo "<th>Ruangan</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listQuiz as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "<td>$value[Kelas_Ruangan]</td>";
                    echo "</tr>";
                }
            ?>
            </table><br><br>

            <h4>Jadwal UTS</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date, k.Kelas_Ruangan 
                    FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m 
                    WHERE jp.Kelas_ID = k.Kelas_ID 
                    AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID 
                    AND mk.Matkul_ID = m.Matkul_ID 
                    AND jp.Keterangan = 'uts'
                    AND k.DosenPengajar_ID = '$dosenID' 
                    ORDER BY Penting_Date";
                    $listUts = $conn->query($query);
                    if(mysqli_num_rows($listUts) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                        echo "<th>Ruangan</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listUts as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "<td>$value[Kelas_Ruangan]</td>";
                    echo "</tr>";
                }
            ?>
            </table><br><br>

            <h4>Jadwal UAS</h4>
            <table border="1" style="width: 500px;">
            <tr>
                <?php
                    $query = "SELECT DISTINCT m.Matkul_Nama, jp.Penting_Date, k.Kelas_Ruangan 
                    FROM Jadwal_Penting jp, Kelas k, Matkul_Kurikulum mk, Matkul m 
                    WHERE jp.Kelas_ID = k.Kelas_ID 
                    AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID 
                    AND mk.Matkul_ID = m.Matkul_ID 
                    AND jp.Keterangan = 'uas'
                    AND k.DosenPengajar_ID = '$dosenID' 
                    ORDER BY Penting_Date";
                    $listUas = $conn->query($query);
                    if(mysqli_num_rows($listUas) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>Matkul</th>";
                        echo "<th>Tanggal</th>";
                        echo "<th>Ruangan</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($listUas as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Penting_Date]</td>";
                    echo "<td>$value[Kelas_Ruangan]</td>";
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