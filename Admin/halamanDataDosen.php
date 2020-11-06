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

    if(isset($_POST['btnUpdate'])){
        $id = $_POST['idDosen'];
        $query = "SELECT * FROM Dosen";
        $listDosen = $conn->query($query);
        foreach ($listDosen as $key => $value) {
            if($value['Dosen_ID'] == $id){
                $_SESSION['dosen']['id'] = $value['Dosen_ID'];
                $_SESSION['dosen']['nama'] = $value['Dosen_Nama'];
                $_SESSION['dosen']['username'] = $value['Dosen_User'];
                $_SESSION['dosen']['password'] = $value['Dosen_Pass'];
                $_SESSION['dosen']['jabatan'] = $value['Dosen_Jabatan'];
                $_SESSION['dosen']['photo'] = $value['Dosen_Photo'];
            }
        }
        header("location: halamanUpdateDosen.php");
    }

    $query = "SELECT * FROM Dosen WHERE Dosen_Nama LIKE '%$nama%'";
    $listDosen = $conn->query($query);
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
                    url : "daftarDosen.php",
                    data : {
                        nama : $("#nama").val()
                    },
                    success : function (hasil) {
                        $("#dataDosen").html(hasil);
                    }
                });
            });
        });

        function DeleteClick(clicked_id)
        {
            //minta result lewat confirmation alert
            var nama = $("#Nama" + clicked_id).val();
            var result = confirm("Apakah Yakin Ingin Menghapus Data?");
            //kalo result = true, atau pilih yes, hapus
            if (result) {
                var berhasil = true;
                $.ajax({
                    method : "post",
                    url : "deleteDosen.php",
                    async : false,
                    data : {
                        id : clicked_id
                    },

                }).done(function(data){
                    alert("Data Dosen " + nama + " Berhasil Dihapus");
                }).fail(function(data){
                    alert("Data Dosen " + nama + " Gagal Dihapus");
                });;
            }

            location.reload();
            return false;
        }

        function DeleteJabatan(id_dosen,id_jabatan)
        {
            var result = confirm("Apakah Yakin Ingin Menghapus Data?");
            if (result) 
            {
                var berhasil = true;
                $.ajax({
                    method : "post",
                    url : "deleteJabatanDosen.php",
                    async : false,
                    data : {
                        id_dosen : id_dosen,
                        id_jabatan : id_jabatan
                    },
                }).done(function(data){
                    alert("Data Jabatan Dosen Berhasil Dihapus");
                }).fail(function(data){
                    alert("Data Jabatan Dosen Gagal Dihapus");
                });;
            }
            location.reload();
            return false;
        }
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
        </div>    
        <div id="col-kanan">
            <h3>List Dosen</h3><br>
            <input type="text" id="nama" style="width: 30%;" placeholder="Masukkan Nama">
            <button class="btn waves-effect grey lighten-1" id="btnSearch" type="submit" name="action">Search
                <i class="material-icons right">search</i>
            </button>
            <table id = "dataDosen" border="1" style="display: hidden">
            <tr>
                <?php
                    if(mysqli_num_rows($listDosen) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>ID Dosen</th>";
                        echo "<th>Nama</th>";
                        echo "<th>Username</th>";
                        //Ganti Data Lain ato hapus
                        //echo "<th>Password</th>";
                        echo "<th>Jabatan</th>";
                        echo "<th>Update</th>";
                        echo "<th>Delete</th>";
                    }
                ?>
            </tr>

            <?php
                foreach ($listDosen as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Dosen_ID]</td>";
                    echo "<td>$value[Dosen_Nama]</td>";
                    echo "<td>$value[Dosen_User]</td>";
                    //Ganti Data Lain ato hapus
                    //echo "<td>$value[Dosen_Pass]</td>";
                    echo "<td>";
                        echo"<table>";
                            $query="SELECT * FROM Jabatan_Dosen jd,Jabatan j WHERE j.Jabatan_ID=jd.Jabatan_ID AND Dosen_ID=$value[Dosen_ID]";
                            $listJabatanDosen = $conn->query($query);
                            foreach ($listJabatanDosen as $key=>$value2)
                            {
                                echo"<tr>";
                                    echo"<td>$value2[Jabatan_Nama]</td>";
                                    echo"<td><button class='btn waves-effect red darken-3' type='submit' name='btnDeleteJabatan' id='$value[Dosen_ID]' onClick='DeleteJabatan(`$value2[Dosen_ID]`,`$value2[Jabatan_ID]`)' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button></td>";
                                echo"</tr>";
                            }
                        echo"</table>";
                    echo"</td>";
                    echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' style='width: 150px;'>Update<i class='material-icons right'>edit</i></button><input type='hidden' name='idDosen' value='$value[Dosen_ID]'></form></td>";
                    echo "<td><form action='' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' id='$value[Dosen_ID]' onClick='DeleteClick(this.id)' style='width: 150px;'>Delete<i class='material-icons right'>delete</i></button><input type='hidden' id='Nama$value[Dosen_ID]' value='$value[Dosen_Nama]'</form></td>";
                    echo "</tr>";
                }

                $conn->close();
            ?>
            </table>
        </div>
    </div>
</body>
</html>
