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

        $nrp=$_POST['nrp_mahasiswa'];
        $id_kelas=$_POST['kelas'];
        if (isset($_POST['ujian']))
        {
            if ($_POST['ujian']=="quiz")
            {
                $query="UPDATE Pengambilan SET Quiz=$_POST[nilai] WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            }
            elseif ($_POST['ujian']=="uts")
            {
                $query="UPDATE Pengambilan SET UTS=$_POST[nilai] WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            }
            elseif ($_POST['ujian']=="uas")
            {
                $query="UPDATE Pengambilan SET UAS=$_POST[nilai] WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            }
            $conn->query($query);  
            $query="SELECT UTS FROM PENGAMBILAN WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            $nilaiUTS=$conn->query($query);  
            $query="SELECT UAS FROM PENGAMBILAN WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            $nilaiUAS=$conn->query($query);
            $query="SELECT Quiz FROM PENGAMBILAN WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            $nilaiQuiz=$conn->query($query);
            $nilaiAkhir=($nilaiQuiz*(30/100)+($nilaiUTS*(30/100)+($nilaiUAS*(40/100))));
            $query="UPDATE Pengambilan SET NilaiAkhir=$nilaiAkhir WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            $conn->query($query);
            $grade="";
            if ($nilaiAkhir>=80)
                $grade="A";
            elseif (($nilaiAkhir<80)&&($nilaiAkhir>=70))
                $grade="B";
            elseif (($nilaiAkhir<70)&&($nilaiAkhir>=56))
                $grade="C";
            else
                $grade="D";
            $query="UPDATE Pengambilan SET Grade=$grade WHERE Mahasiswa_ID=$nrp AND Kelas_ID=$id_kelas";
            $conn->query($query);        
        }
        $conn->close();

    }
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


    <script src="../jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("select").material_select();


            $("#menu_jadwal").click(function () {
               $("#menu_item1").toggle();
               $("#menu_item2").hide();
            });
            $("#menu_mahasiswa").click(function () {
               $("#menu_item1").hide();
               $("#menu_item2").toggle();
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
            <a class = "btn dropdown-button blue lighten-2" id="menu_nilai"><i class="material-icons left">school</i>Nilai</a>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_jadwal"><i class="material-icons left">schedule</i>Jadwal</a>
            <div id="menu_item1" hidden>
                <a class = "btn dropdown-button blue" href = "halamanJadwalMengajar.php">Jadwal Mengajar</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ujian</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Dosen</a>
                <a class = "btn dropdown-button blue" href = "#">Jadwal Ruangan</a>
            </div>
            <a class = "btn dropdown-button blue lighten-2" href = "#" id="menu_mahasiswa"><i class="material-icons left">event_note</i>Mahasiswa</a>
            <div id="menu_item2" hidden>
                <a class = "btn dropdown-button blue" href = "#">Lihat Mahasiswa</a>
                <a class = "btn dropdown-button blue" href = "#">Absen</a>
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

        <div style="width: 50%;">
            <form action="POST">

                <h3>Insert Nilai Mahasiswa</h3><br>
                NRP Mahasiswa : <input type="text" name="nrp_mahasiswa" id="">
                Kelas : <input type="text" name="id_kelas" id="">
                            //     $dosen_query = "SELECT * FROM Dosen WHERE Dosen_ID = '$kelas[DosenPengajar_ID]'";
                            //     $dosen = $conn->query($dosen_query);
                            //     $dosen = $dosen->fetch_assoc();

                            // }



                        ?>
                    </select>
                </div>

                Nama Mahasiswa : 
                <div class="input-field col s12">
                    <select name="nrp_mahasiswa" id="select2">
                    <option value="none" disabled selected>Pilih Mahasiswa</option>
                        <?php
                            
                            
                            $query_pengambilan = "SELECT * FROM Pengambilan";
                            $list_pengambilan = $conn->query($query_pengambilan);

                            $pengambilan = null;
                            while ($pengambilan = $list_pengambilan->fetch_assoc()) {
                                $val = $pengambilan['Mahasiswa_ID'];//."-".$pengambilan['Pengambilan_ID'];

                                $mahasiswa_id = $pengambilan['Mahasiswa_ID'];
                                $mahasiswa_query = "SELECT * FROM Mahasiswa WHERE Mahasiswa_ID = '$mahasiswa_id'";
                                $list_mahasiswa = $conn->query($mahasiswa_query);
                                $mahasiswa = $list_mahasiswa->fetch_assoc();
                                echo("<option value='$val'>".
                                        $mahasiswa['Mahasiswa_Nama']."</option>");
                            }
                            



                        ?>
                    </select>
                </div>


<!--                 
                NRP Mahasiswa : <input type="text" name="nrp_mahasiswa" id=""> -->
                Kelas :
                <div class="input-field col s12">
                    <select name="ujian">
                        <option value="none" disabled selected>Pilih Ujian</option>
                        <option value="quiz">Quiz</option>
                        <option value="uts">UTS</option>
                        <option value="uas">UAS</option>
                    </select>

                    Nilai : <input type="text" name="nilai" id="">

                </div>
                <button class="btn waves-effect grey lighten-1" style="width: 140px; height: 30px; padding-bottom: 2px; margin: 0px;" type="submit" name = "btnInsert">Insert</button>
            </form>
        </div>
            

        </div>
        <div id="footer">

        </div>
    </div>
</body>
</html>