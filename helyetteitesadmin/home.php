<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./helyettesites/icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Hiányregisztrálás</title>
    <?php 
    include 'maindbcfg.php';
    if(!isset($_SESSION['uname'])){
        header('Location: index.php');
    }
    if(isset($_POST['btn_logout'])){
        session_destroy();
        header('Location: index.php');
    }
    if(isset($_GET['open'])){
        if($_GET['open'] == 'Helyettesítés'){
            echo '<style>.helyettesites{display:block;}#btn_helyettesites{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Teremcsere'){
            echo '<style>.teremhely{display:block;}#btn_teremcsere{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Hír'){
            echo '<style>.hir{display:block;}#btn_news{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Fiókkészítés'){
            echo '<style>.accountreg{display:block;}#btn_accreg{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Törlés'){
            echo '<style>.tanartabla{display:block;} #btn_delete{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Tv hír regisztálás'){
            echo '<style>.tvnews{display:block;} #btn_tv{background-color:#00000040;}</style>';
        }
        if($_GET['open'] == 'Exportálás'){
            echo '<style>.export{display:block;} #btn_exp{background-color:#00000040;}</style>';
        }
    }
    if(isset($_GET['error'])){
        if($_GET['error'] == "EmptyDate"){
            echo "<div class='error'>Kell választani egy napot</div>";
        }
        if($_GET['error'] == "sqlerror"){
            echo "<div class='error'>Databázis Hiba</div>";
        }
        if($_GET['error'] == "terem1"){
            echo "<div class='error'>Nem választható ugyan az a terem amit helyettesíteni kell</div>";
        }
        if($_GET['error'] == "njbh"){
            echo "<div class='error'>Nem tud nem bejönni és hazamenni egyszerre</div>";
        }
        if($_GET['error'] == "tanar1"){
            echo "<div class='error'>Nem tudja magát helyettesíteni</div>";
        }
        if($_GET['error'] == "databaseerror"){
            echo "<div class='error'>Adatbázis Hiba</div>";
        }
    }
    if(isset($_GET['s'])){
        $_SESSION['special'] = $_GET['s'];
    }
    else{
        $_SESSION['special'] ="nothin";
    }
    ?>
    <style>#id{background-color: white; color: black; border: none;}</style>
