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
    <title>Update Mahasiswa</title>
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
            background-image: none;
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
            $('select').material_select();

            $("#btnUpdate").click(function () {
                if($("#nama").val() != "" && $("#wali").val() != "" && $("#tgl").val() != "" && $("#alamat").val() != "" && $("#agama").val() != "" && $("#email").val() != "" && $("#nohp").val() != ""){

                    $gender = "F";
                    if(document.getElementById('male').checked) {
                        $gender = "M";
                    }

                    $.ajax({
                        method : "post",
                        url : "updateMahasiswa.php",
                        data : {
                            nrp : $("#nrp").val(),
                            nama : $("#nama").val(),
                            wali : $("#wali").val(),
                            pembimbing : $("#pembimbing").val(),
                            tgl : $("#tgl").val(),
                            gender : $gender,
                            password : $("#password").val(),
                            alamat : $("#alamat").val(),
                            agama : $("#agama").val(),
                            email : $("#email").val(),
                            noHp : $("#nohp").val(),
                            photo : $("#hidFile").val()
                        },
                        success : function (hasil) {
                            var nama = $("#nama").val();
                            if(hasil == 1){
                                alert("Update Mahasiswa " + nama + " Berhasil");

                                //href = click link, replace = redirect
                                //window.location.href = '/halamanDataMahasiswa.php';
                                window.location.replace("/projectsdp/Admin/halamanDataMahasiswa.php");
                            }else{
                                alert("Update Mahasiswa " + nama + " Gagal");
                            }
                        }
                    });
                }else{
                    alert("Data tidak boleh kosong!");
                }
            });

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

            $("#btnRemove").click(function () {
                $("#hidFile").val("");
                $("#photo").css("background-image","none");
            });
        });

        function TogglePassword() { 
            var input_password = document.getElementById("password"); 
            if (input_password.type === "password") { 
                input_password.type = "text";
                document.getElementById("text_showHide").innerHTML = "Hide Password";
            } 
            else { 
                input_password.type = "password";
                document.getElementById("text_showHide").innerHTML = "Show Password";
            } 
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
        
            <ul id = "dropdown12" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "halamanDataJadwalPenting.php">Data Jadwal Ujian & Quiz</a></li>
                <li><a href = "insertDataJadwalPenting.php">Insert Data Jadwal Ujian & Quiz</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown12" style="width: 100%; color: black;">Jadwal Ujian & Quiz<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        </div> 
        <div id="col-kanan">
            <div style="width: 50%;">
                <h3>Update Data Mahasiswa</h3><br>
                <div id="photo" style="background-image: url('../Photo/<?=$_SESSION['mahasiswa']['photo']?>');">
                    
                </div><br>
                <input type="file" name="file" id="file">
                <input type="hidden" id="hidFile"><br><br>
                <button class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpload">Upload<i class="material-icons right">file_upload</i></button>
                <button class="btn waves-effect red darken-3" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnRemove">Remove<i class="material-icons right">delete</i></button><br><br><br><br>
                NRP: <input type="text" id="nrp" value="<?=$_SESSION['mahasiswa']['id']?>" disabled><br>
                Jurusan: <input type="text" id="jurusan" value="<?=$_SESSION['mahasiswa']['jurusan']?>" disabled>
                Nama Lengkap: <input type="text" id="nama" value="<?=$_SESSION['mahasiswa']['nama']?>"><br>
                Dosen Wali: 
                <div class="input-field col s12">
                    <select name="wali" id="wali">
                        <?php
                            $query = "SELECT * FROM Dosen WHERE Dosen_Jabatan = 'Dosen Wali'";
                            $listDosen = $conn->query($query);
                            foreach ($listDosen as $key => $value) {
                                if($value['Dosen_ID'] == $_SESSION['mahasiswa']['wali']){
                                    echo "<option value='$value[Dosen_ID]' selected>".$value['Dosen_ID']." - ".$value['Dosen_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']." - ".$value['Dosen_Nama']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                Dosen Pembimbing:
                <div class="input-field col s12">
                    <select name="pembimbing" id="pembimbing">
                        <?php
                            if($_SESSION['mahasiswa']['pembimbing'] == ""){
                                echo "<option value='none' disabled selected>Pilih Dosen Pembimbing</option>";
                                $query = "SELECT * FROM Dosen";
                                $listDosen = $conn->query($query);
                                foreach ($listDosen as $key => $value) {
                                    echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']." - ".$value['Dosen_Nama']."</option>";
                                }
                            }else{
                                $query = "SELECT * FROM Dosen";
                                $listDosen = $conn->query($query);
                                foreach ($listDosen as $key => $value) {
                                    if($value['Dosen_ID'] == $_SESSION['mahasiswa']['pembimbing']){
                                        echo "<option value='$value[Dosen_ID]' selected>".$value['Dosen_ID']." - ".$value['Dosen_Nama']."</option>";
                                    }else{
                                        echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                Tanggal Lahir:
                <input type="date" name="tgl" id="tgl" value="<?=$_SESSION['mahasiswa']['tgl']?>">
                Jenis Kelamin: 
                <p>
                    <label>
                        <?php
                            if($_SESSION['mahasiswa']['jk'] == 'M'){ 
                                echo "<input name='group1' id='male' type='radio' value='M' checked/>";
                            }else{
                                echo "<input name='group1' id='male' type='radio' value='M'/>";
                            }
                        ?>
                        <span>Laki-laki</span>
                    </label>
                    </p>
                    <p>
                    <label>
                        <?php
                            if($_SESSION['mahasiswa']['jk'] == 'F'){ 
                                echo "<input name='group1' type='radio' value='F' checked>";
                            }else{
                                echo "<input name='group1' type='radio' value='F'/>";
                            }
                        ?>
                        <span>Perempuan</span>
                    </label>
                </p>
                Alamat: <input type="text" id="alamat" value="<?=$_SESSION['mahasiswa']['alamat']?>">
                <div class="input-field col s12">
                    <select name="agama" id="agama">
                        <?php
                            if($_SESSION['mahasiswa']['agama'] == "Katolik"){
                                echo "<option value='Katolik' selected>Katolik</option>";
                                echo "<option value='Kristen'>Kristen</option>";
                                echo "<option value='Kong Hu Cu'>Kong Hu Cu</option>";
                                echo "<option value='Buddha'>Buddha</option>";
                                echo "<option value='Hindu'>Hindu</option>";
                                echo "<option value='Islam'>Islam</option>";
                            }else if($_SESSION['mahasiswa']['agama'] == "Kristen"){
                                echo "<option value='Katolik'>Katolik</option>";
                                echo "<option value='Kristen' selected>Kristen</option>";
                                echo "<option value='Kong Hu Cu'>Kong Hu Cu</option>";
                                echo "<option value='Buddha'>Buddha</option>";
                                echo "<option value='Hindu'>Hindu</option>";
                                echo "<option value='Islam'>Islam</option>";
                            }else if($_SESSION['mahasiswa']['agama'] == "Kong Hu Cu"){
                                echo "<option value='Katolik'>Katolik</option>";
                                echo "<option value='Kristen'>Kristen</option>";
                                echo "<option value='Kong Hu Cu' selected>Kong Hu Cu</option>";
                                echo "<option value='Buddha'>Buddha</option>";
                                echo "<option value='Hindu'>Hindu</option>";
                                echo "<option value='Islam'>Islam</option>";
                            }else if($_SESSION['mahasiswa']['agama'] == "Buddha"){
                                echo "<option value='Katolik'>Katolik</option>";
                                echo "<option value='Kristen'>Kristen</option>";
                                echo "<option value='Kong Hu Cu'>Kong Hu Cu</option>";
                                echo "<option value='Buddha' selected>Buddha</option>";
                                echo "<option value='Hindu'>Hindu</option>";
                                echo "<option value='Islam'>Islam</option>";
                            }else if($_SESSION['mahasiswa']['agama'] == "Islam"){
                                echo "<option value='Katolik'>Katolik</option>";
                                echo "<option value='Kristen'>Kristen</option>";
                                echo "<option value='Kong Hu Cu'>Kong Hu Cu</option>";
                                echo "<option value='Buddha'>Buddha</option>";
                                echo "<option value='Hindu'>Hindu</option>";
                                echo "<option value='Islam' selected>Islam</option>";
                            }else if($_SESSION['mahasiswa']['agama'] == "Hindu"){
                                echo "<option value='Katolik'>Katolik</option>";
                                echo "<option value='Kristen'>Kristen</option>";
                                echo "<option value='Kong Hu Cu'>Kong Hu Cu</option>";
                                echo "<option value='Buddha'>Buddha</option>";
                                echo "<option value='Hindu' selected>Hindu</option>";
                                echo "<option value='Islam'>Islam</option>";
                            }
                        ?>
                    </select>
                </div>
                Email : <input type="text" id="email" value="<?=$_SESSION['mahasiswa']['email']?>">
                No Hp : <input type="text" id="nohp" value="<?=$_SESSION['mahasiswa']['noHp']?>">
                Password : <input type="password" id="password" value="<?=$_SESSION['mahasiswa']['password']?>">
                <div>
                    <input type="checkbox" id="hide_pass" onclick="TogglePassword()">
                    <label for="hide_pass"><b id="text_showHide">Show Password</b></label>
                </div>
                <br>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update<i class="material-icons right">edit</i></button>
            </div>
        </div>
    </div>
</body>
</html>