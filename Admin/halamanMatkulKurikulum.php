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

    if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
    }else{
        $nama = "";
    }

    if (isset($_POST['btnDelete'])) {
        $id = $_POST['idMatkulKurikulum'];

        $query = "SELECT * FROM Kelas WHERE Matkulkurikulum_ID = '$id'";
        $listKelas = $conn->query($query);

        foreach ($listKelas as $key => $value) {
            $query = "DELETE FROM Kelas WHERE Kelas_ID = '$value[Kelas_ID]'";
            $conn->query($query);
        }

        $query = "DELETE FROM Matkul_Kurikulum WHERE Matkul_Kurikulum_ID = '$id'";
        $conn->query($query);

        $query = "DELETE FROM Praktikum WHERE Matkulkurikulum_ID = '$id'";
        $conn->query($query);

        echo '<script language = "javascript">';
        echo "alert('Berhasil Delete Matkul Kurikulum $id')";
        echo '</script>';
    }

    if(isset($_POST['btnUpdate'])){
        $id = $_POST['idMatkulKurikulum'];
        $query = "SELECT * FROM Matkul_Kurikulum";
        $listMatkulKurikulum = $conn->query($query);
        foreach ($listMatkulKurikulum as $key => $value) {
            if($value['Matkul_Kurikulum_ID'] == $id){
                $_SESSION['matkulKurikulum']['id'] = $value['Matkul_Kurikulum_ID'];
                $_SESSION['matkulKurikulum']['matkul'] = $value['Matkul_ID'];
                $_SESSION['matkulKurikulum']['major'] = $value['Major_ID'];
                $_SESSION['matkulKurikulum']['jurusan'] = $value['Jurusan_ID'];
                $_SESSION['matkulKurikulum']['kurikulum'] = $value['Kurikulum_ID'];
                $_SESSION['matkulKurikulum']['periode'] = $value['Periode_ID'];
                $_SESSION['matkulKurikulum']['semester'] = $value['Semester'];
                $_SESSION['matkulKurikulum']['sks'] = $value['SKS'];
            }
        }
        header("location: halamanUpdateMatkulKurikulum.php");
    }

    $query = "SELECT mkl.Matkul_Kurikulum_ID, mk.Matkul_Nama, j.Jurusan_Nama, mkl.Major_ID, k.Kurikulum_Nama, p.Periode_Nama, mkl.Semester, mkl.sks FROM Matkul_Kurikulum mkl, Matkul mk, Jurusan j, Periode p, Kurikulum k 
    WHERE mkl.Matkul_ID = mk.Matkul_ID AND mkl.Jurusan_ID = j.Jurusan_ID AND mkl.Periode_ID = p.Periode_ID AND mkl.Kurikulum_ID = k.Kurikulum_ID AND mk.Matkul_Nama LIKE '%$nama%'";
    $listMatkulKurikulum = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matkul Kurikulum</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin2.css">
    <style>
        .kotak{
            width: 200px;
            height: 100px;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        #dosen{
            background-color: green;
        }
        #mahasiswa{
            background-color: plum;
        }
        #admin{
            background-color: lightblue;
        }
    </style>
    <script src="jquery.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#btnSearch").click(function () {
                $.ajax({
                    method : "post",
                    url : "daftarMatkulKurikulum.php",
                    data : {
                        nama : $("#nama").val()
                    },
                    success : function (hasil) {
                        $("#dataMatkulKurikulum").html(hasil);
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
            <h3>List Matkul Kurikulum</h3><br>
            <input type="text" id="nama" style="width: 30%;" placeholder="Masukkan Nama">
            <button class="btn waves-effect grey lighten-1" id="btnSearch" type="submit" name="action">Search
                <i class="material-icons right">search</i>
            </button>
            
            <table id = "dataMatkulKurikulum" border="1" style="display: hidden">
            <tr>
                <?php
                    if(mysqli_num_rows($listMatkulKurikulum) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>ID Matkul Kurikulum</th>";
                        echo "<th>Matkul</th>";
                        echo "<th>Jurusan</th>";
                        echo "<th>Major</th>";
                        echo "<th>Kurikulum</th>";
                        echo "<th>Periode</th>";
                        echo "<th>Semester</th>";
                        echo "<th>SKS</th>";
                        echo "<th>Update</th>";
                        echo "<th>Delete</th>";
                    }
                ?>
            </tr>

            <?php
                foreach ($listMatkulKurikulum as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Matkul_Kurikulum_ID]</td>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<td>$value[Jurusan_Nama]</td>";
                    $MatkulKurikulumID = $value['Matkul_Kurikulum_ID'];
                    $kurikulumNama = $value['Kurikulum_Nama'];
                    $periodeNama = $value['Periode_Nama'];
                    $semester = $value['Semester'];
                    $sks = $value['sks'];
                    if($value['Major_ID'] == ""){
                        echo "<td>Tidak Ada</td>";
                    }else{
                        $query = "SELECT Major_Nama FROM Major WHERE Major_ID = '$value[Major_ID]'";
                        $major = $conn->query($query);
                        foreach ($major as $key => $value) {
                            echo "<td>$value[Major_Nama]</td>";
                        }
                    }
                    echo "<td>$kurikulumNama</td>";
                    echo "<td>$periodeNama</td>";
                    echo "<td>$semester</td>";
                    echo "<td>$sks</td>";
                    echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 110px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idMatkulKurikulum' value='$MatkulKurikulumID'></form></td>";
                    echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 110px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idMatkulKurikulum' value='$MatkulKurikulumID'></form></td>";
                    echo "</tr>";
                }

                $conn->close();
            ?>
            </table>
        </div>
    </div>
</body>
</html>
