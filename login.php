<?php
    session_start();
    require_once("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <style>
        body{
            background-image: url("Image/pink.jpg");
        }
        #container-login{
            width: 400px;
            height: 500px;
            background-color: white;
            margin: auto;
            margin-top: 200px;
            text-align: center;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="row" id="container-login">
        <form class="col s12" style="padding: 50px;" method="post">
            <h3 style="margin: 0px;">LOGIN</h3><br>
            <?php
                if(isset($_POST['btnLogin'])){
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
            
                    $query = "SELECT * FROM Administrator";
                    $listadmin = $conn->query($query);
                    foreach ($listadmin as $key => $value) {
                        if($user == $value['Admin_ID']){
                            if($pass == $value['Admin_Pass']){
                                $_SESSION['user']['user'] = $value['Admin_ID'];
                                $_SESSION['user']['name'] = $value['Admin_Nama'];
                                $_SESSION['user']['pass'] = $value['Admin_Pass'];
                                header("location: Admin/Admin.php");
                            }else{
                                echo "NRP / Password yang anda masukkan salah";
                            }
                        }
                    }
                }
            ?>
            <div class="row">
                <div class="input-field col s12">
                    <label for="user">Name</label><br>
                    <input name="user" type="text">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="pass">Password</label><br>
                    <input name="pass" type="password">
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="btnLogin">Login</button>
            </div>
        </form>
    </div>
</body>
</html>