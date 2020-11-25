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
    <title>Update Dosen</title>
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
                if($("#nama").val() != "" && $("#username").val() != "" && $("#password").val() != ""){
                    $.ajax({
                        method : "post",
                        url : "updateDosen.php",
                        data : {
                            id : $("#id").val(),
                            nama : $("#nama").val(),
                            username : $("#username").val(),
                            password : $("#password").val(),
                            jabatan : $("#jabatan").val(),
                            photo : $("#hidFile").val()
                        },
                        success : function (hasil) {
                            var nama = $("#nama").val();
                            if(hasil == 1){
                                alert("Update Data Dosen " + nama + " Berhasil");
                                window.location.replace("/projectsdp/Admin/halamanDataDosen.php");
                            }else{
                                alert("Update Data Dosen " + nama + " Gagal");
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
                <h3>Update Data Dosen</h3><br>
                <div id="photo" style="background-image: url('../Photo/<?=$_SESSION['dosen']['photo']?>');"></div><br>
                <input type="file" name="file" id="file">
                <input type="hidden" id="hidFile"><br><br>
                <button class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpload">Upload<i class="material-icons right">file_upload</i></button>
                <button class="btn waves-effect red darken-3" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnRemove">Remove<i class="material-icons right">delete</i></button><br><br><br><br>
                <b>ID:</b> <input type="text" id="id" value="<?=$_SESSION['dosen']['id']?>" disabled><br>
                <b>Nama Lengkap:</b> <input type="text" id="nama" value="<?=$_SESSION['dosen']['nama']?>"><br>
                <b>Username:</b> <input type="text" id="username" value="<?=$_SESSION['dosen']['username']?>">
                <div class="input-field col s12">
                    <?php
                        $id = $_SESSION['dosen']['id'];
                        $query = "SELECT d.Dosen_ID, j.Jabatan_Nama FROM Dosen d, Jabatan_Dosen jd, Jabatan j 
                        WHERE jd.Jabatan_ID = j.Jabatan_ID AND jd.Dosen_ID = d.Dosen_ID AND d.Dosen_ID = '$id'";
                        $jabatan = $conn->query($query);
                        $count = 1;
                        foreach ($jabatan as $key => $value) {
                            echo "<b>Jabatan $count:</b>";
                            if($value['Jabatan_Nama'] == "Dosen"){
                                echo "<input type='text' value='Dosen' disabled>";
                            }else if($value['Jabatan_Nama'] == "Dosen Wali"){
                                echo "<input type='text' value='Dosen Wali' disabled>";
                            }else if($value['Jabatan_Nama'] == "Wakil Rektor"){
                                echo "<input type='text' value='Wakil Rektor' disabled>";
                            }else if($value['Jabatan_Nama'] == "Rektor"){
                                echo "<input type='text' value='Rektor' disabled>";
                            }
                            $count++;
                        }
                    ?>
                </div>

                <b>Password:</b> <input type="password" id="password" value="<?=$_SESSION['dosen']['password']?>">
                <div>
                    <input type="checkbox" id="hide_pass" onclick="TogglePassword()">
                    <label for="hide_pass"><b id="text_showHide">Show Password</b></label>
                </div>
                <br>

                <b>Tambah Jabatan</b> : <br>
                <div class="input-field col s12">
                    <select name="jabatan" id="jabatan">
                        <option value="none" disabled selected>Pilih Jabatan</option>
                        <?php
                            $query = "SELECT * FROM Jabatan";
                            $jabatan = $conn->query($query);
                            foreach ($jabatan as $key => $value) {
                                echo "<option value='$value[Jabatan_ID]'>$value[Jabatan_Nama]</option>";
                            }
                        ?>
                    </select>
                </div>

                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update<i class="material-icons right">edit</i></button>
            </div>
        </div>
    </div>
</body>
</html>