<?php
    session_start();
    require_once('../Required/Connection.php');
    $dosenID = $_SESSION['user']['user'];

    if(!isset($_SESSION['user']['user'])){
        header("location: ../login.php");
    } 

    if(isset($_POST['btnLogout'])){
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

    $idSkripsi = $_SESSION['TA'];

    $query = "SELECT s.*, m.Mahasiswa_Nama 
    FROM Skripsi s, Mahasiswa m 
    WHERE Skripsi_ID = $idSkripsi 
    AND m.Mahasiswa_ID = s.Mahasiswa_ID";
    $Skripsi = $conn->query($query);

    $query = "SELECT * FROM Dosen";
    $listDosen = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tugas Akhir</title>
    <link rel="stylesheet" href="Dosen.css">
    <script src="../jquery.js"></script>
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
    <script>
        $(document).ready(function () {
            $('select').material_select();

            $("#menu_jadwal").click(function () {
               $("#menu_item1").toggle();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
               $("#menu_item4").hide();
            });
            $("#menu_mahasiswa").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
               $("#menu_item4").hide();
            });
            $("#menu_frs").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").hide();
               $("#menu_item3").toggle();
               $("#menu_item4").hide();
            });
            $("#menu_ta").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").hide();
               $("#menu_item3").hide();
               $("#menu_item4").toggle();
            });
        });

        function updateTA() {
            if ($("#penguji1").val() == $("#penguji2").val() || $("#penguji2").val() == $("#penguji3").val() || $("#penguji1").val() == $("#penguji3").val()) {
                alert("Dosen Penguji tidak boleh kembar");
            }
            else {
                $.ajax({
                    method : "post",
                    url : "updateTugasAkhir.php",
                    async: false,
                    data : {
                        idSkripsi : $("#idSkripsi").val(),
                        penguji1 : $("#penguji1").val(),
                        penguji2 : $("#penguji2").val(),
                        penguji3 : $("#penguji3").val(),
                        judul : $("#judul").val(),
                        tanggal : $("#tanggal").val(),
                        mulai : $("#mulai").val(),
                        selesai : $("#selesai").val(),
                        ruangan : $("#ruangan").val()
                    },
                }).done(function(data){
                    alert("Berhasil Update Tugas Akhir");
                }).fail(function(){
                    alert("Gagal Update Tugas Akhir");
                });;
            }
        }
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
            <a class = "btn dropdown-button blue lighten-2" href = "halamanInsertNilai.php"><i class="material-icons left">school</i>Nilai</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "halamanJadwalMengajar.php">Jadwal Mengajar</a>
                <a class = "btn dropdown-button blue" href = "halamanJadwalUjian.php">Jadwal Ujian</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_mahasiswa"><i class="material-icons left">event_note</i>Mahasiswa</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "halamanInputAbsen.php">Input Absen</a>
                <a class = "btn dropdown-button blue" href = "halamanAbsen.php">Lihat Absen</a>
                <a class = "btn dropdown-button blue" href = "halamanEditAbsen.php">Edit Absen</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_frs"><i class="material-icons left">event_note</i>FRS</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "halamanFRSpending.php">FRS Pending</a>
                <a class = "btn dropdown-button blue" href = "halamanFRS.php">Lihat FRS</a>
                <a class = "btn dropdown-button blue" href = "halamanBatalTambah.php">Batal Tambah</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_ta"><i class="material-icons left">event_note</i>Tugas Akhir</a>
            <div id="menu_item4" hidden>
                <a class = "btn dropdown-button blue" href = "halamanTugasAkhir.php">Lihat TA</a>
                <a class = "btn dropdown-button blue" href = "halamanInsertTugasAkhir.php">Input TA</a>
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
            <div style="width: 50%;">
                <form action="" method="post">
                    <h3>Update Skripsi</h3>
                    <?php
                        foreach($Skripsi as $key => $value) {
                    ?>
                        <input type="hidden" id="idSkripsi" value="<?=$value['Skripsi_ID']?>">
                        Nama Mahasiswa <input type="text" id="nama" value="<?=$value['Mahasiswa_Nama']?>" disabled><br>
                        Judul Skripsi <input type="text" id="judul" value="<?=$value['Judul_Skripsi']?>"><br>
                        <div class="input-field col s12">
                            Dosen Penguji 1
                            <select id="penguji1">
                                <?php
                                    foreach ($listDosen as $key2 => $value2) {
                                        if ($value['Dosen_Penguji1'] == $value2['Dosen_ID']) {
                                            echo "<option value='$value2[Dosen_ID]' selected>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                        else {
                                            echo "<option value='$value2[Dosen_ID]'>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                    }
                                ?>
                            </select><br>
                            Dosen Penguji 2
                            <select id="penguji2">
                                <?php
                                    foreach ($listDosen as $key2 => $value2) {
                                        if ($value['Dosen_Penguji2'] == $value2['Dosen_ID']) {
                                            echo "<option value='$value2[Dosen_ID]' selected>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                        else {
                                            echo "<option value='$value2[Dosen_ID]'>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                    }
                                ?>
                            </select><br>
                            Dosen Penguji 3
                            <select id="penguji3">
                                <?php
                                    foreach ($listDosen as $key2 => $value2) {
                                        if ($value['Dosen_Penguji3'] == $value2['Dosen_ID']) {
                                            echo "<option value='$value2[Dosen_ID]' selected>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                        else {
                                            echo "<option value='$value2[Dosen_ID]'>" . $value2['Dosen_Nama'] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s12">
                            Tanggal Skripsi
                            <input type="date" id="tanggal" value="<?php echo($value['Tanggal_Skripsi'])?>">
                        </div>
                        Jam Mulai
                        <input type="time" id="mulai" value="<?php echo($value['Jam_Mulai'])?>">
                        Jam Selesai
                        <input type="time" id="selesai" value="<?php echo($value['Jam_Selesai'])?>">
                        Ruangan Skripsi: <input type="text" id="ruangan" value="<?=$value['Ruangan_Skripsi']?>"><br>
                    <?php
                        }
                    ?>
                    
                    <button class="btn waves-effect grey lighten-1" style="width: 155px; height: 35px; padding-bottom: 2px; margin: 0px;" type="button" id="btnUpdate" onclick="updateTA()">Update<i class="material-icons right">edit</i></button>
                </form>
            </div>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>