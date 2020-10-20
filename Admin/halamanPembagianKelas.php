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

    if(isset($_POST['btnInsert'])){
        $kelas = $_POST['kelas'];
        $mahasiswa = $_POST['mahasiswa'];
        $query = "SELECT Kelas_Kapasitas FROM Kelas WHERE Kelas_ID = '$kelas'";
        $kapasitas = $conn->query($query);
        foreach ($kapasitas as $key => $value) {
            $count = $value['Kelas_Kapasitas'];
        }
        $count = $count-1;
        $query = "UPDATE Kelas SET Kelas_Kapasitas = $count WHERE Kelas_Id = '$kelas'";
        $conn->query($query);

        $query = "UPDATE Pengambilan SET Kelas_ID = '$kelas' WHERE Mahasiswa_Id = '$mahasiswa'";
        $conn->query($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembagian Kelas</title>
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
        $(document).ready(function() {
            $('select').material_select();

            $('#kelas').change(function () {
                $.ajax({
                    method : 'post',
                    url : 'daftarAmbilMahasiswa.php',
                    data : {
                        id : $('#kelas').val()
                    },
                    success : function (hasil) {
                        $("#content-mahasiswa").html(hasil);
                        $("#temp").hide();
                    }
                });
            });
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
                <li><a href = "halamanKurikulum.php">Data Kurikulum</a></li>
                <li><a href = "insertDataKurikulum.php">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown4" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMataKuliah.php">Data Mata Kuliah</a></li>
                <li><a href = "insertDataMataKuliah.php">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown5" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown6" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMajor.php">Data Major</a></li>
                <li><a href = "insertDataMajor.php">Insert Data Major</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown6" style="width: 100%; color: black;">Major<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        
            <ul id = "dropdown7" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanJadwalKuliah.php">Data Jadwal Kuliah</a></li>
                <li><a href = "insertJadwalKuliah.php">Insert Jadwal Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown7" style="width: 100%; color: black;">Jadwal Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown8" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanMatkulKurikulum.php">Data Matkul Kurikulum</a></li>
                <li><a href = "insertMatkulKurikulum.php">Insert Data Matkul Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown8" style="width: 100%; color: black;">Matkul Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown9" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataPraktikum.php">Data Praktikum</a></li>
                <li><a href = "insertDataPraktikum.php">Insert Data Praktikum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown9" style="width: 100%; color: black;">Praktikum<i class = "mdi-navigation-arrow-drop-down right"></i></a>

            <ul id = "dropdown10" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataKelas.php">Data Kelas</a></li>
                <li><a href = "insertDataKelas.php">Insert Data Kelas</a></li>
                <li><a href = "halamanPembagianKelas.php">Pembagian Kelas</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown10" style="width: 100%; color: black;">Kelas<i class = "mdi-navigation-arrow-drop-down right"></i></a>
             
        </div> 
        <div id="col-kanan">
            <div style="width: 50%;">
                <h3>Pembagian Kelas</h3><br>
                <form action="#" method="post">
                    <p>Kelas : </p>
                    <div class="input-field col s12">
                        <select name="kelas" id="kelas">
                            <option value="none" disabled selected>Pilih Kelas</option>
                            <?php
                                $query = "SELECT kls.Kelas_ID, kls.Kelas_Nama, kls.Matkulkurikulum_ID, mk.Matkul_Nama, j.Jurusan_Nama, kls.Kelas_Ruangan, kls.Kelas_Kapasitas FROM Kelas kls, Matkul_Kurikulum mkl, Matkul mk, Jurusan j
                                WHERE kls.Matkulkurikulum_ID = mkl.Matkul_Kurikulum_ID AND mkl.Matkul_ID = mk.Matkul_ID AND mkl.Jurusan_ID = j.Jurusan_ID";
                                $listKelas = $conn->query($query);
                                foreach ($listKelas as $key => $value) {
                                    echo "<option value='$value[Kelas_ID]'>[ ".$value['Kelas_Nama']." ] ".$value['Matkul_Nama']." - ".$value['Jurusan_Nama']." - ".$value['Kelas_Ruangan']." - ".$value['Kelas_Kapasitas']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <p>Mahasiswa : </p>
                    <div class="input-field col s12" id="content-mahasiswa">
                        <select name="temp" id="temp" disabled>
                            <option value="none" selected>Pilih Mahasiswa</option>
                        </select>
                    </div>
                    <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" name="btnInsert">Insert</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>