</head>
<body>
    <header>
        <!-- <img src="./icon.png" alt=""> -->
        <div class="logout">
            <form action="" method="post">
                <input type="submit" name="btn_logout" value="Kilépés" id="btn_logout">
            </form>
        </div>
    </header>


    <!-- menü -->



    <div class="menudiv">
    <form action="" method="get" class="menu">
        <input type="submit" name="open" value="Helyettesítés" class="menubutton" id="btn_helyettesites">
        <input type="submit" name="open" value="Teremcsere" class="menubutton" id="btn_teremcsere">
        <input type="submit" name="open" value="Hír" class="menubutton" id="btn_news">
        <input type="submit" name="open" value="Törlés" class="menubutton" id="btn_delete">
        <input type="submit" name="open" value="Fiókkészítés" class="menubutton" id="btn_accreg">
        <input type="submit" name="open" value="Tv hír regisztálás" class="menubutton" id="btn_tv">
        <input type="submit" name="open" value="Exportálás" class="menubutton" id="btn_exp">
    </form>
    </div>


    <!-- Tanár helyettesítés -->

    <div class="helyettesites">
        <form action="tanreg.php" method="post" class="hideed">
            <?php 
                echo '<input type="date" name="napok" id="napok" min="'.date("Y-m-d").'" value="'.date("Y-m-d").'">';
            ?>
            <label for="tname">Helyettesítendő tanár</label><br>
            <select name="tname" id="tname">
            <?php
                $sqlcommandteachersellect = "SELECT * FROM `tanarok` WHERE 1 ORDER BY tanar ASC";
                $result = mysqli_query($maindb,$sqlcommandteachersellect);
                while($row = $result->fetch_assoc()){
                        echo '<option value="'. $row['tanar'].'">'. $row['tanar'].'</option>';
                }
            ?>    
            </select>

            <label for="ora">Óra</label><br><br><br>    
            <div class="oralist">
                <?php 
                for($i = 1; $i <= 16; $i++){
                    echo '<input type="checkbox" name="'.$i.'helyettesites" class="btn-check" id="btn-check'.$i.'" autocomplete="off" /><label class="btn btn-primary" for="btn-check'.$i.'">'.$i.'. óra</label>';
                }
                ?>
            </div>
            <label for="class">Osztály</label><br>
            <select name="class" id="class">
                <?php
                    $slrequcalssrequest = "SELECT * FROM `class` WHERE 1";
                    $classes = mysqli_query($maindb, $slrequcalssrequest);
                    while($row = $classes ->fetch_assoc()){
                        echo '<option value="'. $row['class'].'">'. $row['class'].'</option>'; 
                    };
                ?>
            </select>
            <div class="tulajdonsagok">
                <?php 
                if(isset($_GET['s'])){
                    if($_GET['s']=="njb"){
                        echo '<a href="?open=Helyettesítés" class="btn btn-primary" id="njb">Nem Jön be</a>
                        <a href="?open=Helyettesítés&s=haza" class="btn btn-primary" id="haza">Haza</a>
                    <a href="?open=Helyettesítés&s=ovh" class="btn btn-primary" id="ovhi">Összevont Óra</a>';
                        echo '<style>#njb{background-color: white; color: black; border: none;}</style>';
                    }
                    if($_GET['s']=="haza"){
                        echo '<a href="?open=Helyettesítés&s=njb" class="btn btn-primary" id="njb">Nem Jön be</a>';
                        echo '<a href="?open=Helyettesítés" class="btn btn-primary" id="haza">Haza</a>';
                        echo '<a href="?open=Helyettesítés&s=ovh" class="btn btn-primary" id="ovhi">Összevont Óra</a>';
                        echo '<style>#haza{background-color: white; color: black; border: none;}</style>';
                    }
                    if($_GET['s']=="ovh"){
                        echo '<a href="?open=Helyettesítés&s=njb" class="btn btn-primary" id="njb">Nem Jön be</a>';
                        echo '<a href="?open=Helyettesítés&s=haza" class="btn btn-primary" id="haza">Haza</a>';
                        echo '<a href="?open=Helyettesítés" class="btn btn-primary" id="ovhi">Összevont Óra</a>';
                        echo '<style>#ovhi{background-color: white; color: black; border: none;}</style>';
                    }
                }else{
                    echo '<a href="?open=Helyettesítés&s=njb" class="btn btn-primary" id="njb">Nem Jön be</a>
                    <a href="?open=Helyettesítés&s=haza" class="btn btn-primary" id="haza">Haza</a>
                    <a href="?open=Helyettesítés&s=ovh" class="btn btn-primary" id="ovhi">Összevont Óra</a>';
                }
                ?>
            </div>
            <?php 
            if(isset($_GET['s'])){
                if($_GET['s'] =="njb" or $_GET['s']=="haza"){
                    
                }else{
                    echo '<label for="helytan">Helyettesítő tanár</label><br><select name="helytan" id="helytan">';
                $sqlcommandteachersellect = "SELECT * FROM `tanarok` WHERE 1 ORDER BY tanar ASC";
                $result = mysqli_query($maindb,$sqlcommandteachersellect);
                while($row = $result->fetch_assoc()){
                    echo '<option value="'. $row['tanar'].'">'. $row['tanar'].'</option>';
                }
                echo '</select><label for="terem">Terem</label><br><select name="terem" id="terem">';
                $sqlcommandteachersellect = "SELECT * FROM `termek` WHERE 1";
                $result = mysqli_query($maindb,$sqlcommandteachersellect);
                while($row = $result->fetch_assoc()){
                    echo '<option value="'. $row['terem'].'">'. $row['terem'].'</option>';
                }
                echo '</select>';
                }
            }
            else{
                echo '<label for="helytan">Helyettesítő tanár</label><br><select name="helytan" id="helytan">';
                $sqlcommandteachersellect = "SELECT * FROM `tanarok` WHERE 1 ORDER BY tanar ASC";
                $result = mysqli_query($maindb,$sqlcommandteachersellect);
                while($row = $result->fetch_assoc()){
                    echo '<option value="'. $row['tanar'].'">'. $row['tanar'].'</option>';
                }
                echo '</select><label for="terem">Terem</label><br><select name="terem" id="terem">';
                $sqlcommandteachersellect = "SELECT * FROM `termek` WHERE 1";
                $result = mysqli_query($maindb,$sqlcommandteachersellect);
                while($row = $result->fetch_assoc()){
                    echo '<option value="'. $row['terem'].'">'. $row['terem'].'</option>';
                }
                echo '</select>';
            }
            ?>        
            <input type="submit" value="Regisztrálás" name="btn_tanreg" class="reg-button">
        </form>
    </div>


    <!-- Terem Helyettesítés -->


    <div class="teremhely">
        <form action="temreg.php" method="post" class="hideed">
            <?php 
                echo '<input type="date" name="teremnapok" id="teremnapok" min="'.date("Y-m-d").'" value="'.date("Y-m-d").'">';
            ?>
            <label for="teremh">Ezt:</label><br>
            <select name="teremh" id="teremh">
                <?php
                    $sqlcommandteachersellect = "SELECT * FROM `termek` WHERE 1";
                    $result = mysqli_query($maindb,$sqlcommandteachersellect);
                    while($row = $result->fetch_assoc()){
                        echo '<option value="'. $row['terem'].'">'. $row['terem'].'</option>';
                    }
                ?> 
            </select>
            <label for="teremhe">Erre:</label>
            <select name="teremhe" id="teremhe">
                <?php
                    $sqlcommandteachersellect = "SELECT * FROM `termek` WHERE 1";
                    $result = mysqli_query($maindb,$sqlcommandteachersellect);
                    while($row = $result->fetch_assoc()){
                        echo '<option value="'. $row['terem'].'">'. $row['terem'].'</option>';
                    }
                ?>
            </select>
            <label for="teremora">Óra</label><br><br><br>
            <div class="oralist">
             <?php 
                for($i = 1; $i <= 16; $i++){
                    echo '<input type="checkbox" name="'.$i.'teremora" class="btn-check" id="btn-checkterem'.$i.'" autocomplete="off" />';
                    echo '<label class="btn btn-primary" for="btn-checkterem'.$i.'">'.$i.'. óra</label>';
                }
            ?>
            </div>
            <label for="teremclass">Osztály</label><br>
            <select name="teremclass" id="teremclass">
                <?php
                $slrequcalssrequest = "SELECT * FROM `class` WHERE 1";
                $classes = mysqli_query($maindb, $slrequcalssrequest);
                while($row = $classes ->fetch_assoc()){
                    echo '<option value="'. $row['class'].'">'. $row['class'].'</option>'; 
                };
                ?>
            </select>
            <input type="submit" value="Regisztrálás" name="btn_terreg">
        </form>
    </div>



    <!-- Hír -->



    <div class="hir">
        <form action="alertreg.php" method="post" class="hideed">
            <?php 
                echo '<input type="date" name="alertday" id="alertday" min="'.date("Y-m-d").'" value="'.date("Y-m-d").'">';
            ?><br>
            <label for="alert">Szöveg</label>
            <input type="text" name="alerttext" id="alert">
            <input type="submit" value="Regisztálás">
        </form>
    </div>



    <!--Tölrő blokk-->



    <div class="tanartabla">
    <?php 
        echo 'Teremcserék:<br>';
        $tempsqlrequest = "SELECT * FROM `days` WHERE day >= '".date("Y.m.d")."' AND tipus='terem'";
        $temphianyzasok = mysqli_query($maindb, $tempsqlrequest);
        while($row = $temphianyzasok ->fetch_assoc()){
            echo '<form action="delete.php" method="post">';
            echo '<div class="data">';
            echo '<div>'.$row['tname'].'</div><div>'.$row['terem'].'</div><div>'.$row['ora'].'</div><div>'.$row['class'].'</div><div>'.$row['day'].'</div>';
            echo '<input type="submit" name="" value="Törlés">';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo "</div>";
            echo '</form>';
        }
        echo 'Helyettesítések:<br>';
        $tempsqlrequest = "SELECT * FROM `days` WHERE day >= '".date("Y.m.d")."' AND tipus='tanar'";
        $temphianyzasok = mysqli_query($maindb, $tempsqlrequest);
        while($row = $temphianyzasok ->fetch_assoc()){
            echo '<form action="delete.php" method="post">';
            echo '<div class="data">';
            echo '<div>'.$row['tname'].'</div><div>'.$row['ora'].'</div><div>'.$row['helytan'];
            if ($row['ovh']>0){
                echo " ÖVH";
            }
            echo '</div><div>'.$row['terem'].'</div><div>'.$row['class']."</div><div>".$row['day'].'</div>';
            echo '<input type="submit" name="" value="Törlés">';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo "</div>";
            echo '</form>';
        }
        echo 'Hírek/közlendők<br>';
        $sqlalertrequest = "SELECT * FROM `days` WHERE day >= '".date("Y.m.d")."' AND tipus='alert'";
        $dailyalerts = mysqli_query($maindb, $sqlalertrequest);
        while($row = $dailyalerts ->fetch_assoc()){
            echo '<form action="delete.php" method="post">';
            echo '<div class="data">';
            echo '<div>'.$row['alert'].'</div>';
            echo '<div>'.$row['day'].'</div>';
            echo '<input type="submit" name="" value="Törlés">';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo "</div>";
            echo '</form>';
        }
        echo 'Tv hír<br>';
        $sqlalertrequest = "SELECT * FROM `days` WHERE tipus='tvhir'";
        $dailyalerts = mysqli_query($maindb, $sqlalertrequest);
        while($row = $dailyalerts ->fetch_assoc()){
            echo '<form action="delete.php" method="post">';
            echo '<div class="data">';
            echo '<div>'.$row['alert'].'</div>';
            echo '<div>'.$row['day'].'</div>';
            echo '<input type="submit" name="" value="Törlés">';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo "</div>";
            echo '</form>';
        }
    ?>
    </div>

    


    <!-- Tv hír Regisztrálás -->

    

    <div class="tvnews">
        <form action="tvnews.php" method="post" class="hideed">
            <?php 
                echo '<input type="date" name="tvnapok" id="tvnapok" min="'.date("Y-m-d").'" value="'.date("Y-m-d").'">';
            ?><br>
            <label for="tvtext">Szöveg</label>
            <input type="text" name="tvtext" id="tvtext">
            <input type="submit" value="Regisztrálás">
        </form>
    </div>



    <!-- Fiók regisztálás -->




    <div class="accountreg">
        <?php
            if(isset($_POST['btn_accreg'])){
                $pw = crypt(CRYPT_BLOWFISH,$_POST['passw']);
                $sqlregcommand = "INSERT INTO `login`(`uname`, `passw`) VALUES ('".$_POST['uname']."','".$pw."')";
                if(mysqli_query($maindb,$sqlregcommand)){
                }
            }
        ?>
        <form action="" method="post" class="hideed">
            <label for="uname">Felhasználónév</label><br>
            <input type="text" name="uname" id="uname">
            <label for="passw">Jelszó</label><br>
            <input type="text" name="passw" id="passw">
            <input type="submit" value="Regisztrálás" name="btn_accreg" class="reg-button">
        </form>
    </div>
     

    <!-- Exportálás -->

    <div class="export">
        <form action="export/export.php" method="post" class="hideed" target="_blank">
            <?php 
                echo '<input type="date" name="exportday" id="exportday" max="'.date("Y-m-d").'" value="'.date("Y-m-d").'">';
            ?><br>
            <input type="submit" value="Exportálás">
        </form>
    </div>

    <footer>
        <div class="copy">Copyright &copy; 2022</div>
    </footer>
</body>
</html>