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
    <title>Admin</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
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
         $(document).ready(function() {
            $('select').material_select();

            $("#btnGenerate").click(function () {
                if($("#nama").val() != "" && $("#jurusan").val() != "" && $("#dosen").val() != "" && $("#tgl").val() != "" && $("input[name='group1']:checked").val() != "" && $("#alamat").val() != "" && $("#provinsi").val() != "" && $("#kota").val() != "" && $("#agama").val() != "" && $("#email").val() != "" && $("#nohp").val() != "") {
                    var d = new Date();
                    var year = d.getFullYear() + "";
                    var year1 = year.substr(0,1);
                    var year2 = year.substr(2,2);
                    $.ajax({
                        method : "post",
                        url : "generateNrp.php",
                        data : {
                            
                            jurusan : $("#jurusan").val().substr(1,3),
                            nohp : $("#nohp").val(),
                            tahun : year1 + year2
                        },
                        success : function (hasil) {
                            $("#content-nrp").html(hasil);
                        }
                    });
                    $.ajax({
                        method : "post",
                        url : "generatePassword.php",
                        data : {
                            jurusan : $("#jurusan").val().substr(1,3),
                            nohp : $("#nohp").val(),
                            tahun : year1 + year2
                        },
                        success : function (hasil) {
                            $("#content-pass").html(hasil);
                        }
                    });
                }else{
                    alert("Data tidak boleh kosong!");
                }
            });
            $("#btnInsert").click(function () {
                if($("#nrp").val() != "" && $("#pass").val() != ""){
                    $.ajax({
                        method : "post",
                        url : "insertMahasiswa.php",
                        data : {
                            nrp : $("#nrp").val(),
                            nama : $("#nama").val(),
                            dosen : $("#dosen").val(),
                            tgl : $("#tgl").val(),
                            jk : $("input[name='group1']:checked").val(),
                            alamat : $("#alamat").val() + ", " + $("#kota").val() + ", " + $("#provinsi").val(),
                            agama : $("#agama").val(),
                            email : $("#email").val(),
                            nohp : $("#nohp").val(),
                            pass : $("#pass").val(),
                            photo : $("#hidFile").val()
                        },
                        success : function (hasil) {
                            if(hasil == 1){
                                alert("sukses");
                            }else{
                                alert("gagal");
                            }
                        }
                    });
                }
                $("#nrp").val("");
                $("#nama").val("");
                $("#tgl").val("");
                $("#alamat").val("");
                $("#kota").val("");
                $("#provinsi").val("");
                $("#agama").val("");
                $("#email").val("");
                $("#nohp").val("");
                $("#pass").val("");
                $("input[name='group1'][value='M'").prop("checked",false);
                $("input[name='group1'][value='F'").prop("checked",false);
                $("#photo").css("background-image","none");
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
            <div style="width: 50%;">
                <h3>Insert Data Mahasiswa</h3><br>
                Nama Lengkap: <input type="text" id="nama">
                <div class="input-field col s12">
                    <select name="jurusan" id="jurusan">
                        <option value="none" disabled selected>Pilih Jurusan</option>
                        <?php
                            $query = "SELECT * FROM Jurusan";
                            $listJurusan = $conn->query($query);
                            foreach ($listJurusan as $key => $value) {
                                echo "<option value='$value[Jurusan_ID]'>".$value['Jurusan_ID']."-".$value['Jurusan_Nama']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <select name="dosen" id="dosen">
                        <option value="none" disabled selected>Pilih Dosen Wali</option>
                        <?php
                            $query = "SELECT * FROM Dosen WHERE Dosen_Jabatan = 'Dosen Wali'";
                            $listDosen = $conn->query($query);
                            foreach ($listDosen as $key => $value) {
                                echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
                            }
                        ?>
                    </select>
                </div>
                Tanggal Lahir:
                <input type="date" name="tgl" id="tgl">
                Jenis Kelamin: 
                <p>
                    <label>
                        <input name="group1" type="radio" value="M"/>
                        <span>Laki-laki</span>
                    </label>
                    </p>
                    <p>
                    <label>
                        <input name="group1" type="radio" value="F"/>
                        <span>Perempuan</span>
                    </label>
                </p>
                Alamat: <input type="text" id="alamat">
                <div class="input-field col s12">
                    <select name="provinsi" id="provinsi">
                        <option value="none" disabled selected>Pilih Provinsi</option>
                        <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Riau">Riau</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Jambi">Jambi</option>
                        <option value="Bengkulu">Bengkulu</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                        <option value="Lampung">Lampung</option>
                        <option value="Banten">Banten</option>
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                        <option value="Bali">Bali</option>
                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                        <option value="Gorontalo">Gorontalo</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                        <option value="Maluku">Maluku</option>
                        <option value="Maluku Utara">Maluku Utara</option>
                        <option value="Papua">Papua</option>
                        <option value="Papua Barat">Papua Barat</option>
                    </select>
                </div>
                Kota <input type="text" id="kota">
                <div class="input-field col s12">
                    <select name="agama" id="agama">
                        <option value="none" disabled selected>Pilih Agama</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                        <option value="Islam">Islam</option>
                    </select>
                </div>
                Email: <input type="text" id="email">
                No Hp: <input type="text" id="nohp"><br><br>
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnGenerate">Generate</button><br><br>
                NRP:
                <div id="content-nrp">

                </div>
                Password:
                <div id="content-pass">

                </div>
                <div id="photo">
                    
                </div><br>
                <input type="file" name="file" id="file">
                <input type="hidden" id="hidFile">
                <button class="btn waves-effect waves-light" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpload">Upload<i class="material-icons right">file_upload</i></button><br><br>
                <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnInsert">Insert</button>
            </div>
        </div>
    </div>
</body>
</html>