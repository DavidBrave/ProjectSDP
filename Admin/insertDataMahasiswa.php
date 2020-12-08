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
                var nama = $("#nama").val();
                var dosen = $("#dosen").val();
                var tgl = $("#tgl").val();
                var jk = $("input[name='group1']:checked").val();
                var alamat = $("#alamat").val();
                var provinsi = $("#provinsi").val();
                var kota = $("#kota").val();
                var nohp = $("#nohp").val();
                var email = $("#email").val();
                var jurusan = $("#jurusan").val();
                var agama = $("#agama").val();
                if($("#nama").val() != "" && $("#dosen").val() != "" && $("#tgl").val() != "" && $("input[name='group1']:checked").val() != "" && $("#alamat").val() != "" 
                && $("#provinsi").val() != "" && $("#kota").val() != "" && $("#nohp").val() != "" && $("#email").val() != "" && $("#jurusan").val() != "" && $("#agama").val() != ""){
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
                            photo : $("#hidFile").val(),
                            provinsi : $("#provinsi").val(),
                            kota : $("#kota").val(), 
                            jurusan : $("#jurusan").val()
                        },
                        success : function (hasil) {
                            if(hasil == 1){
                                alert("Berhasil Insert Data Mahasiswa " + nama);
                                document.getElementById('nama').value = "";
                                document.getElementById('alamat').value = "";
                                document.getElementById('email').value = "";
                                document.getElementById('nohp').value = "";
                                document.getElementById('kota').value = "";
                                document.getElementById('rbM').checked = false;
                                document.getElementById('rbF').checked = false;
                                document.getElementById('content-nrp').innerHTML = "";
                                document.getElementById('content-pass').innerHTML = "";
                                document.getElementById('msgNama').hidden = true;
                                document.getElementById('msgAlamat').hidden = true;
                                document.getElementById('msgEmail').hidden = true;
                                document.getElementById('msgNohp').hidden = true;
                                document.getElementById('msgKota').hidden = true;
                                document.getElementById('msgDosen').hidden = true;
                                document.getElementById('msgJurusan').hidden = true;
                                document.getElementById('msgAgama').hidden = true;
                                document.getElementById('msgProvinsi').hidden = true;
                                document.getElementById('msgJK').hidden = true;
                            }else{
                                alert("Gagal Insert Data Mahasiswa " + nama);
                            }
                        }
                    });
                }else if($("#nama").val() == "" || $("#dosen").val() == "" || $("#tgl").val() == "" || $("input[name='group1']:checked").val() == "" || $("#alamat").val() == "" 
                || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#nohp").val() == "" || $("#email").val() == "" || $("#jurusan").val() == "" || $("#agama").val() == ""){
                    if (nama == "" || nama == null) {
                        document.getElementById('msgNama').hidden = false;
                    }
                    else {
                        document.getElementById('msgNama').hidden = true;
                    }

                    if (tgl == "" || tgl == null) {
                        document.getElementById('msgTanggal').hidden = false;
                    }
                    else {
                        document.getElementById('msgTanggal').hidden = true;
                    }

                    if (alamat == "" || alamat == null) {
                        document.getElementById('msgAlamat').hidden = false;
                    }
                    else {
                        document.getElementById('msgAlamat').hidden = true;
                    }

                    if (email == "" || email == null) {
                        document.getElementById('msgEmail').hidden = false;
                    }
                    else {
                        document.getElementById('msgEmail').hidden = true;
                    }

                    if (nohp == "" || nohp == null) {
                        document.getElementById('msgNohp').hidden = false;
                    }
                    else {
                        document.getElementById('msgNohp').hidden = true;
                    }

                    if (kota == null || kota == "") {
                        document.getElementById('msgKota').hidden = false;
                    }
                    else {
                        document.getElementById('msgKota').hidden = true;
                    }

                    if (dosen == null || dosen == "") {
                        document.getElementById('msgDosen').hidden = false; 
                    }
                    else {
                        document.getElementById('msgDosen').hidden = true;
                    }

                    if (jurusan == null || jurusan == "") {
                        document.getElementById('msgJurusan').hidden = false;
                    }
                    else {
                        document.getElementById('msgJurusan').hidden = true;
                    }
                    
                    if (agama == null || agama == "") {
                        document.getElementById('msgAgama').hidden = false;
                    }
                    else {
                        document.getElementById('msgAgama').hidden = true;
                    }

                    if (provinsi == "" || provinsi == null) {
                        document.getElementById('msgProvinsi').hidden = false;
                    }
                    else {
                        document.getElementById('msgProvinsi').hidden = true;
                    }

                    if (jk == "" || jk == null) {
                        document.getElementById('msgJK').hidden = false;
                    }
                    else {
                        document.getElementById('msgJK').hidden = true;
                    }
                    alert("Gagal Insert Data Mahasiswa " + nama);
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
         });

        function GetEventTarget(e) {
            e = e || window.event;
            return e.target || e.srcElement; 
        }

        function UbahJurusan() {
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
                }
        }

    </script>
    <script type="text/JavaScript">  

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
                <h3>Insert Data Mahasiswa</h3><br>
                Nama Lengkap: <input type="text" id="nama">
                <label id='msgNama' style = 'color:Red' hidden>Nama Tidak Boleh Kosong</label><br><br>
                <div class="input-field col s12">
                    <select name="jurusan" id="jurusan" onchange="UbahJurusan();">
                        <option value="none" id="defaultJurusan" disabled selected>Pilih Jurusan</option>
                        <?php
                            $query = "SELECT * FROM Jurusan";
                            $listJurusan = $conn->query($query);
                            foreach ($listJurusan as $key => $value) {
                                echo "<option value='$value[Jurusan_ID]'>".$value['Jurusan_ID']."-".$value['Jurusan_Nama']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <label id='msgJurusan' style = 'color:Red' hidden>Jurusan Tidak Boleh Kosong</label><br><br>
                <div class="input-field col s12">
                    <select name="dosen" id="dosen">
                        <option value="none" id="defaultDosen" disabled selected>Pilih Dosen Wali</option>
                        <?php

                            $query = "SELECT d.Dosen_Nama,d.Dosen_ID FROM Dosen d,Jabatan_Dosen jd WHERE jd.Jabatan_ID='JBT0005' AND d.Dosen_ID=jd.Dosen_ID";

                            $listDosen = $conn->query($query);
                            foreach ($listDosen as $key => $value) {
                                echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <label id='msgDosen' style = 'color:Red' hidden>Dosen Tidak Boleh Kosong</label><br><br>
                Tanggal Lahir:
                <input type="date" name="tgl" id="tgl">
                <label id='msgTanggal' style = 'color:Red' hidden>Tanggal Tidak Boleh Kosong</label><br><br>
                Jenis Kelamin: 
                <p>
                    <label>
                        <input id="rbM" name="group1" type="radio" value="M">
                        <span>Laki-laki</span>
                    </label>
                    </p>
                    <p>
                    <label>
                        <input id="rbF" name="group1" type="radio" value="F">
                        <span>Perempuan</span>
                    </label>
                </p>
                <label id='msgJK' style = 'color:Red' hidden>Jenis Kelamin Tidak Boleh Kosong</label><br><br>
                Alamat: <input type="text" id="alamat">
                <label id='msgAlamat' style = 'color:Red' hidden>Alamat Tidak Boleh Kosong</label><br><br>
                <div class="input-field col s12">
                    <select name="provinsi" id="provinsi">
                        <option value="none" id="defaultProvinsi" disabled selected>Pilih Provinsi</option>
                        <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Riau">Riau</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Jambi">Jambi</option>
                        <option value="Bengkulu">Bengkulu</option>
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
                <label id='msgProvinsi' style = 'color:Red' hidden>Provinsi Tidak Boleh Kosong</label><br><br>
                Kota <input type="text" id="kota">
                <label id='msgKota' style = 'color:Red' hidden>Kota Tidak Boleh Kosong</label><br><br>
                <div class="input-field col s12">
                    <select name="agama" id="agama">
                        <option value="none" id="defaultAgama" disabled selected>Pilih Agama</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                        <option value="Islam">Islam</option>
                    </select>
                </div>
                <label id='msgAgama' style = 'color:Red' hidden>Agama Tidak Boleh Kosong</label><br><br>
                Email: <input type="text" id="email">
                <label id='msgEmail' style = 'color:Red' hidden>Email Tidak Boleh Kosong</label><br><br>

                No Hp: <input type="text" id="nohp">
                <label id='msgNohp' style = 'color:Red' hidden>Nomor HP Tidak Boleh Kosong</label><br><br>
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