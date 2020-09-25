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
                            pass : $("#pass").val()
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
                <li><a href = "#">Data Dosen</a></li>
                <li><a href = "#">Insert Data Dosen</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Dosen<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown3" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Jurusan</a></li>
                <li><a href = "#">Insert Data Jurusan</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Jurusan<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown4" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Mata Kurikulum</a></li>
                <li><a href = "#">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Mata Kuliah</a></li>
                <li><a href = "#">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
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
                Provinsi: <input type="text" id="provinsi">
                Kota <input type="text" id="kota">
                Agama: <input type="text" id="agama">
                Email: <input type="text" id="email">
                No Hp: <input type="text" id="nohp"><br><br>
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnGenerate">Generate</button><br><br>
                NRP:
                <div id="content-nrp">

                </div>
                Password:
                <div id="content-pass">

                </div>
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnInsert">Insert</button>
            </div>
        </div>
    </div>
</body>
</html>