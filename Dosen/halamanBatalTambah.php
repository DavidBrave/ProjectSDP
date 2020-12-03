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
        $_SESSION['detailFRSpending'] = $_POST['idMahasiswa'];
        header("location: halamanDetailFRSpending.php");
    }

    $dosenID = $_SESSION['user']['user'];
    $query = "SELECT DISTINCT m.Mahasiswa_ID, m.Mahasiswa_Nama, m.Mahasiswa_Semester, ma.Matkul_Nama, a.FRS_Status, a.Matkul_Kurikulum_ID
    FROM Mahasiswa m, Dosen d, FRS a, Matkul_Kurikulum mk, Matkul ma
    WHERE m.Mahasiswa_ID = a.Mahasiswa_ID 
    AND m.Dosen_Wali_ID = $dosenID
    AND a.Matkul_Kurikulum_ID = mk.Matkul_Kurikulum_ID 
    AND mk.Matkul_ID = ma.Matkul_ID
    AND (a.FRS_Status = 'Batal' OR a.FRS_Status = 'Tambah')";
    $listBatalTambah = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRS</title>
    <link rel="stylesheet" href="Dosen.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="../jquery.js"></script>
    <script>
        $(document).ready(function () {
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

        function TolakClick(clicked_id)
        {
            var nama = $("#Nama" + clicked_id).val();
            var id = $("#Matkul" + clicked_id).val();
            var result = confirm("Apakah Yakin Ingin Tolak Batal?");
            if (result) {
                $.ajax({
                    method : "post",
                    url : "tolakBatal.php",
                    async : false,
                    data : {
                        id : id,
                        matkul : clicked_id
                    },

                }).done(function(data){
                    alert("Batal Mahasiswa " + nama + " Berhasil Ditolak");
                }).fail(function(data){
                    alert("Tolak Batal Mahasiswa " + nama + " Dibatalkan");
                });;
            }

            location.reload();
            return false;
        }

        function TerimaClick(clicked_id)
        {
            var nama = $("#Nama" + clicked_id).val();
            var id = $("#Matkul" + clicked_id).val();
            var result = confirm("Apakah Yakin Ingin Terima Batal?");
            if (result) {
                $.ajax({
                    method : "post",
                    url : "terimaBatal.php",
                    async : false,
                    data : {
                        id : id,
                        matkul : clicked_id
                    },

                }).done(function(data){
                    alert("Batal Mahasiswa " + nama + " Berhasil Diterima");
                }).fail(function(data){
                    alert("Terima Batal Mahasiswa " + nama + " Dibatalkan");
                });;
            }

            location.reload();
            return false;
        }

        function TolakClick2(clicked_id)
        {
            var nama = $("#Nama" + clicked_id).val();
            var id = $("#Matkul" + clicked_id).val();
            var result = confirm("Apakah Yakin Ingin Tolak Tambah?");
            if (result) {
                $.ajax({
                    method : "post",
                    url : "tolakTambah.php",
                    async : false,
                    data : {
                        id : id,
                        matkul : clicked_id
                    },

                }).done(function(data){
                    alert("Tambah Mahasiswa " + nama + " Berhasil Ditolak");
                }).fail(function(data){
                    alert("Tolak Tambah Mahasiswa " + nama + " Dibatalkan");
                });;
            }

            location.reload();
            return false;
        }

        function TerimaClick2(clicked_id)
        {
            var nama = $("#Nama" + clicked_id).val();
            var id = $("#Matkul" + clicked_id).val();
            var result = confirm("Apakah Yakin Ingin Terima Tambah?");
            if (result) {
                $.ajax({
                    method : "post",
                    url : "terimaTambah.php",
                    async : false,
                    data : {
                        id : id,
                        matkul : clicked_id
                    },

                }).done(function(data){
                    alert("Tambah Mahasiswa " + nama + " Berhasil Diterima");
                }).fail(function(data){
                    alert("Terima Tambah Mahasiswa " + nama + " Dibatalkan");
                });;
            }

            location.reload();
            return false;
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
            <a href = "halamanInsertNilai.php" class = "btn dropdown-button blue lighten-2" id="menu_nilai"><i class="material-icons left">school</i>Nilai</a>
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
        <div id="container">
            <h3>List Batal Tambah (Pending)</h3><br>
            <table id = "dataFRS" border="1" style="display: hidden">
            <tr>
                <?php
                    if(mysqli_num_rows($listBatalTambah) == 0){
                        echo "<h4>Tidak ada data</h4>";
                    }else{
                        echo "<th>NRP Mahasiswa</th>";
                        echo "<th>Nama</th>";
                        echo "<th>Semester</th>";
                        echo "<th>Mata Kuliah</th>";
                        echo "<th>Status</th>";
                        echo "<th>Terima</th>";
                        echo "<th>Tolak</th>";
                    }
                ?>
            </tr>

            <?php
                foreach ($listBatalTambah as $key => $value) {
                    echo "<tr>";
                    echo "<td>$value[Mahasiswa_ID]</td>";
                    echo "<td>$value[Mahasiswa_Nama]</td>";
                    echo "<td>$value[Mahasiswa_Semester]</td>";
                    echo "<td>$value[Matkul_Nama]</td>";
                    echo "<Td>$value[FRS_Status]</td>";
                    if ($value['FRS_Status'] == "Batal") {
                        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnTerima' id='$value[Matkul_Kurikulum_ID]' onClick='TerimaClick(this.id)' style='width: 150px;'>Terima<i class='material-icons right'>Terima</i></button><input type='hidden' name='idMahasiswa' value='$value[Mahasiswa_Nama]'></form></td>";
                        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnTolak' id='$value[Matkul_Kurikulum_ID]' onClick='TolakClick(this.id)' style='width: 150px;'>Tolak<i class='material-icons right'>Tolak</i></button><input type='hidden' id='Nama$value[Matkul_Kurikulum_ID]' value='$value[Mahasiswa_Nama]'></form></td>";
                    }
                    else {
                        echo "<td><form action='#' method='post'><button class='btn waves-effect waves-light' type='submit' name='btnTerima' id='$value[Matkul_Kurikulum_ID]' onClick='TerimaClick2(this.id)' style='width: 150px;'>Terima<i class='material-icons right'>Terima</i></button><input type='hidden' name='idMahasiswa' value='$value[Mahasiswa_Nama]'></form></td>";
                        echo "<td><form action='#' method='post'><button class='btn waves-effect red darken-3' type='submit' name='btnTolak' id='$value[Matkul_Kurikulum_ID]' onClick='TolakClick2(this.id)' style='width: 150px;'>Tolak<i class='material-icons right'>Tolak</i></button><input type='hidden' id='Nama$value[Matkul_Kurikulum_ID]' value='$value[Mahasiswa_Nama]'></form></td>";
                    }
                    echo "<input type='hidden' id='Matkul$value[Matkul_Kurikulum_ID]' value='$value[Mahasiswa_ID]'>";
                    
                    echo "</tr>";
                }

                $conn->close();
            ?>
            </table>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>