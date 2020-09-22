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


<!-- Object Oriented -->
<h1>Object Oriented</h1>
<table>
    <?php
        $query = 'SELECT * FROM Dosen';
        $result = $con_object->query($query);

        if ($result->num_rows > 1) {

            echo('<tr>');
            echo('<th>ID</th>');
            echo('<th>Nama Lengkap</th>');
            echo('<th>Username</th>');
            echo('<tr>');

            while($dosen = $result->fetch_assoc()) {
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

        <!--    $query = "select * from admin";
        $listadmin = $conn->query($query);
        foreach ($listadmin as $key => $value) {
            echo "<tr>";
            echo "<td>".$value['admin_id']."</td>";
            echo "<td>".$value['admin_name']."</td>";
            echo "<td>".$value['admin_pass']."</td>";
            echo "</tr>"; -->

</table>

<br><br>
    
<!-- Procedural -->
<h1>Procedural</h1>
<table>

    <?php
        $query = 'SELECT * FROM Dosen';
        $result = mysqli_query($con_procedural, $query);

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




