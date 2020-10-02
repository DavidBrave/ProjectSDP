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
    <link rel="stylesheet" href="admin.css">
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
                    $.ajax({
                        method : "post",
                        url : "updateMahasiswa.php",
                        data : {
                            nrp : $("#nrp").val(),
                            nama : $("#nama").val(),
                            wali : $("#wali").val(),
                            pembimbing : $("#pembimbing").val(),
                            tgl : $("#tgl").val(),
                            alamat : $("#alamat").val(),
                            agama : $("#agama").val(),
                            email : $("#email").val(),
                            noHp : $("#nohp").val()
                        },
                        success : function (hasil) {
                            if(hasil == 1){
                                alert("sukses");
                            }else{
                                alert("gagal");
                            }
                        }
                    });
                }else{
                    alert("Data tidak boleh kosong!");
                }
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
        </div> 
        <div id="col-kanan">
            <div style="width: 50%;">
                <h3>Update Data Mahasiswa</h3><br>
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
                                    echo "<option value='$value[Dosen_ID]' selected>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
                                }else{
                                    echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
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
                                    echo "<option value='$value[Dosen_ID]'>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
                                }
                            }else{
                                $query = "SELECT * FROM Dosen";
                                $listDosen = $conn->query($query);
                                foreach ($listDosen as $key => $value) {
                                    if($value['Dosen_ID'] == $_SESSION['mahasiswa']['pembimbing']){
                                        echo "<option value='$value[Dosen_ID]' selected>".$value['Dosen_ID']."-".$value['Dosen_Nama']."</option>";
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
                                echo "<input name='group1' type='radio' value='M' checked disabled/>";
                            }else{
                                echo "<input name='group1' type='radio' value='M' disabled/>";
                            }
                        ?>
                        <span>Laki-laki</span>
                    </label>
                    </p>
                    <p>
                    <label>
                        <?php
                            if($_SESSION['mahasiswa']['jk'] == 'F'){ 
                                echo "<input name='group1' type='radio' value='F' checked disabled/>";
                            }else{
                                echo "<input name='group1' type='radio' value='F' disabled/>";
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
                Email: <input type="text" id="email" value="<?=$_SESSION['mahasiswa']['email']?>">
                No Hp: <input type="text" id="nohp" value="<?=$_SESSION['mahasiswa']['noHp']?>">
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update</button>
            </div>
        </div>
    </div>
</body>
</html>