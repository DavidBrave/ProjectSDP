<?php
    session_start();
    require_once("../Required/Connection.php");
    $id = "";
    $semester = 0;

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if(isset($_SESSION['mahasiswaID'])) {
        $id = $_SESSION['mahasiswaID'];

        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = $id";
        $mahasiswa = $conn->query($query);
        foreach($mahasiswa as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
            $semester = $value['Mahasiswa_Semester'];
        }

        $query = "SELECT * FROM Pengambilan_Praktikum WHERE Mahasiswa_ID = $id";
        $listPrak = $conn->query($query);
    }

    $selectedMatkuls = explode(",", $_SESSION['matkul']);

    if(isset($_POST['btnRemove'])){
        $matkulkurikulumid = $_POST['hidId'];
        $str = "";
        for ($i=0; $i < sizeof($selectedMatkuls)-1; $i++) { 
            if($selectedMatkuls[$i] != $matkulkurikulumid){
                if($i == sizeof($selectedMatkuls)-1){
                    $str = $str.$selectedMatkuls[$i];
                }else{
                    $str = $str.$selectedMatkuls[$i].",";
                }
            }
        }
        $str = $str.$selectedMatkuls[sizeof($selectedMatkuls)-1];
        $_SESSION['matkul'] = $str;
    }

    $selectedMatkuls = explode(",", $_SESSION['matkul']);

    if(isset($_POST['btnSubmit'])){
        $praktikum = $_POST['praktikum'];
        $query = "DELETE FROM FRS WHERE Mahasiswa_ID = '$id'";
        $conn->query($query);
        $query = "DELETE FROM Pengambilan_Praktikum WHERE Mahasiswa_ID = '$id'";
        $conn->query($query);

        for ($i=0; $i < sizeof($praktikum); $i++) { 
            $kelas = $praktikum[$i];
            $query = "INSERT INTO Pengambilan_Praktikum VALUES('','$id','$kelas',0,1, $semester)";
            $conn->query($query);
        }
        for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
            $matkul = $selectedMatkuls[$i];
            $query = "INSERT INTO FRS VALUES('', '$id', '$matkul', 'Diterima')";
            $conn->query($query);
            $query = "INSERT INTO Pengambilan VALUES('', '$id', '', 0,0,0,0,'',0,0,1, $semester)";
            $conn->query($query);
        }
        header("location: halamanFRSpending.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRS</title>
    <link rel="stylesheet" href="Dosen.css">
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
        <div id="container" style="padding: 20px;">
            <h3>FRS Mahasiswa <?=$nama?> (Pending)</h3><br>
            <label>NRP: <?=$id?></label><br>
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
                        $query = "SELECT mk.Matkul_Kurikulum_ID, m.Matkul_Nama, jk.Jadwal_Hari, jk.Jadwal_Mulai, jk.Jadwal_Selesai,mk.Semester, mk.SKS 
                        FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Jadwal_Kuliah jk
                        WHERE mk.Matkul_ID = m.Matkul_ID 
                        AND mk.Matkul_Kurikulum_ID = k.Matkulkurikulum_ID 
                        AND k.Kelas_ID = jk.Kelas_ID 
                        AND mk.Matkul_Kurikulum_ID = '$selectedMatkuls[$j]'";
                        $matkul2 = mysqli_fetch_array($conn->query($query));
                        $jadwalMulai2 = $matkul2['Jadwal_Mulai'];
                        $jadwalHari2 = $matkul2['Jadwal_Hari'];
                        if($jadwalHari2 == $jadwalHari && $jadwalMulai2 == $jadwalMulai && $selectedMatkuls[$j] != $selectedMatkul){
                            $isCollision = true;
                        }
                    }
                    if($isCollision){
                        $success = false;
                        echo "<tr style='background-color: maroon; color: white;'>";
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
            ?>
            </table>
            <br>
            <h4>Praktikum</h4>
            <form action="#" method="post">
            <table>
                <?php
                    for ($i=0; $i < sizeof($selectedMatkuls); $i++) { 
                        $selectedMatkul = $selectedMatkuls[$i];
                        $query = "SELECT kp.Kelas_Praktikum_ID, mk.Matkul_Kurikulum_ID, m.Matkul_Nama, p.Praktikum_ID, p.Praktikum_Nama, p.Praktikum_Hari, p.Praktikum_Jam_Mulai, p.Praktikum_Jam_Selesai, kp.Kelas_Praktikum_ID, kp.Kelas_Praktikum_Ruangan, kp.Kelas_Praktikum_Kapasitas FROM Matkul_Kurikulum mk, Matkul m, Praktikum p, Kelas_Praktikum kp
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
                            $ada = false;
                            foreach($listPrak as $key2 => $value2) {
                                if ($value2['Kelas_Praktikum_ID'] == $value['Kelas_Praktikum_ID']) {
                                    $ada = true;
                                }
                            }
                            if ($ada) {
                                echo "<td><p><label><input type='checkbox' class='praktikum' name='praktikum[]' value='$value[Kelas_Praktikum_ID]' checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='praktikum' name='praktikum[]' value='$value[Kelas_Praktikum_ID]'/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
            <br>
            <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnBack"><a href="HalamanDetailFRSpending.php" style="color: black;"><i class="material-icons left">navigate_before</i>Back</a></button>
            <?php
            if(!$success || $_SESSION['matkul'] == null){
            ?>
                <button disabled class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;" type="submit" id="btnSubmit" name="btnSubmit"><i class="material-icons right" style="color: black;">navigate_next</i><p style="color: black; margin: 0px;">Terima</p></button>
            <?php
            }else{
            ?>
                <button class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px; float: right;" type="submit" id="btnSubmit" name="btnSubmit"><i class="material-icons right" style="color: black;">navigate_next</i><p style="color: black; margin: 0px;">Terima</p></button>
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