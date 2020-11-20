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

    if(isset($_POST['btnDetail'])){
        $_SESSION['detailFRS'] = $_POST['idMahasiswa'];
        header("location: halamanDetailFRS.php");
    }

    $dosenID = $_SESSION['user']['user'];
    $query = "SELECT DISTINCT k.Kelas_Nama, k.Kelas_Ruangan, m.Matkul_Nama, k.Kelas_ID
    FROM Matkul_Kurikulum mk, Matkul m, Kelas k, Dosen d
    WHERE d.Dosen_ID = '$dosenID' 
    AND k.DosenPengajar_ID = d.Dosen_ID
    AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID
    AND mk.Matkul_ID = m.Matkul_ID";
    $listKelas = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Nilai</title>
    <link rel="stylesheet" href="Dosen.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
    <script src="jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();

            $("#menu_jadwal").click(function () {
               $("#menu_item1").toggle();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
            });
            $("#menu_mahasiswa").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
            });
            $("#menu_frs").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").hide();
               $("#menu_item3").toggle();
            });
        });

        $("#select1").change(function() {
            if ($(this).data('options') === undefined) {
                $(this).data('options', $('#select2 option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[value=' + id + ']');
            $('#select2').html(options);
        });
    </script>
</head>
<body>
    <div id="col-kiri">
        <div id="menu">
            <a href="#" style="width: 100%; color: black; padding-left: 0px;">
                <div id="profile">
                    <?php 
                        if($_SESSION['user']['photo'] == ""){
                        ?>
                            <img src="../Photo/profile.png" alt="" id="photo">
                        <?php
                        }else{
                        ?>
                            <img src="../Photo/<?=$_SESSION['user']['photo']?>" alt="" id="photo">
                        <?php
                        }
                    ?>
                    <div id="text-profile">
                        <p><?=$_SESSION['user']['name']?></p>
                        <p><?=$_SESSION['user']['user']?></p>
                    </div>
                </div>
            </a>
            <a class = "btn dropdown-button blue lighten-2" href = "Home.php"><i class="material-icons left">home</i>Beranda</a>
            <a class = "btn dropdown-button blue lighten-2" id="menu_nilai"><i class="material-icons left">school</i>Nilai</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Mengajar</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ujian</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Dosen</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ruangan</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_mahasiswa"><i class="material-icons left">event_note</i>Mahasiswa</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "#">Lihat Mahasiswa</a>
                <a class = "btn dropdown-button blue" href = "halamanInputAbsen.php">Absen</a>
                <a class = "btn dropdown-button blue" href = "halamanAbsen.php">Lihat Absen</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_frs"><i class="material-icons left">event_note</i>FRS</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "halamanFRSpending.php">FRS Pending</a>
                <a class = "btn dropdown-button blue" href = "halamanFRS.php">Lihat FRS</a>
            </div>
        </div>
    </div>
    <div id="col-kanan">
        <div id="header">
            <h5 style="margin-top:20px; float:left; margin-left: 10px;">Sistem Informasi Mahasiswa</h5>
            <form action="#" method="post" style="float: right; margin-top:10px; margin-right: 10px;">
                <button class="btn waves-effect blue-grey lighten-3" style="width: 150px; height: 30px; padding-bottom: 2px; margin: 0px; margin-top:10px;" type="submit" name="btnLogout">Logout
                    <i class="material-icons right" style="margin: 0px;">exit_to_app</i>
                </button>
            </form>
        </div>
        <div id="container" style="padding: 10px;">
            <h3>Lihat Absen</h3>
            <form action="#" method="post" style="width: 50%">
                <div class="input-field col s12">
                    <select name="kelas" id="kelas" onchange="showAbsen()">
                        <option value="none" disabled selected>Pilih Kelas</option>
                        <?php
                            foreach ($listKelas as $key => $value) {
                                echo "<option value='" . $value['Kelas_ID'] . "'>" . $value['Matkul_Nama'] . " - " . $value['Kelas_Ruangan'] . " - " . $value['Kelas_Nama'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </form>
            <div id="listAbsen"></div>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>

<script>
    function showAbsen() {
        var kelas = $("#kelas").val();
        $.ajax({
            method : "post",
            url : "AbsenKelas.php",
            data : {
                kelas : kelas
            },
            success : function (hasil) {
                $("#listAbsen").html(hasil);
            }
        });
    }
</script>