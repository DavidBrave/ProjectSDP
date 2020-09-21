<?php
    require_once('../Required/Connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <table>

    <?php
        $sql = 'SELECT * FROM Dosen';
        $result = mysqli_query($con, $sql);

        if (!$result || mysqli_num_rows($result) > 1) {
            echo('<tr>');
            echo('<th>ID</th>');
            echo('<th>Nama Lengkap</th>');
            echo('<th>Username</th>');
            echo('<tr>');

            while ($dosen = mysqli_fetch_assoc($result)) {
                $str = (string) $dosen["Dosen_ID"];
                if (strlen($str) > 3) {
                    
                    echo('<tr>');
                    echo('<td>'.$dosen["Dosen_ID"].'</td>');
                    echo('<td>'.$dosen["Dosen_Nama"].'</td>');
                    echo('<td>'.$dosen["Dosen_User"].'</td>');
                    echo('<tr>');

                }
            }
        }

        

    ?>
    </table>
    
</body>
</html>




