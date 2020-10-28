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
    <title>Update Praktikum</title>
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
                    url : "updatePraktikum.php",
                    data : {
                        id : $("#id").val(),
                        matkulkurikulum : $("#matkulkurikulum").val(),
                        nama : $("#nama").val(),
                        hari : $("#hari").val(),
                        mulai : $("#mulai").val(),
                        selesai : $("#selesai").val(),
                        standar : $("#minimum").val()
                    },
                    success : function (hasil) {
                        var nama = $("#nama").val();
                        if(hasil == 1){
                            alert("Praktikum " + nama + " Berhasil Diperbaharui");
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
                <li><a href = "insertKelasPraktikum.php">Insert Kelas Praktikum</a></li>
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
                <h3>Update Data Praktikum</h3><br>
                <p>ID: </p>
                <input type="text" id="id" value="<?=$_SESSION['praktikum']['id']?>" disabled><br>
                <p>Matkul Kurikulum: </p> 
                <div class="input-field col s12">
                    <select name="matkulkurikulum" id="matkulkurikulum">
                        <?php
                            $query = "SELECT * FROM Matkul_Kurikulum WHERE Praktikum_ID = ''";
                            $listMatkulKurikulum = $conn->query($query);
                            foreach ($listMatkulKurikulum as $key => $value) {
                                $idMatkulKurikulum = $value['Matkul_Kurikulum_ID'];
                                $idMatkul = $value['Matkul_ID'];
                                $idJurusan = $value['Jurusan_ID'];
                                
                                $query = "SELECT * FROM Matkul";
                                $listMatkul = $conn->query($query);
                                foreach ($listMatkul as $key => $value) {
                                    if($value['Matkul_ID'] == $idMatkul){
                                        $namaMatkul = $value['Matkul_Nama'];
                                    }
                                }

                                $query = "SELECT * FROM Jurusan";
                                $listJurusan = $conn->query($query);
                                foreach ($listJurusan as $key => $value) {
                                    if($value['Jurusan_ID'] == $idJurusan){
                                        $namaJurusan = $value['Jurusan_Nama'];
                                    }
                                }

                                if($idMatkulKurikulum == $_SESSION['praktikum']['matkulkurikulum']){
                                    echo "<option value='$idMatkulKurikulum' selected>".$namaMatkul." - ".$namaJurusan."</option>";
                                }else{
                                    echo "<option value='$idMatkulKurikulum'>".$namaMatkul." - ".$namaJurusan."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <p>Nama: </p>
                <input type="text" id="nama" value="<?=$_SESSION['praktikum']['nama']?>"><br>
                <p>Hari : </p>
                <div class="input-field col s12">
                    <select name="hari" id="hari">
                        <?php
                            if($_SESSION['praktikum']['hari'] == "Senin"){
                                echo "<option value='Senin' selected>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Selasa"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa' selected>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Rabu"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu' selected>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Kamis"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis' selected>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Jumat"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat' selected>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Sabtu"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu' selected>Sabtu</option>
                                    <option value='Minggu'>Minggu</option>";
                            }else if($_SESSION['praktikum']['hari'] == "Minggu"){
                                echo "<option value='Senin'>Senin</option>
                                    <option value='Selasa'>Selasa</option>
                                    <option value='Rabu'>Rabu</option>
                                    <option value='Kamis'>Kamis</option>
                                    <option value='Jumat'>Jumat</option>
                                    <option value='Sabtu'>Sabtu</option>
                                    <option value='Minggu' selected>Minggu</option>";
                            }
                        ?>
                        
                    </select>
                </div>
                <p>Waktu Mulai : </p>
                <input type="time" name="mulai" id="mulai" value="<?=$_SESSION['praktikum']['mulai']?>">
                <p>Waktu Selesai : </p>
                <input type="time" name="selesai" id="selesai" value="<?=$_SESSION['praktikum']['selesai']?>">
                <p>Nilai Minimum : </p>
                <input type="text" name="minimum" id="minimum" value="<?=$_SESSION['praktikum']['standar']?>">
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update<i class="material-icons right">edit</i></button>
            </div>
        </div>
    </div>
</body>
</html>