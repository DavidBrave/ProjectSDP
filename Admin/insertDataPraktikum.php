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

    if (isset($_POST['btnInsert'])) {
        $matkulKurikulum = $_POST['matkulKurikulum'];
        $nama = $_POST['nama'];
        $hari = $_POST['hari'];
        $mulai = $_POST['mulai'];
        $selesai = $_POST['selesai'];
        $minimum = $_POST['minimum'];

        if ($nama != "" && $hari != "" && $matkulKurikulum != "" && $mulai != "" && $selesai != "" && $minimum != "") {
            $query = "SELECT * FROM Praktikum";
            $praktikum = $conn->query($query);
            $isCollision = false;
            foreach ($praktikum as $key => $value) {
                if($value['Praktikum_Jam_Mulai'] == $mulai.":00" && $value['Praktikum_Hari'] == $hari){
                    $isCollision = true;
                }
            }

            if($isCollision){
                echo '<script language = "javascript">';
                echo "alert('Jadwal Praktikum $nama Bertabrakan dengan Jadwal Praktikum Lain')";
                echo '</script>';
            }else{
                $query = "SELECT * FROM Praktikum";
                $jumlah = mysqli_num_rows($conn->query($query)) + 1;

                if($jumlah == 1){
                    $id = "P0001";
                }else{
                    $query = "SELECT * FROM Praktikum ORDER BY Praktikum_ID DESC LIMIT 1";
                    $last = $conn->query($query);
                    foreach ($last as $key => $value) {
                        $jumlah = (int)(substr($value['Praktikum_ID'],1,4))+1;
                    }

                    if($jumlah < 10){
                        $id = "P000".$jumlah;
                    }else if($jumlah > 9 && $jumlah < 100){
                        $id = "P00".$jumlah;
                    }else if($jumlah > 99 && $jumlah < 1000){
                        $id = "P0".$jumlah;
                    }else{
                        $id = "P".$jumlah;
                    }
                }

                $query = "INSERT INTO Praktikum VALUES('$id', '$matkulKurikulum', '$nama', '$hari', '$mulai', '$selesai', $minimum)";
                $conn->query($query);

                $query = "UPDATE Matkul_Kurikulum SET Praktikum_ID = '$id' WHERE Matkul_Kurikulum_ID = '$matkulKurikulum'";
                $conn->query($query);
                
                echo '<script language = "javascript">';
                echo "alert('Berhasil Insert Praktikum $nama')";
                echo '</script>';
            }
        }
        else {
            echo '<script language = "javascript">';
            echo "alert('Semua Field Harus Diisi')";
            echo '</script>';
        }
    }

    $query = "SELECT * FROM Matkul_Kurikulum WHERE Praktikum_ID=''";
    $listMatkulKurikulum = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Praktikum</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin2.css">
    <style>
        p{
            font-size: 20px;
        }
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

            $("#periode").change(function () {
                var periodeId = $("#periode").val();
                $.ajax({
                    method : "post",
                    url : "cekMatkulkurikulumPeriode.php",
                    data : {
                        id : periodeId
                    },
                    success : function (hasil) {
                        $("#matkulKurikulum-container1").hide();
                        $("#matkulKurikulum-container2").html(hasil);
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
                <h3>Insert Data Praktikum</h3><br>
                <form action = "#" method = "post">
                    <div class="input-field col s12">
                        <select name="periode" id="periode">
                            <option value="none" disabled selected>Pilih Periode</option>
                            <?php
                                $query = "SELECT * FROM Periode";
                                $periode = $conn->query($query);
                                foreach ($periode as $key) {
                                    echo "<option value='$key[Periode_ID]'>$key[Periode_Nama]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <p>Matkul Kurikulum : </p>
                    <div class="input-field col s12">
                        <div id="matkulKurikulum-container1">
                            <select name="matkulKurikulum" disabled>
                                <option value="none" selected disabled>Pilih Matkul Kurikulum</option>
                            </select>
                        </div>
                        <div id="matkulKurikulum-container2">

                        </div>
                    </div>
                    <p>Nama Praktikum : </p>
                    <input type="text" name="nama">
                    <p>Hari : </p>
                    <div class="input-field col s12">
                        <select name="hari">
                            <option value="none" disabled selected>Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <p>Waktu Mulai : </p>
                    <input type="time" name="mulai" id="">
                    <p>Waktu Selesai : </p>
                    <input type="time" name="selesai" id="">
                    <p>Nilai Minimum : </p>
                    <input type="text" name="minimum" id="">
                    <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" name = "btnInsert">Insert</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>