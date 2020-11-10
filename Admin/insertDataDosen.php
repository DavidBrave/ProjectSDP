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
            $photo = $_POST['hidFile'];
            $tahun = substr($tanggal, 0, 4);
            $bulan = substr($tanggal, 5, 2);
            $tgl = substr($tanggal, 8, 2);
            $nip = $tahun . $bulan . $tgl;

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
            $query = "INSERT INTO Dosen VALUES('$nip', '$nama', '$username', '$password', '$jabatan', '$photo')";
            $conn->query($query);
            echo '<script language = "javascript">';
            echo "alert('Berhasil Insert Dosen $nama')";
            echo '</script>';

            $query="SELECT * FROM Jabatan WHERE Jabatan_Nama='$jabatan'";
            $result = $conn->query($query);
            foreach($result as $key => $value) {
                $jabatan = $value['Jabatan_ID'];
            }
            $query = "INSERT INTO Jabatan_Dosen VALUES('$nip', '$jabatan')";
            $conn->query($query);

            

            $conn->close();
        }
        
        //Validate
        $validate = false;
        if ($tanggal == "") {
            $_SESSION['validate']['dosen']['tanggal'] = "Tanggal harus diisi";
            $validate = true;
        }
        if ($nama == "") {
            $_SESSION['validate']['dosen']['nama'] = "Nama harus diisi";
            $validate = true;
        }
        if ($username == "") {
            $_SESSION['validate']['dosen']['username'] = "Username harus diisi";
            $validate = true;
        }
        if ($password == "") {
            $_SESSION['validate']['dosen']['password'] = "Password harus diisi";
            $validate = true;
        }
        if ($jk == "") {
            $_SESSION['validate']['dosen']['jk'] = "Jenis Kelamin harus diisi";
            $validate = true;
        }
        if ($jabatan == "") {
            $_SESSION['validate']['dosen']['jabatan'] = "Jabatan harus diisi";
            $validate = true;
        }

        if ($validate) {
            $_SESSION['temp']['dosen']['tanggal'] = $tanggal;
            $_SESSION['temp']['dosen']['nama'] = $nama;
            $_SESSION['temp']['dosen']['username'] = $username;
            $_SESSION['temp']['dosen']['password'] = $password;
            $_SESSION['temp']['dosen']['jk'] = $jk;
            $_SESSION['temp']['dosen']['jabatan'] = $jabatan;
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
        #photo{
            width: 200px;
            height: 200px;
            border-radius: 10px;
            background-color: lightgray;
            text-align: center;
            padding-top: 40px;
            background-position: center;
            background-size: cover;
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

            $("#btnUpload").click(function () {
                var fd = new FormData();
                var files = $('#file')[0].files[0];
                fd.append('file',files);

                $.ajax({
                    url: 'upload.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                            $("#photo").css("background-image","url(../Photo/" + response + ")"); 
                            $("#hidFile").val(response);
                        }else{
                            alert('file not uploaded');
                        }
                    },
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
                <h3>Insert Data Dosen</h3><br>
                <div id="photo">
                    
                </div><br>
                <input type="file" name="file" id="file">
                <button class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpload">Upload<i class="material-icons right">file_upload</i></button><br><br>
                <form action = "#" method = "post">
                    Nama Lengkap: <input type="text" name="nama"
                    value = "<?php if (isset($_SESSION['temp']['dosen']['nama'])) {echo $_SESSION['temp']['dosen']['nama'];}?>">
                    <?php
                        if (isset($_SESSION['validate']['dosen']['nama'])) {
                            $message = $_SESSION['validate']['dosen']['nama'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>
                    Tanggal Lahir: <input type="date" name="tgl">
                    <?php
                        if (isset($_SESSION['validate']['dosen']['tanggal'])) {
                            $message = $_SESSION['validate']['dosen']['tanggal'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>
                    Jenis Kelamin: 
                    <p>
                        <label>
                            <input name="gender" type="radio" value="M"
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jk'])) {
                                        if ($_SESSION['temp']['dosen']['jk'] == "M") {
                                            echo "checked";
                                        }
                                    }
                                ?>
                            >
                            <span>Laki-laki</span>
                        </label>
                        </p>
                        <p>
                        <label>
                            <input name="gender" type="radio" value="F"
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jk'])) {
                                        if ($_SESSION['temp']['dosen']['jk'] == "F") {
                                            echo "checked";
                                        }
                                    }
                                ?>
                            >
                            <span>Perempuan</span>
                        </label>
                    </p>

                    <?php
                        if (isset($_SESSION['validate']['dosen']['jk'])) {
                            $message = $_SESSION['validate']['dosen']['jk'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>

                    <div class="input-field col s12">
                        <select name="jabatan">
                            <option value="none" disabled 
                                <?php
                                    if (!isset($_SESSION['temp']['dosen'])) {
                                        echo "selected";
                                    }
                                ?>
                            >Pilih Jabatan</option>
                            <option value='Dosen'
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jabatan'])) {
                                        if ($_SESSION['temp']['dosen']['jabatan'] == "Dosen") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Dosen</option>
                            <option value='Dosen Wali'
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jabatan'])) {
                                        if ($_SESSION['temp']['dosen']['jabatan'] == "Dosen Wali") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Dosen Wali</option>
                            <option value='Rektor'
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jabatan'])) {
                                        if ($_SESSION['temp']['dosen']['jabatan'] == "Rektor") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Rektor</option>
                            <option value='Wakil Rektor'
                                <?php
                                    if (isset($_SESSION['temp']['dosen']['jabatan'])) {
                                        if ($_SESSION['temp']['dosen']['jabatan'] == "Wakil Rektor") {
                                            echo "selected";
                                        }
                                    }
                                ?>
                            >Wakil Rektor</option>
                        </select>
                    </div>

                    <?php
                        if (isset($_SESSION['validate']['dosen']['jabatan'])) {
                            $message = $_SESSION['validate']['dosen']['jabatan'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>

                    Username: <input type="text" name="username"
                    value = "<?php if (isset($_SESSION['temp']['dosen']['username'])) {echo $_SESSION['temp']['dosen']['username'];}?>">

                    <?php
                        if (isset($_SESSION['validate']['dosen']['username'])) {
                            $message = $_SESSION['validate']['dosen']['username'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>

                    Password: <input type="text" name="password"
                    value = "<?php if (isset($_SESSION['temp']['dosen']['password'])) { echo $_SESSION['temp']['dosen']['password']; } ?>">

                    <?php
                        if (isset($_SESSION['validate']['dosen']['password'])) {
                            $message = $_SESSION['validate']['dosen']['password'];
                            echo "<label style = 'color:Red'>$message</label><br>";
                        }
                    ?>
                    <input type="hidden" id="hidFile" name="hidFile">
                    <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" name = "btnInsert">Insert</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    unset($_SESSION['validate']['dosen']);
    unset($_SESSION['temp']['dosen']);
?>