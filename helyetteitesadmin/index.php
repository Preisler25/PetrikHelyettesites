<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>főoldal</title>
</head>
<?php
    include 'maindbcfg.php';
    if(isset($_POST['btn_login'])){
        $uname = $_POST['username'];
        $password = crypt(CRYPT_BLOWFISH,$_POST['password']);
        if ($uname != "" && $password != ""){
            $sql_query = "select count(*) as cntUser from login where uname='".$uname."' and passw='".$password."'";
            $result = mysqli_query($maindb,$sql_query);
            $row = mysqli_fetch_array($result);
            $count = $row['cntUser'];
            if($count > 0){
                $_SESSION['uname'] = $uname;
                header('Location: home.php');
            }else{
                echo '
                <div class="hiba" onclick="hibaclose() id="hibaa"> Hibás jelszó vagy Felhasználónév </div>
                ';
            }
        }
    }
?>
<body>
<div class="login">
    <form action="" method="post">
        <label for="uname">Felhasználónév</label>
        <input type="text" name="username" id="uname">
        <label for="pw">Jelszó</label>
        <input type="password" name="password" id="pw">       
        <input type="submit" value="Bejelentkezés" name="btn_login" id="btn_lng">
    </form>
</div>
</body>
</html>