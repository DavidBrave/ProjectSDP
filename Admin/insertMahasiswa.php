<?php
    require_once('../Required/Connection.php');
    session_start();

    if(isset($_POST['nrp'])){
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $dosen = $_POST['dosen'];
        $tgl = $_POST['tgl'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $agama = $_POST['agama'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $pass = $_POST['pass'];
        $photo = $_POST['photo'];

        //Validate
        $validate = false;
        $simpanhp = true;
        if ($tanggal == "") {
            $_SESSION['validate']['mahasiswa']['tanggal'] = "Tanggal harus diisi";
            $validate = true;
        }
        if ($nama == "") {
            $_SESSION['validate']['mahasiswa']['nama'] = "Nama harus diisi";
            $validate = true;
        }
        if ($alamat == "") {
            $_SESSION['validate']['mahasiswa']['alamat'] = "Alamat harus diisi";
            $validate = true;
        }
        if ($agama == "") {
            $_SESSION['validate']['mahasiswa']['agama'] = "Agama harus diisi";
            $validate = true;
        }
        if ($jk == "") {
            $_SESSION['validate']['mahasiswa']['jk'] = "Jenis Kelamin harus diisi";
            $validate = true;
        }
        if ($nohp == "") {
            $_SESSION['validate']['mahasiswa']['nohp'] = "Nomor HP harus diisi";
            $validate = true;
        }
        if (!is_numeric($nohp)) {
            $_SESSION['validate']['mahasiswa']['nohp'] = "Nomor HP harus berupa angka";
            $validate = true;
            $simpanhp = false;
        }
        if ($email == "") {
            $_SESSION['validate']['mahasiswa']['email'] = "Email harus diisi";
            $validate = true;
        }
        if ($jurusan == "") {
            $_SESSION['validate']['mahasiswa']['jurusan'] = "Jurusan harus diisi";
            $validate = true;
        }
        if ($provinsi == "") {
            $_SESSION['validate']['mahasiswa']['provinsi'] = "Provinsi harus diisi";
            $validate = true;
        }
        if ($kota == "") {
            $_SESSION['validate']['mahasiswa']['kota'] = "Kota harus diisi";
            $validate = true;
        }

        if ($validate) {
            $_SESSION['temp']['mahasiswa']['tanggal'] = $tanggal;
            $_SESSION['temp']['mahasiswa']['nama'] = $nama;
            $_SESSION['temp']['mahasiswa']['alamat'] = $alamat;
            $_SESSION['temp']['mahasiswa']['agama'] = $agama;
            $_SESSION['temp']['mahasiswa']['jk'] = $jk;
            $_SESSION['temp']['mahasiswa']['email'] = $email;
            $_SESSION['temp']['mahasiswa']['jurusan'] = $jurusan;
            $_SESSION['temp']['mahasiswa']['provinsi'] = $provinsi;
            $_SESSION['temp']['mahasiswa']['kota'] = $kota;

            if ($simpanhp) {
                $_SESSION['temp']['mahasiswa']['nohp'] = $nohp;
            }
            echo 0;
        }
        else {
            $query = "INSERT INTO Mahasiswa VALUES ('$nrp','$dosen','','$nama','$jk','$alamat','$tgl','$agama','$email','$nohp','$pass','$photo')";
            $conn->query($query);
    
            if($conn){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    $conn->close();
?>