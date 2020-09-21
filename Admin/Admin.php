<?php
    require_once('conn.php');
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
        $query = "select * from admin";
        $listadmin = $conn->query($query);
        foreach ($listadmin as $key => $value) {
            echo "<tr>";
            echo "<td>".$value['admin_id']."</td>";
            echo "<td>".$value['admin_name']."</td>";
            echo "<td>".$value['admin_pass']."</td>";
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>




