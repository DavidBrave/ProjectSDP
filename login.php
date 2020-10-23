<?php
    session_start();
    require_once('Required/Connection.php');
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
            background-color: #1b7fbd;
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
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script>
        function TogglePassword() { 
            var input_password = document.getElementById("password"); 
            if (input_password.type === "password") { 
                input_password.type = "text";
                document.getElementById("text_showHide").innerHTML = "Hide Password";
            } 
            else { 
                input_password.type = "password";
                document.getElementById("text_showHide").innerHTML = "Show Password";
            } 
        } 
    </script>
</head>
<body>
    <div class="row" id="container-login">
        <form class="col s12" style="padding: 50px;" method="post">
            <h3 style="margin: 0px;">LOGIN</h3><br>
            <div class="row">
                <div class="input-field col s12">
                    <label for="user">Nrp</label><br>
                    <input name="user" type="text" id="username">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="pass">Password</label><br>
                    <input name="pass" type="password" id="password">
                </div>
            </div>
            <?php
                if(isset($_POST['btnLogin'])){
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $cekAdmin = false;
                    $cekDosen = false;
                    $cekMahasiswa = false;
            
                    $query = "SELECT * FROM Administrator";
                    $listadmin = $conn->query($query);
                    foreach ($listadmin as $key => $value) {
                        if($user == $value['Admin_ID'] && $pass == $value['Admin_Pass']){
                            $_SESSION['user']['user'] = $value['Admin_ID'];
                            $_SESSION['user']['name'] = $value['Admin_Nama'];
                            $_SESSION['user']['pass'] = $value['Admin_Pass'];
                            $cekAdmin = true;
                        }
                    }

                    $query = "SELECT * FROM Mahasiswa";
                    $listmahasiswa = $conn->query($query);
                    foreach ($listmahasiswa as $key => $value) {
                        if($user == $value['Mahasiswa_ID'] && $pass == $value['Mahasiswa_Pass']){
                            $_SESSION['user']['user'] = $value['Mahasiswa_ID'];
                            $_SESSION['user']['name'] = $value['Mahasiswa_Nama'];
                            $_SESSION['user']['pass'] = $value['Mahasiswa_Pass'];
                            $_SESSION['user']['photo'] = $value['Mahasiswa_Photo'];
                            $cekMahasiswa = true;
                        }
                    }

                    $query = "SELECT * FROM Dosen";
                    $listdosen = $conn->query($query);
                    foreach ($listdosen as $key => $value) {
                        if($user == $value['Dosen_User'] && $pass == $value['Dosen_Pass']){
                            $_SESSION['user']['user'] = $value['Dosen_ID'];
                            $_SESSION['user']['name'] = $value['Dosen_Nama'];
                            $_SESSION['user']['pass'] = $value['Dosen_Pass'];
                            $_SESSION['user']['photo'] = $value['Dosen_Photo'];
                            $cekDosen = true;
                        }
                    }

                    if($cekAdmin){
                        header("location: Admin/Admin.php");
                    }else{
                        if($cekMahasiswa){
                            header("location: Mahasiswa/Home.php");
                        }else{
                            if($cekDosen){
                                header("location: Dosen/Home.php");
                            }else{
                                echo "<label style='color: red;'>NRP / Password yang anda masukkan salah</label>";
                            }
                        }
                    }
                }
            ?>
            <div style="float: left;">
                <input type="checkbox" id="hide_pass" onclick="TogglePassword()">
                <label for="hide_pass"><b id="text_showHide">Show Password</b></label>
            </div>
            <br><br><br>
            <div class="row">
                <button class="btn waves-effect blue darken-4" type="submit" name="btnLogin" id="btnLogin" style="border-radius: 5px;">Login</button>
            </div>
        </form>
    </div>
</body>
</html>