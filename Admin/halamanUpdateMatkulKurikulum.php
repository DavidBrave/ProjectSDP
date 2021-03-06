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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Matkul Kurikulum</title>
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

            $("#btnUpdate").click(function () {
                $.ajax({
                    method : "post",
                    url : "updateMatkulKurikulum.php",
                    data : {
                        id : $("#id").val(),
                        matkul : $("#matkul").val(),
                        jurusan : $("#jurusan").val(),
                        major : $("#major").val(),
                        kurikulum : $("#kurikulum").val(),
                        periode : $("#periode").val(),
                        semester : $("#semester").val(),
                        sks : $("#sks").val()
                    },
                    success : function (hasil) {
                        var id = $("#id").val();
                        if(hasil == 1){
                            alert("Matkul Kurikulum " + id + " Berhasil Diperbaharui");
                        }else{
                            alert("Pembaharuan Gagal");
                        }
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
            <div style="width: 50%;">
                <h3>Update Data Matkul Kurikulum</h3><br>
                ID: <input type="text" id="id" value="<?=$_SESSION['matkulKurikulum']['id']?>" disabled><br>
                Matkul: 
                <div class="input-field col s12">
                    <select name="matkul" id="matkul">
                        <?php
                            $query = "SELECT * FROM Matkul";
                            $listMatkul = $conn->query($query);
                            foreach ($listMatkul as $key => $value) {
                                if($value['Matkul_ID'] == $_SESSION['matkulKurikulum']['matkul']){
                                    echo "<option value='$value[Matkul_ID]' selected>".$value['Matkul_ID']." - ".$value['Matkul_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Matkul_ID]'>".$value['Matkul_ID']." - ".$value['Matkul_Nama']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                Jurusan: 
                <div class="input-field col s12">
                    <select name="jurusan" id="jurusan">
                        <?php
                            $query = "SELECT * FROM Jurusan";
                            $listJurusan = $conn->query($query);
                            foreach ($listJurusan as $key => $value) {
                                if($value['Jurusan_ID'] == $_SESSION['matkulKurikulum']['jurusan']){
                                    echo "<option value='$value[Jurusan_ID]' selected>".$value['Jurusan_ID']." - ".$value['Jurusan_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Jurusan_ID]'>".$value['Jurusan_ID']." - ".$value['Jurusan_Nama']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                Major: 
                <div class="input-field col s12">
                    <select name="major" id="major">
                        <?php
                            if($_SESSION['matkulKurikulum']['major'] == ""){
                                echo "<option value=''>Pilih Major</option>";
                                $query = "SELECT * FROM Major";
                                $listMajor = $conn->query($query);
                                foreach ($listMajor as $key => $value) {
                                    echo "<option value='$value[Major_ID]'>".$value['Major_ID']." - ".$value['Major_Nama']."</option>";
                                }
                            }else{
                                $query = "SELECT * FROM Major";
                                $listMajor = $conn->query($query);
                                foreach ($listMajor as $key => $value) {
                                    if($value['Major_ID'] == $_SESSION['matkulKurikulum']['major']){
                                        echo "<option value='$value[Major_ID]' selected>".$value['Major_ID']." - ".$value['Major_Nama']."</option>";
                                    }else{
                                        echo "<option value='$value[Major_ID]'>".$value['Major_ID']." - ".$value['Major_Nama']."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                Kurikulum: 
                <div class="input-field col s12">
                    <select name="kurikulum" id="kurikulum">
                        <?php
                            $query = "SELECT * FROM Kurikulum";
                            $listKurikulum = $conn->query($query);
                            foreach ($listKurikulum as $key => $value) {
                                if($value['Kurikulum_ID'] == $_SESSION['matkulKurikulum']['kurikulum']){
                                    echo "<option value='$value[Kurikulum_ID]' selected>".$value['Kurikulum_ID']." - ".$value['Kurikulum_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Kurikulum_ID]'>".$value['Kurikulum_ID']." - ".$value['Kurikulum_Nama']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                Periode: 
                <div class="input-field col s12">
                    <select name="periode" id="periode">
                        <?php
                            $query = "SELECT * FROM Periode";
                            $listPeriode = $conn->query($query);
                            foreach ($listPeriode as $key => $value) {
                                if($value['Periode_ID'] == $_SESSION['matkulKurikulum']['periode']){
                                    echo "<option value='$value[Periode_ID]' selected>".$value['Periode_ID']." - ".$value['Periode_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Periode_ID]'>".$value['Periode_ID']." - ".$value['Periode_Nama']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <p>Semester : </p>
                <input type="number" id="semester" min="0" value="<?=$_SESSION['matkulKurikulum']['semester']?>">
                <p>SKS : </p>
                <input type="number" id="sks" min="0" max="3" value="<?=$_SESSION['matkulKurikulum']['sks']?>">
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update<i class="material-icons right">edit</i></button>
            </div>
        </div>
    </div>
</body>
</html>