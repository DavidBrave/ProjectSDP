<?php
    session_start();
    require_once("conn.php");
    if(isset($_POST['btnLogin'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $query = "SELECT * FROM Administrator";
        $listadmin = $conn->query($query);
        foreach ($listadmin as $key => $value) {
            if($user == $value['Admin_Nama']){
                if($pass == $value['Admin_Pass']){
                    $_SESSION['user']['name'] = $user;
                    $_SESSION['user']['pass'] = $pass;
                    header("location: Admin/Admin.php");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="user">
        <input type="text" name="pass">
        <input type="submit" value="Login" name="btnLogin">
    </form>
</body>
</html>