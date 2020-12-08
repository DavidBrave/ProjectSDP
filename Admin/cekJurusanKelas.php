<?php
    session_start();
    require_once('../Required/Connection.php');

    $id = $_POST['id'];
    //Periode Sekarang
    // $tahun1 = date("Y");
    // $tahun2 = $tahun1 + 1;
    // $bulan = date("m");
    // $periodeID = $tahun1 . $tahun2;
    // if ($bulan >= 8 && $bulan <= 12 || $bulan == 1) {
    //     $periodeID = $periodeID . "11";
    // } else if ($bulan >= 2 && $bulan <= 7) {
    //     $periodeID = $periodeID . "21";
    // }
    $query = "SELECT * FROM Jadwal_Pengisian_FRS WHERE id = 1";
    $periode = mysqli_fetch_array($conn->query($query));
    $periodeID = $periode['Periode_ID'];

    $query = "SELECT kls.Kelas_ID, kls.Kelas_Nama, kls.Matkulkurikulum_ID, mk.Matkul_Nama, j.Jurusan_Nama, kls.Kelas_Ruangan, kls.Kelas_Kapasitas 
        FROM Kelas kls, Matkul_Kurikulum mkl, Matkul mk, Jurusan j
        WHERE kls.Matkulkurikulum_ID = mkl.Matkul_Kurikulum_ID AND mkl.Matkul_ID = mk.Matkul_ID AND mkl.Jurusan_ID = j.Jurusan_ID AND mkl.Periode_ID = '$periodeID' AND mkl.Jurusan_ID = '$id'";
?>
<script>
    $(document).ready(function() {
        $('select').material_select();

        $('#kelas').change(function() {
            $.ajax({
                method: 'post',
                url: 'daftarAmbilMahasiswa.php',
                data: {
                    id: $('#kelas').val()
                },
                success: function(hasil) {
                    $("#content-mahasiswa").html(hasil);
                    $("#temp").hide();
                }
            });
        });
    });
</script>

<select name="kelas" id="kelas">
    <option value="none" disabled selected>Pilih Kelas</option>
    <?php
    $listKelas = $conn->query($query);
    foreach ($listKelas as $key => $value) {
        echo "<option value='$value[Kelas_ID]'>[ " . $value['Kelas_Nama'] . " ] " . $value['Matkul_Nama'] . " - " . $value['Kelas_Ruangan'] . " - " . $value['Kelas_Kapasitas'] . "</option>";
    }
    ?>
</select>