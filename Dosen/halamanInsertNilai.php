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

    if (isset($_POST['btnInsert'])) {
        if (isset($_POST['ujian']) && isset($_POST['mahasiswa']) && isset($_POST['nilai']))
        {
            $nrp = $_POST['mahasiswa'];
            $kelasId = $_POST['kelas'];
            $nilai = $_POST['nilai'];

            if ($_POST['ujian'] == "quiz"){
                $query = "UPDATE Pengambilan SET Quiz = $nilai WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId'";
                $conn->query($query);  
                echo "<script>alert('Berhasil insert nilai')</script>";
            }else if ($_POST['ujian'] == "uts"){
                $query = "UPDATE Pengambilan SET UTS = $nilai WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId'";
                $conn->query($query);  
                echo "<script>alert('Berhasil insert nilai')</script>";
            }else if ($_POST['ujian'] == "uas"){
                $query = "UPDATE Pengambilan SET UAS = $nilai WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId'";
                $conn->query($query);  

                $query = "SELECT UTS FROM Pengambilan WHERE Mahasiswa_ID='$nrp' AND Kelas_ID='$kelasId'";
                $nilaiUTS = mysqli_fetch_array($conn->query($query));  
                $query = "SELECT UAS FROM Pengambilan WHERE Mahasiswa_ID='$nrp' AND Kelas_ID='$kelasId'";
                $nilaiUAS = mysqli_fetch_array($conn->query($query));
                $query = "SELECT Quiz FROM Pengambilan WHERE Mahasiswa_ID='$nrp' AND Kelas_ID='$kelasId'";
                $nilaiQuiz = mysqli_fetch_array($conn->query($query));
                $nilaiAkhir = ((int)$nilaiQuiz['Quiz']*(30/100)+((int)$nilaiUTS['UTS']*(30/100)+((int)$nilaiUAS['UAS']*(40/100))));

                $query = "SELECT m.Matkul_Standar FROM Kelas k, Matkul_Kurikulum mk, Matkul m 
                WHERE k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND mk.Matkul_ID = m.Matkul_ID AND k.Kelas_ID = '$kelasId'";
                $standar = mysqli_fetch_array($conn->query($query));
                if($nilaiAkhir >= $standar['Matkul_Standar']){
                    $query="UPDATE Pengambilan SET Nilai_Akhir = $nilaiAkhir, Pengambilan_Status = 'Lulus' WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId'";
                    $conn->query($query);
                }else{
                    $query="UPDATE Pengambilan SET Nilai_Akhir = $nilaiAkhir, Pengambilan_Status = 'Tidak Lulus' WHERE Mahasiswa_ID = '$nrp' AND Kelas_ID = '$kelasId'";
                    $conn->query($query);
                }
                $grade="";
                if ($nilaiAkhir>=80)
                    $grade="A";
                elseif (($nilaiAkhir<80)&&($nilaiAkhir>=75))
                    $grade="B+";
                elseif (($nilaiAkhir<75)&&($nilaiAkhir>=70))
                    $grade="B";
                elseif (($nilaiAkhir<70)&&($nilaiAkhir>=65))
                    $grade="C+";
                elseif (($nilaiAkhir<65)&&($nilaiAkhir>=56))
                    $grade="C";
                elseif (($nilaiAkhir<56)&&($nilaiAkhir>=45))
                    $grade="D";
                else
                    $grade="E";
                $query="UPDATE Pengambilan SET Pengambilan_Grade='$grade' WHERE Mahasiswa_ID='$nrp' AND Kelas_ID='$kelasId'";
                $conn->query($query);
                echo "<script>alert('Berhasil insert nilai')</script>";
            }else if($_POST['ujian'] == "praktikum"){
                $query = "SELECT * FROM Kelas_Praktikum kp, Praktikum p, Matkul_Kurikulum mk, Kelas k
                WHERE kp.Praktikum_ID = p.Praktikum_ID AND p.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID 
                AND p.Praktikum_ID = mk.Praktikum_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND k.Kelas_ID = '$kelasId'";
                $praktikum = mysqli_num_rows($conn->query($query));

                if($praktikum > 0){
                    $query = "SELECT * FROM Pengambilan_Praktikum pp, Kelas_Praktikum kp, Praktikum p, Matkul_Kurikulum mk, Kelas k, Mahasiswa mhs
                    WHERE pp.Kelas_Praktikum_ID = kp.Kelas_Praktikum_ID AND kp.Praktikum_ID = p.Praktikum_ID AND p.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID 
                    AND p.Praktikum_ID = mk.Praktikum_ID AND k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND k.Kelas_ID = '$kelasId' AND pp.Mahasiswa_ID = mhs.Mahasiswa_ID 
                    AND pp.Semester_Pengambilan_Praktikum = mhs.Mahasiswa_Semester AND mhs.Mahasiswa_ID = '$nrp'";
                    $ambilPraktikum = mysqli_num_rows($conn->query($query));
                    $pengambilanPraktikum = mysqli_fetch_array($conn->query($query));
                    $kelasPraktikum = $pengambilanPraktikum['Kelas_Praktikum_ID'];

                    if($ambilPraktikum > 0){
                        if($nilai >= $pengambilanPraktikum['Praktikum_Standar']){
                            $query="UPDATE Pengambilan_Praktikum SET Nilai_Praktikum='$nilai', Pengambilan_Praktikum_Status = 'Lulus' WHERE Mahasiswa_ID='$nrp' AND Kelas_Praktikum_ID='$kelasPraktikum'";
                            $conn->query($query);
                        }else{
                            $query="UPDATE Pengambilan_Praktikum SET Nilai_Praktikum='$nilai', Pengambilan_Praktikum_Status = 'Tidak Lulus' WHERE Mahasiswa_ID='$nrp' AND Kelas_Praktikum_ID='$kelasPraktikum'";
                            $conn->query($query);
                        }
                        echo "<script>alert('Berhasil insert nilai')</script>";
                    }else{
                        echo "<script>alert('Praktikum belum diambil')</script>";
                    }
                }else{
                    echo "<script>alert('Tidak ada praktikum di kelas ini')</script>";
                }
            }
        }else{
            echo "<script>alert('Inputan harus diisi')</script>";
        }
    }

    //Periode Sekarang
    $tahun1 = date("Y");
    $tahun2 = $tahun1 + 1;
    $bulan = date("m");
    $periodeID = $tahun1 . $tahun2;
    if ($bulan >= 8 && $bulan <= 12 || $bulan == 1) {
        $periodeID = $periodeID . "11";
    } else if ($bulan >= 2 && $bulan <= 7) {
        $periodeID = $periodeID . "21";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Nilai</title>
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

            $("#kelas").change(function () {
                var kelasId = $("#kelas").val();
                $.ajax({
                    method : "post",
                    url : "daftarMahasiswa.php",
                    data : {
                        id : kelasId
                    },
                    success : function (hasil) {
                        $("#mahasiswa-container1").hide();
                        $("#mahasiswa-container2").html(hasil);
                    }
                });
            });
        });

        // $("#select1").change(function() {
        //     if ($(this).data('options') === undefined) {
        //         $(this).data('options', $('#select2 option').clone());
        //     }
        //     var id = $(this).val();
        //     var options = $(this).data('options').filter('[value=' + id + ']');
        //     $('#select2').html(options);
        // });
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
            <a class = "btn dropdown-button blue lighten-3" href = "#" id="menu_frs"><i class="material-icons left">event_note</i>FRS</a>
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
        <div id="container" style="padding: 10px;">
            <form action="#" method="post" style="width: 500px;">
                <h3>Insert Nilai Mahasiswa</h3><br>
                Kelas : 
                <div class="input-field col s12">
                    <select name="kelas" id="kelas">
                        <option value="none" disabled selected>Pilih Kelas</option>
                        <?php
                            $id_dosen = $_SESSION['user']['user'];
                            $query_kelas = "SELECT * FROM Kelas k, Matkul_Kurikulum mk WHERE k.Matkulkurikulum_ID = mk.Matkul_Kurikulum_ID AND k.DosenPengajar_ID = '$id_dosen' AND mk.Periode_ID = '$periodeID'";
                            $list_kelas = $conn->query($query_kelas);
                            $kelas = null;
                            while ($kelas = $list_kelas->fetch_assoc()) {
                                $matkul_kurikulum_id = $kelas['Matkulkurikulum_ID'];
                                $query_matkul_kurikulum = "SELECT * FROM Matkul_Kurikulum WHERE Matkul_Kurikulum_ID = '$matkul_kurikulum_id'";
                                $list_matkul_kurikulum = $conn->query($query_matkul_kurikulum);
                                $matkul_kurikulum = $list_matkul_kurikulum->fetch_assoc();
                                $matkul_id = $matkul_kurikulum['Matkul_ID'];
                                $query_matkul = "SELECT * FROM Matkul WHERE Matkul_ID = '$matkul_id'";
                                $list_matkul = $conn->query($query_matkul);
                                $matkul = $list_matkul->fetch_assoc();
                                echo "<option value='$kelas[Kelas_ID]'>".$kelas['Kelas_Nama']." - ".$matkul['Matkul_Nama']." - Semester ".$matkul_kurikulum['Semester']."</option>";
                            }
                        ?>
                    </select>
                </div>
                Nama Mahasiswa : 
                <div class="input-field col s12">
                    <div id="mahasiswa-container1">
                        <select name="mahasiswa" disabled>
                            <option value="none" selected disabled>Pilih Mahasiswa</option>
                        </select>
                    </div>
                    <div id="mahasiswa-container2">

                    </div>
                    <!-- <select name="nrp_mahasiswa" id="select2">
                    <option value="none" disabled selected>Pilih Mahasiswa</option>
                        <?php
                            /* $query_pengambilan = "SELECT * FROM Pengambilan";
                            $list_pengambilan = $conn->query($query_pengambilan);
                            $pengambilan = null;
                            while ($pengambilan = $list_pengambilan->fetch_assoc()) {
                                $val = $pengambilan['Kelas_ID'];
                                $mahasiswa_id = $pengambilan['Mahasiswa_ID'];
                                $mahasiswa_query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$mahasiswa_id'";
                                $list_mahasiswa = $conn->query($mahasiswa_query);
                                $mahasiswa = $list_mahasiswa->fetch_assoc();
                                echo("<option value='$val'>".
                                        $mahasiswa['Mahasiswa_Nama']."</option>");
                            } */
                        ?>
                    </select> -->
                </div>
                Ujian :
                <div class="input-field col s12">
                    <select name="ujian" id="ujian">
                        <option value="none" disabled selected>Pilih Ujian</option>
                        <option value="quiz">Quiz</option>
                        <option value="uts">UTS</option>
                        <option value="uas">UAS</option>
                        <option value="praktikum">Praktikum</option>
                    </select>
                </div>
                Nilai : <input type="text" name="nilai" id="">
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit">Insert</button>
            </form>
        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>