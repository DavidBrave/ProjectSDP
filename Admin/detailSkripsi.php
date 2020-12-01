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

    $nrp = $_SESSION['mahasiswa']['id'];
    $query = "SELECT * FROM Skripsi s, Mahasiswa m WHERE s.Mahasiswa_ID = m.Mahasiswa_ID AND m.Mahasiswa_ID = '$nrp'";
    $skripsi = mysqli_fetch_array($conn->query($query));

    if(isset($_POST['btnSubmit'])){
        if(isset($_POST['dosen1']) && isset($_POST['dosen2']) && isset($_POST['dosen3']) && isset($_POST['tanggal']) && isset($_POST['mulai']) && isset($_POST['selesai']) && isset($_POST['ruangan'])){
            $dosen1 = $_POST['dosen1'];
            $dosen2 = $_POST['dosen2'];
            $dosen3 = $_POST['dosen3'];
            $tanggal = $_POST['tanggal'];
            $mulai = $_POST['mulai'];
            $selesai = $_POST['selesai'];
            $ruangan = $_POST['ruangan'];
            $query = "UPDATE Skripsi SET Dosen_Penguji1 = '$dosen1', Dosen_Penguji2 = '$dosen2', Dosen_Penguji3 = '$dosen3', Tanggal_Skripsi = '$tanggal', Jam_Mulai = '$mulai', Jam_Selesai = '$selesai', Ruangan_Skripsi = '$ruangan'
            WHERE Mahasiswa_ID = '$nrp'";
            $conn->query($query);
            echo "<script>alert('Berhasil')</script>";
        }else{
            echo "<script>alert('Inputan harus diisi')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin2.css">
    <style>
    </style>
    <script src="jquery.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</head>
<body>
    <div id="header">
        <h5 style="margin-top:10px; float:left; margin-left: 10px;">Sistem Informasi Mahasiswa</h5>
        <form action="#" method="post" style="float: right; margin-top:10px; margin-right: 10px;">
            <button class="btn waves-effect red accent-4" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" name="btnLogout">Logout
                <i class="material-icons right" style="margin: 0px;">settings_power</i>
            </button>
        </form>
    </div>
    <div id="content">
        <div id="col-kiri">
            <a class = "btn dropdown-button blue lighten-2" href = "Admin.php" style="width: 100%; color: black; padding-left: 0px;">Dashboard</a>
            
            <ul id = "dropdown" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataMahasiswa.php">Data Mahasiswa</a></li>
                <li><a href = "insertDataMahasiswa.php">Insert Data Mahasiswa</a></li>
                <li><a href = "halamanSkripsiMahasiswa.php">Skripsi Mahasiswa</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Mahasiswa<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown2" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataDosen.php">Data Dosen</a></li>
                <li><a href = "insertDataDosen.php">Insert Data Dosen</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown2" style="width: 100%; color: black;">Dosen<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown3" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanJurusan.php">Data Jurusan</a></li>
                <li><a href = "insertDataJurusan.php">Insert Data Jurusan</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown3" style="width: 100%; color: black;">Jurusan<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown4" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMajor.php">Data Major</a></li>
                <li><a href = "insertDataMajor.php">Insert Data Major</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown4" style="width: 100%; color: black;">Major<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMataKuliah.php">Data Mata Kuliah</a></li>
                <li><a href = "insertDataMataKuliah.php">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown5" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown6" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanKurikulum.php">Data Kurikulum</a></li>
                <li><a href = "insertDataKurikulum.php">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown6" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            
            <ul id = "dropdown7" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanPeriode.php">Data Periode</a></li>
                <li><a href = "insertPeriode.php">Insert Periode</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown7" style="width: 100%; color: black;">Periode<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown8" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMatkulKurikulum.php">Data Matkul Kurikulum</a></li>
                <li><a href = "insertMatkulKurikulum.php">Insert Data Matkul Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown8" style="width: 100%; color: black;">Matkul Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown9" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataPraktikum.php">Data Praktikum</a></li>
                <li><a href = "insertDataPraktikum.php">Insert Data Praktikum</a></li>
                <li><a href = "insertKelasPraktikum.php">Insert Kelas Praktikum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown9" style="width: 100%; color: black;">Praktikum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown10" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanJadwalKuliah.php">Data Jadwal Kuliah</a></li>
                <li><a href = "insertJadwalKuliah.php">Insert Jadwal Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown10" style="width: 100%; color: black;">Jadwal Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown11" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataKelas.php">Data Kelas</a></li>
                <li><a href = "insertDataKelas.php">Insert Data Kelas</a></li>
                <li><a href = "halamanPembagianKelas.php">Pembagian Kelas</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown11" style="width: 100%; color: black;">Kelas<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        
            <ul id = "dropdown12" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataJadwalPenting.php">Data Jadwal Ujian & Quiz</a></li>
                <li><a href = "insertDataJadwalPenting.php">Insert Data Jadwal Ujian & Quiz</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown12" style="width: 100%; color: black;">Jadwal Ujian & Quiz<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        </div> 
        <div id="col-kanan">
            <h3><?=$skripsi['Judul_Skripsi']?></h3>
            <p style="font-size: 25px;">Dibuat oleh <?=$skripsi['Mahasiswa_Nama']?></p><br>
            <form action="" method="post">
                <b>Dosen Penguji 1 : </b><br>
                <div class="input-field col s12" style="width: 500px;">
                    <select name="dosen1">
                        <option value="none" disabled selected>Pilih Dosen Penguji</option>
                        <?php
                            $query = "SELECT * FROM Dosen";
                            $dosen1 = $conn->query($query);
                            foreach ($dosen1 as $key) {
                                echo "<option value='$key[Dosen_ID]'>$key[Dosen_Nama]</option>";
                            }
                        ?>
                    </select>
                </div>
                <b>Dosen Penguji 2 : </b><br>
                <div class="input-field col s12" style="width: 500px;">
                    <select name="dosen2">
                        <option value="none" disabled selected>Pilih Dosen Penguji</option>
                        <?php
                            $query = "SELECT * FROM Dosen";
                            $dosen2 = $conn->query($query);
                            foreach ($dosen2 as $key) {
                                echo "<option value='$key[Dosen_ID]'>$key[Dosen_Nama]</option>";
                            }
                        ?>
                    </select>
                </div>
                <b>Dosen Penguji 3 : </b><br>
                <div class="input-field col s12" style="width: 500px;">
                    <select name="dosen3">
                        <option value="none" disabled selected>Pilih Dosen Penguji</option>
                        <?php
                            $query = "SELECT * FROM Dosen";
                            $dosen3 = $conn->query($query);
                            foreach ($dosen3 as $key) {
                                echo "<option value='$key[Dosen_ID]'>$key[Dosen_Nama]</option>";
                            }
                        ?>
                    </select>
                </div>
                <b>Tanggal : </b><br>
                <input type="date" name="tanggal" id="" style="width: 500px;"><br>
                <b>Jam Mulai : </b><br>
                <input type="time" name="mulai" id="" style="width: 500px;"><br>
                <b>Jam Selesai : </b><br>
                <input type="time" name="selesai" id="" style="width: 500px;"><br>
                <b>Ruangan : </b><br>
                <input type="text" name="ruangan" id="" style="width: 500px;"><br>
                <button class="btn waves-effect blue lighten-1" type="submit" name="btnSubmit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>