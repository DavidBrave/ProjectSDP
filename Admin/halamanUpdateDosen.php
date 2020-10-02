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
                if($("#nama").val() != "" && $("#username").val() != "" && $("#password").val() != "" && $("#jabatan").val() != ""){
                    $.ajax({
                        method : "post",
                        url : "updateDosen.php",
                        data : {
                            id : $("#id").val(),
                            nama : $("#nama").val(),
                            username : $("#username").val(),
                            password : $("#password").val(),
                            jabatan : $("#jabatan").val()
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
                <h3>Update Data Dosen</h3><br>
                ID: <input type="text" id="id" value="<?=$_SESSION['dosen']['id']?>" disabled><br>
                Nama Lengkap: <input type="text" id="nama" value="<?=$_SESSION['dosen']['nama']?>"><br>
                Username: <input type="text" id="username" value="<?=$_SESSION['dosen']['username']?>">
                Password: <input type="text" id="password" value="<?=$_SESSION['dosen']['password']?>">
                <div class="input-field col s12">
                    <select name="jabatan" id="jabatan">
                        <?php
                            $query = "SELECT * FROM Dosen";
                            $listDosen = $conn->query($query);
                            foreach ($listDosen as $key => $value) {
                                if($value['Dosen_ID'] == $_SESSION['dosen']['id']){
                                    if($value['Dosen_Jabatan'] == "Dosen"){
                                        echo "<option value='Dosen' selected>Dosen</option>";
                                        echo "<option value='Dosen Wali'>Dosen Wali</option>";
                                        echo "<option value='Wakil Rektor'>Wakil Rektor</option>";
                                        echo "<option value='Rektor'>Rektor</option>";
                                    }else if($value['Dosen_Jabatan'] == "Dosen Wali"){
                                        echo "<option value='Dosen'>Dosen</option>";
                                        echo "<option value='Dosen Wali' selected>Dosen Wali</option>";
                                        echo "<option value='Wakil Rektor'>Wakil Rektor</option>";
                                        echo "<option value='Rektor'>Rektor</option>";
                                    }else if($value['Dosen_Jabatan'] == "Wakil Rektor"){
                                        echo "<option value='Dosen'>Dosen</option>";
                                        echo "<option value='Dosen Wali'>Dosen Wali</option>";
                                        echo "<option value='Wakil Rektor' selected>Wakil Rektor</option>";
                                        echo "<option value='Rektor'>Rektor</option>";
                                    }else if($value['Dosen_Jabatan'] == "Rektor"){
                                        echo "<option value='Dosen'>Dosen</option>";
                                        echo "<option value='Dosen Wali'>Dosen Wali</option>";
                                        echo "<option value='Wakil Rektor'>Wakil Rektor</option>";
                                        echo "<option value='Rektor' selected>Rektor</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update</button>
            </div>
        </div>
    </div>
</body>
</html>