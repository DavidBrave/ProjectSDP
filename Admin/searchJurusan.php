<?php
    session_start();
    require_once('../Required/Connection.php');
    $jurusan = $_POST['jurusan'];
    $query = "SELECT avg(mk.SKS) FROM Mahasiwa m,Pengambilan p,Kelas k,Matkul_Kurilulum mk WHERE Mahasiswa_Jurusan=$jurusan AND m.Mahasiswa_ID=p.Mahasiswa_ID AND p.Kelas_ID=k.Kelas_ID AND k.MatkulKurikulum_ID=mk.Matkul_Kurikulum_ID";
    $_SESSION['report']['sksJurusan']=$conn->query($query);
    $query = "SELECT avg(p.Nilai_Akhir) FROM Mahasiwa m,Pengambilan p,Kelas k,Matkul_Kurilulum mk WHERE Mahasiswa_Jurusan=$jurusan AND m.Mahasiswa_ID=p.Mahasiswa_ID AND p.Kelas_ID=k.Kelas_ID AND k.MatkulKurikulum_ID=mk.Matkul_Kurikulum_ID";
    $_SESSION['report']['ipkJurusan']=$conn->query($query);
    if($conn){
        echo "1";
    }else{
        echo "0";
    }

    $conn->close();
?>
