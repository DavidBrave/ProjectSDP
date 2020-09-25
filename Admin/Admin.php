<?php
    session_start();
    require_once('../Required/Connection.php');
?>

<?php

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
        .kotak{
            width: 200px;
            height: 100px;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        #dosen{
            background-color: green;
        }
        #mahasiswa{
            background-color: plum;
        }
        #admin{
            background-color: lightblue;
        }
    </style>
    <script src="jquery.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
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
                <li><a href = "#">Data Dosen</a></li>
                <li><a href = "#">Insert Data Dosen</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Dosen<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown3" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Jurusan</a></li>
                <li><a href = "#">Insert Data Jurusan</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Jurusan<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown4" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Mata Kurikulum</a></li>
                <li><a href = "#">Insert Data Kurikulum</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Kurikulum<i class = "mdi-navigation-arrow-drop-down right"></i></a>
            <ul id = "dropdown5" class = "dropdown-content blue-grey lighten-4">
                <li><a href = "#">Data Mata Kuliah</a></li>
                <li><a href = "#">Insert Data Mata Kuliah</a></li>
            </ul>
            <a class = "btn dropdown-button blue lighten-2" href = "#" data-activates = "dropdown" style="width: 100%; color: black;">Mata Kuliah<i class = "mdi-navigation-arrow-drop-down right"></i></a>
        </div>    
        <div id="col-kanan">
            <h3 style="margin-top: 0px">Selamat Datang <?=$_SESSION['user']['name']?></h3>
            <div style="display: grid; grid-template-columns: auto auto auto; width: 600px;">
                <div id="dosen" class="kotak">
                    <p style="margin-top: 0px; font-size: 15px;">DOSEN</p>
                    <?php
                        $query = "SELECT * FROM Dosen";
                        $listDosen = $conn->query($query);
                        $totalDosen = mysqli_num_rows($listDosen);
                    ?>
                    <p id="totalDosen" style="margin: 0px;">Jumlah: <?=$totalDosen?></p>
                </div>
                <div id="mahasiswa" class="kotak">
                    <p style="margin-top: 0px; font-size: 15px;">MAHASISWA</p>
                    <?php
                        $query = "SELECT * FROM Mahasiswa";
                        $listMahasiswa = $conn->query($query);
                        $totalMahasiswa = mysqli_num_rows($listMahasiswa);
                    ?>
                    <p id="totalMahasiswa" style="margin: 0px;">Jumlah: <?=$totalMahasiswa?></p>
                </div>
                <div id="admin" class="kotak">
                    <p style="margin-top: 0px; font-size: 15px;">ADMIN</p>
                    <?php
                        $query = "SELECT * FROM Administrator";
                        $listAdministrator = $conn->query($query);
                        $totalAdministrator = mysqli_num_rows($listAdministrator);
                    ?>
                    <p id="totalAdmin" style="margin: 0px;">Jumlah: <?=$totalAdministrator?></p>
                </div>
            </div>
            <div id="piechart"></div>
        </div>
    </div>
</body>
</html>
<script>
    $("#btn").click(function () {
        alert(<?=$totalAdministrator?>);
    });
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Job', 'Jumlah'],
        ['Dosen', <?=$totalDosen?>],
        ['Mahasiswa', <?=$totalMahasiswa?>],
        ['Admin', <?=$totalAdministrator?>]
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title':'Persentase', 
            'width':600, 
            'height':450,
            slices: {
                0: { color: 'green' },
                1: { color: 'plum' },
                2: { color: 'lightblue' }
            }
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>