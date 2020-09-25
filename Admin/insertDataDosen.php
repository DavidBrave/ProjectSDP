<?php
    session_start();
    require_once('../Required/Connection.php');
    $tanggal = "";
    $nama = "";
    $jabatan = "";
    $nip = "";
    $username = "";
    $password = "";
    $jk = "";
    $tgl = "";


    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    if (isset($_POST['btnInsert'])) {
        if (isset(($_POST['jabatan']))) {
            $jabatan = $_POST['jabatan'];
        }
        if (isset(($_POST['gender']))) {
            $jk = $_POST['gender'];
        }

        $tanggal = $_POST['tgl'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Generate NIP Dosen
        if ($tanggal != "" && $nama != "" && $jabatan != "" && $username != "" && $password != "" && $jk != "") {
            $tahun = substr($tanggal, 0, 4);
            $bulan = substr($tanggal, 5, 2);
            $tgl = substr($tanggal, 8, 2);
            $nip = $tahun . $bulan . $tgl;
        }
        
        if ($jk == "F") {
            $nip .= "2";
        }
        if ($jk == "M") {
            $nip .= "1";
        }

        $query = "SELECT Count(Dosen_ID) as jumlah FROM Dosen";
        $result = $conn->query($query);
        $ctr = 0;
        foreach($result as $key => $value) {
            $ctr = $value['jumlah'];
        }

        if ($ctr < 10) {
            $nip .= "00" . $ctr;
        }
        else if ($ctr < 100) {
            $nip .= "0" . $ctr;
        }
        else {
            $nip .= $ctr;
        }
        
        //Proses Insert
        $query = "INSERT INTO Dosen VALUES('$nip', '$nama', '$username', '$password', '$jabatan')";
        $conn->query($query);
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
    <link rel="stylesheet" href="admin.css">
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
                <li><a href = "">Data Jurusan</a></li>
                <li><a href = "">Insert Data Jurusan</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown3" style="width: 100%; color: black;">Jurusan<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown4" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "">Data Mata Kurikulum</a></li>
                <li><a href = "">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown4" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "">Data Mata Kuliah</a></li>
                <li><a href = "">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown5" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        </div> 
        <div id="col-kanan">
            <div style="width: 50%;">
                <form action = "" method = "post">
                    <h3>Insert Data Dosen</h3><br>
                    Nama Lengkap: <input type="text" name="nama">
                    Tanggal Lahir: <input type="date" name="tgl">
                    Jenis Kelamin: 
                    <p>
                        <label>
                            <input name="gender" type="radio" value="M"/>
                            <span>Laki-laki</span>
                        </label>
                        </p>
                        <p>
                        <label>
                            <input name="gender" type="radio" value="F"/>
                            <span>Perempuan</span>
                        </label>
                    </p>

                    <div class="input-field col s12">
                        <select name="jabatan">
                            <option value="none" disabled selected>Pilih Jabatan</option>
                            <option value='Dosen'>Dosen</option>
                            <option value='Dosen Wali'>Dosen Wali</option>
                            <option value='Rektor'>Rektor</option>
                            <option value='Wakil Rektor'>Wakil Rektor</option>
                        </select>
                    </div>

                    Username: <input type="text" name="username"><br>
                    Password: <input type="text" name="password">
                    <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" name = "btnInsert">Insert</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>