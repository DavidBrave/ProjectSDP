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

    if(isset($_POST['btnRemove'])){
        $matkulkurikulumid = $_POST['hidId'];
        $str = "";
        for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
            if($selectedMatkuls[$i] != $matkulkurikulumid){
                if($i == sizeof($selectedMatkuls)-1){
                    $str = $str.$selectedMatkuls[$i];
                }else{
                    $str = $str.$selectedMatkuls[$i].",";
                }
            }
        }
        $_SESSION['matkul'] = $str;
        $selectedMatkuls = explode(",", $_SESSION['matkul']);
    }

    if(isset($_POST['btnSubmit'])){
        if(isset($_POST['praktikum'])){
            $praktikum = $_POST['praktikum'];
            $mahasiswa = $_SESSION['user']['user'];
            for ($i=0; $i < sizeof($praktikum); $i++) { 
                $kelas = $praktikum[$i];
                $query = "INSERT INTO Pengambilan_Praktikum VALUES('','$mahasiswa','$kelas',0,0,1)";
                $conn->query($query);
            }
            for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
                $matkul = $selectedMatkuls[$i];
                $query = "INSERT INTO FRS VALUES('', '$mahasiswa', '$matkul', '')";
                $conn->query($query);
            }
        }else{
            $mahasiswa = $_SESSION['user']['user'];
            for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
                $matkul = $selectedMatkuls[$i];
                $query = "INSERT INTO FRS VALUES('', '$mahasiswa', '$matkul', '')";
                $conn->query($query);
            }
        }
        echo '<script language = "javascript">';
        echo "alert('FRS berhasil')";
        echo '</script>';
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
            height: 1200px;
            width: 1000px;
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
            <h2>FRS</h2>
            <h4>Mata kuliah yang dipilih</h4>
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Matkul</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th></th>
                </tr>
            <?php
                $success = true;
                if(isset($_SESSION['matkul']) && $_SESSION['matkul'] != null){
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
                        $isCollision = false;
                        for ($j=0; $j < sizeof($selectedMatkuls); $j++) { 
                            $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, jk.Jadwal_Hari, jk.Jadwal_Mulai, jk.Jadwal_Selesai,mk.Semester, mk.SKS FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Jadwal_Kuliah jk
                            WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID AND k.Kelas_ID = jk.Kelas_ID AND mk.Matkul_Kurikulum_ID = '$selectedMatkuls[$j]'";
                            $matkul2 = mysqli_fetch_array($conn->query($query));
                            $jadwalMulai2 = $matkul2['Jadwal_Mulai'];
                            $jadwalHari2 = $matkul2['Jadwal_Hari'];
                            if($jadwalHari2 == $jadwalHari && $jadwalMulai2 == $jadwalMulai && $selectedMatkuls[$j] != $selectedMatkul){
                                $isCollision = true;
                            }
                        }
                        if($isCollision){
                            $success = false;
                            echo "<tr style='background-color: red;'>";
                        }else{
                            echo "<tr>";
                        }
                        echo "<td>$matkulkurikulumid</td>";
                        echo "<td>$matkulnama</td>";
                        echo "<td>$jadwalHari</td>";
                        echo "<td>$jadwalMulai</td>";
                        echo "<td>$jadwalSelesai</td>";
                        echo "<td>$semester</td>";
                        echo "<td>$sks</td>";
                        echo "<td><form action='#' method='post'><input type='submit' name='btnRemove' value='Remove' class='btn waves-effect red darken-3' style='height: 35px;'><input type='hidden' name='hidId' value='$matkulkurikulumid'></form></td>";
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
            <h4>Praktikum</h4>
            <form action="#" method="post">
            <table>
                <?php
                    for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
                        $selectedMatkul = $selectedMatkuls[$i];
                        $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, p.Praktikum_ID, p.Praktikum_Nama, p.Praktikum_Hari, p.Praktikum_Jam_Mulai, p.Praktikum_Jam_Selesai, kp.Kelas_Praktikum_ID, kp.Kelas_Praktikum_Ruangan, kp.Kelas_Praktikum_Kapasitas FROM Matkul_Kurikulum mk, Matkul m, Praktikum p, Kelas_Praktikum kp
                        WHERE mk.Praktikum_ID = p.Praktikum_ID AND mk.Matkul_ID = m.Matkul_ID AND p.Praktikum_ID = kp.Praktikum_ID AND mk.Matkul_Kurikulum_ID = '$selectedMatkul'";
                        $listKelasPraktikum = $conn->query($query);
                        foreach ($listKelasPraktikum as $key => $value) {
                            echo "<tr>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[Praktikum_Hari]</td>";
                            echo "<td>$value[Praktikum_Jam_Mulai]</td>";
                            echo "<td>$value[Praktikum_Jam_Selesai]</td>";
                            echo "<td>$value[Kelas_Praktikum_Ruangan]</td>";
                            echo "<td>$value[Kelas_Praktikum_Kapasitas]</td>";
                            echo "<td><p><label><input type='checkbox' class='praktikum' name='praktikum[]' value='$value[Kelas_Praktikum_ID]'/><span></span></label></p></td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
            <br>
            <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnBack"><a href="HalamanFRS.php" style="color: black;"><i class="material-icons left">navigate_before</i>Back</a></button>
            <?php
            if(!$success || $_SESSION['matkul'] == null){
            ?>
                <button disabled class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;" type="submit" id="btnSubmit" name="btnSubmit"><i class="material-icons right" style="color: black;">navigate_next</i><p style="color: black; margin: 0px;">Submit</p></button>
            <?php
            }else{
            ?>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;" type="submit" id="btnSubmit" name="btnSubmit"><i class="material-icons right" style="color: black;">navigate_next</i><p style="color: black; margin: 0px;">Submit</p></button>
            <?php
            }
            ?>
            </form>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>