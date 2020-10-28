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

    $selectedMatkuls = explode(",", $_SESSION['matkul']);
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
                <a class = "btn dropdown-button blue" href = "#">Laporan Nilai</a>
                <a class = "btn dropdown-button blue" href = "#">Nilai Praktikum</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Kuliah</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Dosen</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Praktikum</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#"><i class="material-icons left">event_available</i>Absen</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_rencana"><i class="material-icons left">event_note</i>Rencana Studi</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanFRS.php">FRS</a>
                <a class = "btn dropdown-button blue" href = "#">Batal Tambah</a>
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
            <h2>FRS</h2>
            <h4>Mata kuliah yang dipilih</h4>
            <form action="#" method="post">
                <table>
                <?php
                    for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
                        $selectedMatkul = $selectedMatkuls[$i];
                        $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, jk.Jadwal_Hari, jk.Jadwal_Mulai, jk.Jadwal_Selesai,mk.Semester, mk.SKS FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Jadwal_Kuliah jk
                        WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID AND k.Kelas_ID = jk.Kelas_ID AND mk.Matkul_Kurikulum_ID = '$selectedMatkul'";
                        $matkul = mysqli_fetch_array($conn->query($query));
                        $matkulkurikulumid = $matkul['Matkul_Kurikulum_ID'];
                        $matkulnama = $matkul['Matkul_Nama'];
                        $semester = $matkul['Semester'];
                        $jadwalHari = $matkul['Jadwal_Hari'];
                        $jadwalMulai = $matkul['Jadwal_Mulai'];
                        $jadwalSelesai = $matkul['Jadwal_Selesai'];
                        $sks = $matkul['SKS'];
                        echo "<tr>";
                        echo "<td>$matkulkurikulumid</td>";
                        echo "<td>$matkulnama</td>";
                        echo "<td>$jadwalHari</td>";
                        echo "<td>$jadwalMulai</td>";
                        echo "<td>$jadwalSelesai</td>";
                        echo "<td>$semester</td>";
                        echo "<td>$sks</td>";
                        echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$matkulkurikulumid"."-".$matkulnama."'/><span></span></label></p></td>";
                        echo "</tr>";
                    }
                ?>
                </table>
                <br>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnBack"><a href="HalamanFRS.php" style="color: black;"><i class="material-icons left">navigate_before</i>Back</a></button>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnNext"><i class="material-icons right" style="color: black;">navigate_next</i><p style="color: black; margin: 0px;">Submit</p></button>
            </form>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>