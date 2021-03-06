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

    $nrp = $_SESSION['user']['user'];
    $query = "SELECT m.*, j.Jurusan_ID, j.Jurusan_Nama, d.Dosen_Nama FROM Mahasiswa m, Jurusan j, Dosen d 
              WHERE m.Dosen_Wali_ID = d.Dosen_ID AND SUBSTR(m.Mahasiswa_ID,4,3) = SUBSTR(j.Jurusan_ID,2,3) AND m.Mahasiswa_ID = '$nrp'";
    $mahasiswa = mysqli_fetch_array($conn->query($query));
    $nrp = $mahasiswa['Mahasiswa_ID'];
    $nama = $mahasiswa['Mahasiswa_Nama'];
    if($mahasiswa['Mahasiswa_JK'] == "M"){
        $jk = "Laki-laki";
    }else{
        $jk = "Perempuan";
    }
    $alamat = $mahasiswa['Mahasiswa_Alamat'];
    $tgl = $mahasiswa['Mahasiswa_Tgl'];
    $agama = $mahasiswa['Mahasiswa_Agama'];
    $email = $mahasiswa['Mahasiswa_Email'];
    $nohp = $mahasiswa['Mahasiswa_NoTelp'];
    $photo = $mahasiswa['Mahasiswa_Photo'];
    $semester = $mahasiswa['Mahasiswa_Semester'];
    $jurusan = $mahasiswa['Jurusan_Nama'];
    $dosen = $mahasiswa['Dosen_Nama'];
    if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "1"){
        $degree = "D1";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "2"){
        $degree = "D2";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "3"){
        $degree = "D3";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "4"){
        $degree = "D4";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "5"){
        $degree = "S1";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "6"){
        $degree = "S2";
    }else if(substr($mahasiswa['Jurusan_ID'], 1, 1) == "7"){
        $degree = "S3";
    }

    $query = "SELECT SUM(mk.SKS) as Total FROM Pengambilan p, Kelas k, Matkul_Kurikulum mk, Mahasiswa mhs
    WHERE mhs.Mahasiswa_ID = p.Mahasiswa_ID AND p.Kelas_ID = k.Kelas_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mhs.Mahasiswa_ID = '$nrp'";
    $totalSks = mysqli_fetch_array($conn->query($query));

    $totalIPS = 0;
    $countIPS = 0;
    for ($i=1; $i < 9; $i++) { 
        $query = "SELECT * FROM Pengambilan p, Kelas k,Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
        WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
        AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $i";
        $pengambilan = $conn->query($query);
        $counter = 0;
        $total = 0;
        // foreach ($pengambilan as $key => $value) {
        //     if($value['Pengambilan_Grade'] == "A"){
        //         $total += 4*$value['SKS'];
        //     }else if($value['Pengambilan_Grade'] == "B" || $value['Pengambilan_Grade'] == "B+"){
        //         $total += 3*$value['SKS'];
        //     }else if($value['Pengambilan_Grade'] == "C" || $value['Pengambilan_Grade'] == "C+"){
        //         $total += 2*$value['SKS'];
        //     }else if($value['Pengambilan_Grade'] == "D"){
        //         $total += 1*$value['SKS'];
        //     }else if($value['Pengambilan_Grade'] == "E"){
        //         $total += 0;
        //     }
        //     if($value['Pengambilan_Grade'] != ''){
        //         $counter+=$value['SKS'];
        //     }
        // }
        foreach ($pengambilan as $key => $value)
        {
            $grade = $value['Pengambilan_Grade'];
            $sks = $value['SKS'];
            $matkulId = $value['Matkul_ID'];
            $sems = $value['Semester_Pengambilan'];

            $query="SELECT * FROM Pengambilan p, Kelas k, Matkul m, Matkul_Kurikulum mk, Mahasiswa mhs , FRS f
            WHERE mhs.Mahasiswa_ID='$nrp' AND p.Kelas_ID=k.Kelas_ID AND mk.Matkul_Kurikulum_ID=k.Matkulkurikulum_ID AND m.Matkul_ID=mk.Matkul_ID AND p.Mahasiswa_ID = mhs.Mahasiswa_ID AND f.Mahasiswa_ID = mhs.Mahasiswa_ID
            AND k.Matkulkurikulum_ID = f.Matkul_Kurikulum_ID AND p.Pengambilan_Batal <> 1 AND f.FRS_Status <> 'Batal' AND mk.Semester = $i AND mk.Matkul_ID = '$matkulId'
            ORDER BY m.Matkul_Nama ASC";
            $listNilai2 = $conn->query($query);
            $hide = false;
            foreach ($listNilai2 as $key => $value) {
                if($matkulId == $value['Matkul_ID'] && $sems < $value['Semester_Pengambilan']){
                    $hide = true;
                }else if($matkulId == $value['Matkul_ID'] && $sems >= $value['Semester_Pengambilan']){
                    $hide = false;
                }
            }

            if(!$hide){
                if($grade == "A"){
                    $total+=4*$sks;
                }else if($grade == "B" || $grade == "B+"){
                    $total+=3*$sks;
                }else if($grade == "C" || $grade == "C+"){
                    $total+=2*$sks;
                }else if($grade == "D"){
                    $total+=1*$sks;
                }else{
                    $total+=0;
                }
                
                if($grade != ''){
                    $counter+=$sks;
                }
            }
        }
        if($counter > 0){
            $totalIPS += $total/$counter;
            $countIPS++;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
    <link rel="stylesheet" href="Mahasiswa.css">
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script src="../jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("#menu_nilai").click(function () {
               $("#menu_item1").toggle(); 
               $("#menu_item2").hide();
               $("#menu_item3").hide();
            });
            $("#menu_jadwal").click(function () {
               $("#menu_item1").hide(); 
               $("#menu_item2").toggle();
               $("#menu_item3").hide();
            });
            $("#menu_rencana").click(function () {
               $("#menu_item1").hide(); 
               $("#menu_item2").hide();
               $("#menu_item3").toggle();
            });
        });
    </script>
    <style>
        #photo2{
            margin-left: auto;
            margin-right: auto;
            width: 200px; 
            height: 200px;
            margin-top : 30px;
        }
        #container{
            height: auto;
        }
        .temp{
            display: grid;
            grid-template-columns: 50% 50%;
            width: 250px; 
            height: 50px; 
            margin-left: auto; 
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div id="col-kiri">
        <div id="menu">
            <a href="HalamanBiodata.php" style="width: 100%; color: black; padding-left: 0px;">
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
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanNilai.php">Laporan Nilai</a>
                <a class = "btn dropdown-button blue" href = "HalamanNilaiPraktikum.php">Nilai Praktikum</a>
                <a class = "btn dropdown-button blue" href = "HalamanTranskripNilai.php">Transkrip Nilai</a>
                <a class = "btn dropdown-button blue" href = "Laporan.php">Grafik</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanJadwalKuliah.php">Jadwal Kuliah</a>
                <a class = "btn dropdown-button blue" href = "HalamanJadwalUjian.php">Jadwal Ujian</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "HalamanAbsen.php"><i class="material-icons left">event_available</i>Absen</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_rencana"><i class="material-icons left">event_note</i>Rencana Studi</a>
            <div id="menu_item3" hidden>
                <a class = "btn dropdown-button blue" href = "HalamanFRS.php">FRS</a>
                <a class = "btn dropdown-button blue" href = "HalamanBatalTambah.php">Batal Tambah</a>
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
        <div id="container" style="padding: 20px;">
            <div style="text-align: center; margin-bottom: 50px;">
                <?php 
                    if($photo == ""){
                    ?>
                        <img src="../Photo/profile.png" alt="" id="photo2"> 
                    <?php
                    }else{
                    ?>
                        <img src="../Photo/<?=$photo?>" alt="" id="photo2">
                    <?php
                    }
                ?>
                <h5><?=$nama?></h5>
                <h6><?=$nrp?></h6>
                <p><?=$degree?>-<?=$jurusan?></p>
                <div class="temp">
                    <h5 style="float: left;">
                    <?php
                        if ($totalSks['Total'] > 0) {
                            echo $totalSks['Total'];
                        } else {
                            echo 0;
                        }
                    ?></h5>
                    <h5 style="float: right;">
                    <?php
                        if ($countIPS > 0) {
                            echo substr($totalIPS/$countIPS, 0, 4);
                        }else{
                            echo 0;
                        }
                    ?></h5>
                </div>
                <div class="temp">
                    <p style="float: left;">Total SKS</p>
                    <p style="float: right;">IPK</p>
                </div>
            </div>
            <h3>Biodata</h3>
            <table style="width: 700px;" class="highlight">
                <tr>
                    <td>Alamat</td>
                    <td style="text-align: right;"><?=$alamat?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td style="text-align: right;"><?=$email?></td>
                </tr>
                <tr>
                    <td>No Telp</td>
                    <td style="text-align: right;"><?=$nohp?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td style="text-align: right;"><?=$tgl?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td style="text-align: right;"><?=$agama?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td style="text-align: right;"><?=$jk?></td>
                </tr>
            </table>
            <h3>Status Akademis</h3>
            <table style="width: 700px;" class="highlight">
                <tr>
                    <td>Dosen Wali</td>
                    <td style="text-align: right;"><?=$dosen?></td>
                </tr>
            </table>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>