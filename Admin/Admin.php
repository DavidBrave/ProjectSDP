<?php
    require_once('../Required/Connection.php');
?>

<?php
    if(isset($_POST['btnInsert'])){
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $dosen = $_POST['dosen'];

        $query = "INSERT INTO Mahasiswa VALUES ('$nrp','$dosen','','$nama','','','','','','','')";
        $con->query($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body{
            display: grid;
            grid-template-rows: 8% 8% 76% 8%;
            margin: 0px;
            height: 937px;
            background-color: rgb(247,224,159);
        }
        .header{
            text-align: center;
            background-image: url('../Image/pink.jpg');
            background-size: cover;
            background-position: center;
        }
        .nav{
            display: grid;
            grid-template-columns: auto auto auto auto auto;
            background-image: url('../Image/pink.jpg');
            background-size: cover;
            background-position-y: top;
        }
        .content{
            display: grid;
            grid-template-columns: 50% 50%;
            margin: 0px;
        }
        .footer{
            text-align: center;
            background-image: url('../Image/pink.jpg');
            background-size: cover;
            background-position: center;
            padding-top: 10px;
            margin: 0px;
        }
        .nav-text{
            font-size: 18px;
            text-align: center;
            border-left: 1px solid lightskyblue;
            border-right: 1px solid lightskyblue;
            color: black;
        }
        a:hover{
            background-color: plum;
        }
        #col-kiri{
            text-align: center;
        }
        #content-kiri{
            margin-top: 50px;
            background-color: white;
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            height: 500px;
        }
        #content-kanan{
            margin-top: 50px;
            background-color: white;
            width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            height: 500px;
        }
        input{
            width: 200px;
            height: 30px;
        }
        #selector{
            width: 200px;
            height: 30px;
        }
        button{
            margin: 10px;
            width: 100px;
            height: 40px;
        }
        table{
            width: 600px;
        }
        th{
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
    <script src="jquery.js"></script>
    <script>
        $(document).ready(function () {
            
        });
    </script>
</head>
<body>
    <div class="header">
        <h3 style="margin-top:10px;">Welcome Admin</h3>
    </div>
    <div class="nav">
        <a href=""><div class="nav-text"><p>Mahasiswa</p></div></a>
        <a href=""><div class="nav-text"><p>Dosen</p></div></a>
        <a href=""><div class="nav-text"><p>Jurusan</p></div></a>
        <a href=""><div class="nav-text"><p>Kurikulum</p></div></a>
        <a href=""><div class="nav-text"><p>Mata Kuliah</p></div></a>
    </div>
    <div class="content">
        <div id="col-kiri">
            <div id=content-kiri>
                <form action="#" method="post">
                    <p>NRP:</p><input type="text" name="nrp" id="nrp">
                    <p>Nama:</p><input type="text" name="nama" id="nama">
                    <p>NRP:</p>
                    <select name="dosen" id="selector">
                        <option value ="">Pilih Dosen</option>
                        <?php
                            $query = "SELECT * FROM Dosen WHERE Dosen_Jabatan = 'Dosen Wali'";
                            $listdosen = $con->query($query);
                            foreach ($listdosen as $key => $value) {
                                echo "<option value ='$value[Dosen_ID]'>$value[Dosen_ID]"."-"."$value[Dosen_Nama]</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Insert" name="btnInsert">
                </form>
            </div>
        </div>
        <div id="col-kanan">
            <div id="content-kanan">
                <center><h4>Data Mahasiswa</h4></center>
                <table border="1">
                    <tr>
                        <th rowspan="2">NRP</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Dosen Wali</th>
                        <th rowspan="2">NRP</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="footer">
        <p style="margin: 0px;">Jalan Kupang Baru 1 No 95</p>
        <p style="margin: 0px;">Contact Us +6287855161565</p>
    </div>
</body>
</html>