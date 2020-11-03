<?php
    session_start();
    require_once("../Required/Connection.php");
    
    $matkuls = $_POST['matkuls'];
    $maxSks = $_POST['maxSks'];
    for ($i=0; $i < count($matkuls); $i++) { 
        $query = "SELECT * FROM Matkul_Kurikulum WHERE Matkul_Kurikulum_ID = '$matkuls[$i]'";
        $listMatkul = mysqli_fetch_array($conn->query($query));
        $maxSks = $maxSks - $listMatkul['SKS'];
    }
    $_SESSION['hasil'] = $maxSks;
    echo "$maxSks";
?>