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
        $dosen = $_POST['dosen'];
        $ruangan = $_POST['ruangan'];
        $kapasitas = $_POST['kapasitas'];
        $nama = $_POST['nama'];
        $matkulkurikulum = $_POST['matkulkurikulum'];

        if ($dosen != "" && $ruangan != "" && $kapasitas != "" && $nama != "" && $matkulkurikulum != "") {
            $query = "SELECT * FROM Kelas";
            $jumlah = mysqli_num_rows($conn->query($query)) + 1;

            if($jumlah == 1){
                $id = "KLS0001";
            }else{
                $query = "SELECT * FROM Kelas ORDER BY Kelas_ID DESC LIMIT 1";
                $last = $conn->query($query);
                foreach ($last as $key => $value) {
                    $jumlah = (int)(substr($value['Kelas_ID'],3,4))+1;
                }

                if($jumlah < 10){
                    $id = "KLS000".$jumlah;
                }else if($jumlah > 9 && $jumlah < 100){
                    $id = "KLS00".$jumlah;
                }else if($jumlah > 99 && $jumlah < 1000){
                    $id = "KLS0".$jumlah;
                }else{
                    $id = "KLS".$jumlah;
                }
            }

            $query = "INSERT INTO Kelas VALUES('$id', '$matkulkurikulum', '$dosen', '$nama', '$ruangan', '$kapasitas')";
            $conn->query($query);
            
            echo '<script language = "javascript">';
            echo "alert('Berhasil Insert Kelas $id')";
            echo '</script>';
        }
        else {
            echo '<script language = "javascript">';
            echo "alert('Semua Field Harus Diisi')";
            echo '</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Kelas</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin2.css">
    <style>
        p{
            font-size: 20px;
        }
        #content{
            height: 1200px;
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

            $("#jurusan").change(function () {
                var jurusanlId = $("#jurusan").val();
                $.ajax({
                    method : "post",
                    url : "cekJurusanMatkulkurikulum.php",
                    data : {
                        id : jurusanlId
                    },
                    success : function (hasil) {
                        $("#mkl-container1").hide();
                        $("#mkl-container2").html(hasil);
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
        <div id="col-kanan" style="width: 50%;">
            <div>
                <h3>Insert Data Kelas</h3><br>
                <form action = "#" method = "post">
                    <p>Jurusan : </p>
                    <div class="input-field col s12">
                        <select name="jurusan" id="jurusan">
                            <option value="none" disabled selected>Pilih Jurusan</option>
                            <?php
                                $query = "SELECT * FROM Jurusan";
                                $listJurusan = $conn->query($query);
                                foreach ($listJurusan as $key) {
                                    echo "<option value='$key[Jurusan_ID]'>$key[Jurusan_Nama]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <p>Matkul Kurikulum : </p>
                    <div class="input-field col s12">
                        <div id="mkl-container1">
                            <select name="matkulkurikulum" disabled>
                                <option value="none" selected disabled>Pilih Matkul Kurikulum</option>
                            </select>
                        </div>
                        <div id="mkl-container2">

                        </div>
                    </div>
                    <p>Dosen : </p>
                    <div class="input-field col s12">
                        <select name="dosen" id="dosen">
                            <option value="none" disabled selected>Pilih Dosen</option>
                            <?php
                                $query = "SELECT * FROM Dosen";
                                $listDosen = $conn->query($query);
                                foreach ($listDosen as $key => $value) {
                                    echo "<option value='$value[Dosen_ID]'>".$value['Dosen_Nama']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <p>Nama : </p>
                    <input type="text" name="nama">
                    <p>Ruangan : </p>
                    <input type="text" name="ruangan">
                    <p>Kapasitas : </p>
                    <input type="number" name="kapasitas" min="0">
                    <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" name = "btnInsert">Insert</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>