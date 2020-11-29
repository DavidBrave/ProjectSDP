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

            $("#btnUpdate").click(function () {
                $valid_input = true;
                if ($("#kelas") == "" || $("#kelas") == null) {
                    $valid_input = false;
                    alert("Kelas Belum Dipilih");
                }
                else {
                    if ($("#hari") == "" || $("#hari") == null) {
                        $valid_input = false;
                        alert("Hari Belum Dipilih");
                    }
                    else {
                        if ($("#waktu_mulai") == "" || $("#waktu_mulai") == null) {
                            $valid_input = false;
                            alert("Waktu Mulai Belum Terisi");
                        }
                        else {
                            if ($("#waktu_selesai") == "" || $("#waktu_selesai") == null) {
                                $valid_input = false;
                                alert("Waktu Selesai Belum Terisi");
                            }
                        }
                    }
                }

                if ($valid_input == true) {

                    //alert($("#jadwal_id").val());

                    $.ajax({
                        method : "post",
                        url : "updateJadwal.php",
                        async: false,
                        data : {
                            id : $("#jadwal_id").val(),
                            kelas : $("#kelas").val(),
                            hari : $("#hari").val(),
                            mulai : $("#waktu_mulai").val(),
                            selesai : $("#waktu_selesai").val()
                        },
                        
                    }).done(function(data){
                        var idJadwal = $("#jadwal_id").val();
                        alert("Jadwal Kuliah dengan ID " + idJadwal + " Berhasil Diperbaharui");
                    }).fail(function(){
                        var idJadwal = $("#jadwal_id").val();
                        alert("Jadwal Kuliah dengan ID " + idJadwal + " Gagal Diperbaharui");
                    });;

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
                <h3>Update Jadwal Kuliah</h3><br>
                ID: <input type="text" name="jadwal_id" id="jadwal_id" value="<?=$_SESSION['jadwal']['id']?>" disabled><br>
                <div class="input-field col s12">
                    <select name="kelas" id="kelas">
                        <option value="none" disabled selected>Pilih Kelas</option>
                        <?php
                            $kelas_query = "SELECT * FROM Kelas";
                            $list_kelas = $conn->query($kelas_query);

                            //Query kelas yang ada
                            while ($kelas = $list_kelas->fetch_assoc()) {

                                //ambil nama dosen sesuai id dosen
                                $dosen_query = "SELECT * FROM Dosen WHERE Dosen_ID = '$kelas[DosenPengajar_ID]'";
                                $dosen = $conn->query($dosen_query);
                                $dosen = $dosen->fetch_assoc();

                                //ambil mata kuliah yang diajar
                                $matkul_kurikulum_query = "SELECT * FROM Matkul_Kurikulum WHERE Matkul_Kurikulum_ID = '$kelas[Matkulkurikulum_ID]'";
                                $matkul_kurikulum = $conn->query($matkul_kurikulum_query);
                                $matkul_kurikulum = $matkul_kurikulum->fetch_assoc();
                                //ambil semester dan periode matkulnya
                                $semester = $matkul_kurikulum['Semester'];
                                $periode = $matkul_kurikulum['Periode_ID'];

                                $periode = substr($periode, 0, 4)." / ".substr($periode, 4, 4);


                                $matkul_query = "SELECT * FROM Matkul WHERE Matkul_ID = '$matkul_kurikulum[Matkul_ID]'";
                                $matkul = $conn->query($matkul_query);
                                $matkul = $matkul->fetch_assoc();

                                if($kelas['Kelas_ID'] == $_SESSION['jadwal']['kelas']){
                                    echo("<option value='$kelas[Kelas_ID]' selected>".
                                    $kelas['Kelas_Nama']." - ".$dosen['Dosen_Nama']." - "
                                    .$matkul['Matkul_Nama']." - Periode ".$periode." Semester ".$semester
                                
                                ."</option>");
                                }else{
                                    echo("<option value='$kelas[Kelas_ID]'>".
                                    $kelas['Kelas_Nama']." - ".$dosen['Dosen_Nama']." - "
                                    .$matkul['Matkul_Nama']." - Periode ".$periode." Semester ".$semester
                                
                                ."</option>");
                                }

                            }
                            
                            
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <select name="hari" id="hari">
                        <?php
                            //echo('<option value="none" disabled selected>Pilih Hari</option>');
                            if ($_SESSION['jadwal']['hari'] == "monday") {
                                echo('<option value="monday" selected>Senin</option>');
                            }
                            else {
                                echo('<option value="monday">Senin</option>');
                            }
                            
                            if ($_SESSION['jadwal']['hari'] == "tuesday") {
                                echo('<option value="tuesday" selected>Selasa</option>');
                            }
                            else {
                                echo('<option value="tuesday">Selasa</option>');
                            }
                            
                            if ($_SESSION['jadwal']['hari'] == "wednesday") {
                                echo('<option value="wednesday" selected>Rabu</option>');
                            }
                            else {
                                echo('<option value="wednesday">Rabu</option>');
                            }
                            
                            if ($_SESSION['jadwal']['hari'] == "thursday") {
                                echo('<option value="thursday" selected>Kamis</option>');
                            }
                            else {
                                echo('<option value="thursday">Kamis</option>');
                            }
                            
                            if ($_SESSION['jadwal']['hari'] == "friday") {
                                echo('<option value="friday" selected>Jumat</option>');
                            }
                            else {
                                echo('<option value="friday">Jumat</option>');
                            }
                            
                            if ($_SESSION['jadwal']['hari'] == "saturday") {
                                echo('<option value="saturday" selected>Sabtu</option>');
                            }
                            else {
                                echo('<option value="saturday">Sabtu</option>');
                            }
                            
                        ?>
                        
                    </select>
                </div>
                Jadwal Mulai
                <input type="time" name="waktu_mulai" id="waktu_mulai" value="<?php echo($_SESSION['jadwal']['mulai']) ?>">
                Jadwal Selesai
                <input type="time" name="waktu_selesai" id="waktu_selesai" value="<?php echo($_SESSION['jadwal']['selesai']) ?>">

                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnUpdate">Update</button>
            </div>
        </div>
    </div>
</body>
</html>