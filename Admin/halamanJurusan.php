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
        $id = $_POST['idJurusan'];

        $query = "SELECT * FROM Matkul_Kurikulum";
        $listMk = $conn->query($query);
        $adaJurusan = false;
        foreach ($listMk as $key => $value) {
            if($value['Jurusan_ID'] == $id){
                $mkId = $value['Matkul_Kurikulum_ID'];
                $query = "SELECT * FROM Kelas";
                $listKelas = $conn->query($query);
                foreach ($listKelas as $key => $value) {
                    if($value['Matkulkurikulum_ID'] == $mkId){
                        $adaJurusan = true;
                    }
                }
            }
        }

        if(!$adaJurusan){
            $name = "";
            $query = "SELECT * FROM Jurusan WHERE Jurusan_ID = '$id'";
            $temp = $conn->query($query);
            foreach($temp as $key => $value) {
                $name = $value['Jurusan_Nama'];
            }

            $query = "DELETE FROM Major WHERE Jurusan_ID = '$id'";
            $conn->query($query);
            $query = "DELETE FROM Matkul_Kurikulum WHERE Jurusan_ID = '$id'";
            $conn->query($query);
            $query = "DELETE FROM Jurusan WHERE Jurusan_ID = '$id'";
            $conn->query($query);

            echo '<script language = "javascript">';
            echo "alert('Berhasil Delete Jurusan $name')";
            echo '</script>';
        }else{
            echo "<script>alert('Tidak bisa hapus jurusan')</script>";
        }

    }

    if(isset($_POST['btnUpdate'])){
        $id = $_POST['idJurusan'];
        $query = "SELECT * FROM Jurusan";
        $listJurusan = $conn->query($query);
        foreach ($listJurusan as $key => $value) {
            if($value['Jurusan_ID'] == $id){
                $_SESSION['jurusan']['id'] = $value['Jurusan_ID'];
                $_SESSION['jurusan']['nama'] = $value['Jurusan_Nama'];
            }
        }
        header("location: halamanUpdateJurusan.php");
    }

    $query = "SELECT * FROM Jurusan WHERE Jurusan_Nama LIKE '%$nama%'";
    $listJurusan = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
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
                    url : "daftarJurusan.php",
                    data : {
                        nama : $("#nama").val()
                    },
                    success : function (hasil) {
                        $("#dataJurusan").html(hasil);
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


        </div>   
        <div id="col-kanan">
            <h3>List Jurusan</h3><br>
            <input type="text" id="nama" style="width: 30%;" placeholder="Masukkan Nama">
            <button class="btn waves-effect grey lighten-1" id="btnSearch" type="submit" name="action">Search
                <i class="material-icons right">search</i>
            </button>
            <table id = "dataJurusan" border="1" style="display: hidden">
            <tr>
                <?php
                    if(mysqli_num_rows($listJurusan) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>ID Jurusan</th>";
                        echo "<th>Nama Jurusan</th>";
                        echo "<th>Update</th>";
                        echo "<th>Delete</th>";
                    }
                ?>
            </tr>

            <?php
                foreach ($listJurusan as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Jurusan_ID]</td>";
                    echo "<td>$value[Jurusan_Nama]</td>";
                    echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idJurusan' value='$value[Jurusan_ID]'></form></td>";
                    echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' name='idJurusan' value='$value[Jurusan_ID]'></form></td>";
                    echo "</tr>";
                }

                $conn->close();
            ?>
            </table>
        </div>
    </div>
</body>
</html>