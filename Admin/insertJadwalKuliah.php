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

            $("#btnInsert").click(function () {
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

                    $.ajax({
                        method : "post",
                        url : "insertJadwal.php",
                        async : false,
                        data : {
                            id : $("#jadwal_id").val(),
                            kelas : $("#kelas").val(),
                            hari : $("#hari").val(),
                            mulai : $("#waktu_mulai").val(),
                            selesai : $("#waktu_selesai").val()
                        },
                        
                    }).done(function(data){
                        var idJadwal = $("#jadwal_id").val();
                        alert("Input Jadwal Kuliah dengan ID " + idJadwal + " Berhasil");
                    }).fail(function(){
                        var idJadwal = $("#jadwal_id").val();
                        alert("Input Jadwal Kuliah dengan ID " + idJadwal + " Gagal");
                    });;


                }
                
                location.reload();
                return false;
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
                <h3>Insert Jadwal Kuliah</h3><br>

                <?php
                    $id_count = 0;
                    $jadwal_query = "SELECT * FROM Jadwal_Kuliah";
                    $list_jadwal = $conn->query($jadwal_query);

                    while ($jadwal = $list_jadwal->fetch_assoc()) {

                        $ctr = null;
                        $ctr = substr($jadwal['Jadwal_ID'], 3, 4);

                        if ($id_count < (int) $ctr ) {
                            $id_count = (int) $ctr;
                        }
                    }
                    $id_count += 1;
                    $id_count = "JDL".str_pad($id_count, 4, "0", STR_PAD_LEFT);

                    echo("<input style='display: none;' type='hidden' name='jadwal_id' id='jadwal_id' value='".$id_count."'>");

                ?>

                

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

                                echo("<option value='$kelas[Kelas_ID]'>".
                                    $kelas['Kelas_Nama']." - ".$dosen['Dosen_Nama']." - "
                                    .$matkul['Matkul_Nama']." - Periode ".$periode." Semester ".$semester
                                
                                ."</option>");

                            }
                            
                            
                        ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <select name="hari" id="hari">
                        <option value="none" disabled selected>Pilih Hari</option>
                        <option value='monday'>Senin</option>
                        <option value='tuesday'>Selasa</option>
                        <option value='wednesday'>Rabu</option>
                        <option value='thursday'>Kamis</option>
                        <option value='friday'>Jumat</option>
                        <option value='saturday'>Sabtu</option>
                    </select>
                </div>
                Jadwal Mulai
                <input type="time" name="waktu_mulai" id="waktu_mulai">
                Jadwal Selesai
                <input type="time" name="waktu_selesai" id="waktu_selesai">

                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" id="btnInsert">Insert</button>
            </div>
        </div>
    </div>
</body>
</html>