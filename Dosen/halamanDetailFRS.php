<?php
    session_start();
    require_once('../Required/Connection.php');
    $id = "";

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if(isset($_POST['btnBack'])){
        header("location: halamanFRS.php");
    }

    if(isset($_SESSION['detailFRS'])) {
        $id = $_SESSION['detailFRS'];
        $query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = $id";
        $mahasiswa = $conn->query($query);
        foreach($mahasiswa as $key => $value) {
            $nama = $value['Mahasiswa_Nama'];
        }
    }

    $query = "SELECT m.Matkul_Nama, mk.Matkul_Kurikulum_ID FROM FRS a, Matkul m, Matkul_Kurikulum mk 
    WHERE a.Mahasiswa_ID = $id
    AND a.Matkul_Kurikulum_ID = mk.Matkul_Kurikulum_ID
    AND mk.Matkul_ID = m.Matkul_ID";
    $listMatkul = $conn->query($query);

    $matkuls = array();
    foreach ($listMatkul as $key => $value) {
        array_push($matkuls, $value['Matkul_Kurikulum_ID']);
    }

    $query = "SELECT * FROM Pengambilan_Praktikum WHERE Mahasiswa_ID = $id";
    $listPrak = $conn->query($query);

    $nrp = $id;
    $query = "SELECT m.*, j.Jurusan_ID, j.Jurusan_Nama FROM Mahasiswa m, Jurusan j
              WHERE SUBSTR(m.Mahasiswa_ID,4,3) = SUBSTR(j.Jurusan_ID,2,3) AND m.Mahasiswa_ID = '$nrp'";
    $mahasiswa = mysqli_fetch_array($conn->query($query));
    $nrp = $mahasiswa['Mahasiswa_ID'];
    $semester = (int)$mahasiswa['Mahasiswa_Semester'];
    $jurusan = $mahasiswa['Jurusan_ID'];
    $semesterLalu = $semester - 1;
    if($semester == 1){
        $sksTotal = 18;
    }else{
        $query = "SELECT p.Pengambilan_Grade FROM Mahasiswa m, Pengambilan p, Kelas k, Matkul_Kurikulum mk 
                  WHERE m.Mahasiswa_ID = p.Mahasiswa_ID AND p.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND m.Mahasiswa_ID = '$nrp' AND mk.Semester = $semesterLalu";
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
            <h3>FRS Mahasiswa <?=$nama?></h3><br>
            <label>NRP: <?=$id?></label><br>
            <h5 id="maxSks">Max SKS: <?=$sksTotal?></h5><br>
            <form action="#" method="post">
            <h4>Semester 1</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 1";
                    $semester1 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 1";
                    $sksSemester1 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester1[total]</th></tr>";
                    if($sksSemester1["Semester"]%2 != $semester%2){
                        foreach ($semester1 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester1 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 2</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 2";
                    $semester2 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 2";
                    $sksSemester2 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester2[total]</th></tr>";
                    if($sksSemester2["Semester"]%2 != $semester%2){
                        foreach ($semester2 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester2 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 3</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 3";
                    $semester3 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 3";
                    $sksSemester3 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester3[total]</th></tr>";
                    if($sksSemester3["Semester"]%2 != $semester%2){
                        foreach ($semester3 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester3 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 4</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 4";
                    $semester4 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 4";
                    $sksSemester4 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester4[total]</th></tr>";
                    if($sksSemester4["Semester"]%2 != $semester%2){
                        foreach ($semester4 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester4 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 5</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 5";
                    $semester5 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 5";
                    $sksSemester5 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester5[total]</th></tr>";
                    if($sksSemester5["Semester"]%2 != $semester%2){
                        foreach ($semester5 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester5 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 6</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 6";
                    $semester6 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 6";
                    $sksSemester6 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester6[total]</th></tr>";
                    if($sksSemester6["Semester"]%2 != $semester%2){
                        foreach ($semester6 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester6 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 7</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 7";
                    $semester7 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 7";
                    $sksSemester7 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester7[total]</th></tr>";
                    if($sksSemester7["Semester"]%2 != $semester%2){
                        foreach ($semester7 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester7 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?>
                <h4>Semester 8</h4>    
                <?php
                    $query = "SELECT mk.Matkul_Kurikulum_ID, mk.SKS, m.Matkul_Nama FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 8";
                    $semester8 = $conn->query($query);
                    $query = "SELECT SUM(mk.SKS) as total, mk.Semester FROM Matkul_Kurikulum mk, Matkul m WHERE mk.Matkul_ID = m.Matkul_ID AND mk.Jurusan_ID = '$jurusan' AND mk.Semester = 8";
                    $sksSemester8 = mysqli_fetch_array($conn->query($query));
                    echo "<table style='width: 600px;'>";
                    echo "<tr><th colspan='3' style='text-align: right;'>$sksSemester7[total]</th></tr>";
                    if($sksSemester8["Semester"]%2 != $semester%2){
                        foreach ($semester8 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }else{
                        foreach ($semester8 as $key => $value) {
                            $cek = false;
                            echo "<tr>";
                            echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                            echo "<td>$value[Matkul_Nama]</td>";
                            echo "<td>$value[SKS]</td>";
                            foreach ($listMatkul as $key2 => $value2) {
                                if ($value['Matkul_Kurikulum_ID'] == $value2['Matkul_Kurikulum_ID']) {
                                    $cek = true;
                                }
                            }
                            if ($cek) {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled checked/><span></span></label></p></td>";
                            }
                            else {
                                echo "<td><p><label><input type='checkbox' class='matkul' name='matkul[]' value='$value[Matkul_Kurikulum_ID]' disabled/><span></span></label></p></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                ?> 
                <br>
                <br>
                <h4>Praktikum</h4>
                <table>
                    <?php
                        for ($i=0; $i < sizeof($matkuls); $i++) { 
                            $selectedMatkul = $matkuls[$i];
                            $query = "SELECT kp.Kelas_Praktikum_ID, mk.Matkul_Kurikulum_ID, m.Matkul_Nama, p.Praktikum_ID, p.Praktikum_Nama, p.Praktikum_Hari, p.Praktikum_Jam_Mulai, p.Praktikum_Jam_Selesai, kp.Kelas_Praktikum_ID, kp.Kelas_Praktikum_Ruangan, kp.Kelas_Praktikum_Kapasitas 
                            FROM Matkul_Kurikulum mk, Matkul m, Praktikum p, Kelas_Praktikum kp
                            WHERE mk.Praktikum_ID = p.Praktikum_ID 
                            AND mk.Matkul_ID = m.Matkul_ID 
                            AND p.Praktikum_ID = kp.Praktikum_ID 
                            AND mk.Matkul_Kurikulum_ID = '$selectedMatkul'";
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
                                    echo "<td><p><label><input type='checkbox' class='praktikum' name='praktikum[]' value='$value[Kelas_Praktikum_ID]' disabled checked/><span></span></label></p></td>";
                                }
                                else {
                                    echo "<td><p><label><input type='checkbox' class='praktikum' name='praktikum[]' value='$value[Kelas_Praktikum_ID]' disabled/><span></span></label></p></td>";
                                }
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" name="btnBack"><i class="material-icons right">navigate_before</i> Back</button>    
            </form>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>