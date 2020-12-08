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

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['idSkripsi'];

        $query = "DELETE FROM Skripsi WHERE Skripsi_ID = $id";
        $conn->query($query);

        echo "<script>alert(Berhasil delete Skripsi)</script>";
    }

    if(isset($_POST['btnUpdate'])) {
        $_SESSION['TA'] = $_POST['idSkripsi'];
        header("location: ../Dosen/halamanUpdateTugasAkhir.php");
    }

    $query = "SELECT s.*, m.Mahasiswa_Nama 
    FROM Skripsi s, Mahasiswa m 
    WHERE s.Mahasiswa_ID = m.Mahasiswa_ID 
    AND (s.Dosen_Penguji1 = '$dosenID' OR s.Dosen_Penguji2 = '$dosenID' OR s.Dosen_Penguji3 = '$dosenID')";
    $listTA = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tugas Akhir</title>
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
            <h3>List Skripsi</h3>
            <table>
                <tr>
                    <th>Judul Skripsi</th>
                    <th>Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Ruangan</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>

                <?php
                    foreach($listTA as $key => $value) {
                        echo "<tr>";
                        echo "<td>$value[Judul_Skripsi]</td>";
                        echo "<td>$value[Mahasiswa_Nama]</td>";
                        echo "<td>$value[Tanggal_Skripsi]</td>";
                        echo "<td>$value[Jam_Mulai]</td>";
                        echo "<td>$value[Jam_Selesai]</td>";
                        echo "<td>$value[Ruangan_Skripsi]</td>";
                        echo "<td><form action='' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnUpdate' id='$value[Skripsi_ID]' style='width: 150px;'>Update<i class='material-icons right'>Update</i></button><input type='hidden' name='idSkripsi' value='$value[Skripsi_ID]'></form></td>";
                ?>
                        <td><form action='' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnDelete' id='<?=$value['Skripsi_ID']?>' onClick='return confirm("Apakah yakin ingin delete?")' style='width: 150px;'>Delete<i class='material-icons right'>Delete</i></button><input type='hidden' name='idSkripsi' value='<?=$value['Skripsi_ID']?>'></form></td>
                <?php 
                    }
                ?>
            </table>
        </div>
        <div id="footer">

        </div>
    </div>
    <script>
        function confirmation() {
            return confirm("Apakah yakin ingin delete?");
        }
    </script>
</body>
</html>