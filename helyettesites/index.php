<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiányzások</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./icon.png" type = "image/x-icon">
    <script src="script.js"></script>
    <style>
        .subdata{
            float:left;
            padding:10px;
            /* koczka based; 
            vicc... ;
             tényleg vicc */
        }
    </style>
    <?php  
        $host = "localhost";
        $username = "root";
        $pass = "";
        $db = "helyettesites";
        $conn = mysqli_connect($host, $username, $pass, $db);
        echo mysqli_error($conn);
    ?>
</head>
<body>
    <header>
        <img src="icon.png" onclick="mainpage()">
        <!--<div class="search">
            <input type="search" class="searchTerm" placeholder="Osztály">
                Magas hegyek mögött
                hol a tenger hupikék
                ott laknak ők a törpikék
                Hatalmas fák között
                gombaházakban lakunk
           
        </div> -->
   </header>
    <?php  
        $tomorrow = date('Y.m.d', strtotime('+1day'));
        $today = date('Y.m.d');
        $weekday=Array(7);
        $weekday[0]="Vasárnap";
        $weekday[1]="Hétfő";
        $weekday[2]="Kedd";
        $weekday[3]="Szerda";
        $weekday[4]="Csütörtök";
        $weekday[5]="Péntek";
        $weekday[6]="Szombat";
    ?>
    <div class="content">
    <!--Touch some grass, kid. -A.M.-->
    <!-- Mai nap -->
    <?php 
      echo '<div class="datum ma">'. $today."-".$weekday[date('w')].'</div>';'</div>';
      $sqlrequesttoday = "SELECT * FROM `days` WHERE day = '". $today. "' AND tipus ='tanar' ORDER BY tname, ora ASC; ";
      $sqlrequestteremtoday = "SELECT * FROM`days` WHERE day = '". $today. "' AND tipus ='terem' ORDER BY tname, ora ASC; ";
      $sqlalertrequest = "SELECT * FROM`days` WHERE  day = '". $today. "' AND tipus ='alert'";
      $restoday = mysqli_query($conn,$sqlrequesttoday);
      $resteremtoday = mysqli_query($conn,$sqlrequestteremtoday);
      $resalerttorday = mysqli_query($conn,$sqlalertrequest);
      echo mysqli_error($conn);
      $todayteachers=array();
      if($resalerttorday){
          while($row = $resalerttorday -> fetch_assoc()){
                echo '<div class="hianyzas">';
                echo '<div class="tanarcim">';
                echo $row['alert'];
                echo '</div>';
                echo '</div>';
            }
        }
      if($restoday){
        while($row = $restoday -> fetch_assoc()){
            if(end($todayteachers) != $row['tname'] && count($todayteachers) >= 1){
                echo '</div>';
            }
            if(in_array($row['tname'],$todayteachers)){
            }else{
                echo '<div class="hianyzas">';
                echo '<div class="tanarcim">'.$row['tname'].'</div>';
                array_push($todayteachers,$row['tname']);
            }
            echo '<div class="data">';
            echo '<div class="ora subdata">'.$row['ora'].'</div>';
            echo '<div class="helytan subdata">'.$row['helytan'];
            if($row['ovh'] == "1"){
                echo'ÖVH'.'</div>';
            }else{
                echo '</div>';
            }
            echo '<div class="terem subdata">'.$row['terem'].'</div>';
            echo '<div class="osztaly subdata">'. $row['class'].'</div>';
            echo '</div>';
        }
        if(!empty($todayteachers)){
            echo '</div>';
        }
        if (mysqli_num_rows($resteremtoday) > 0) {
            echo '<div class="teremcserekcim">Teremcserék</div>';
        }
        if($resteremtoday){
            while($row = $resteremtoday -> fetch_assoc()){
              echo '<div class="hianyzas">';
              echo '<div class="data">';
              echo '<div class="subdata">'.$row['tname'].'</div>';
              echo '<div class="subdata">'.$row['terem'].'</div>';
              echo '<div class="subdata">'.$row['ora'].'</div>';
              echo '<div class="subdata">'.$row['class'].'</div>';
              echo '</div>';
              echo '</div>';
            }
        }
      }
    ?>
    <!-- Holnapi nap -->
    <!--"izé igazából én egy back-end develooper vagyok"-B.M. -->
    <div class="holnap">
    <?php 
      if(date('w')+1>6){
        echo '<div class="datum holnap">'. $tomorrow."-".$weekday[0].'</div>';
      }else{
      echo '<div class="datum holnap">'. $tomorrow."-".$weekday[date('w')+1].'</div>';}
      $sqlrequesttomorrow  = "SELECT * FROM`days` WHERE day ='". $tomorrow. "' AND tipus='tanar' ORDER BY tname, ora ASC; ";
      $restomorrow = mysqli_query($conn, $sqlrequesttomorrow);
      $tomorrowteachers = array();
      if($restomorrow){
      while($row = $restomorrow -> fetch_assoc()){
        if(end($tomorrowteachers) != $row['tname'] && count($tomorrowteachers) >= 1){
            echo '</div>';
        }
        if(in_array($row['tname'],$tomorrowteachers)){
        }else{
            echo '<div class="hianyzas">';
            echo '<div class="tanarcim">'.$row['tname'].'</div>';
            array_push($tomorrowteachers,$row['tname']);
        }
        echo '<div class="data">';
        echo '<div class="ora subdata">'.$row['ora'].'</div>';
        echo '<div class="helytan subdata">'.$row['helytan'];
        if($row['ovh'] == "1"){
            echo'ÖVH'.'</div>';
        }else{
            echo '</div>';
        }
        echo '<div class="terem subdata">'.$row['terem'].'</div>';
        echo '<div class="osztaly subdata">'. $row['class'].'</div>';
        echo '</div>';
      }
        if(!empty($tomorrowteachers)){
            echo '</div>';
        }
      }
    ?>
    </div>
</div>
<!--NA mit keresel te itt! figyelj inkább az órádra vagy csináld meg a Matek házid :D tudom hogy Lovasnál 1-es leszel (P.A.)-->
<!--<footer><div class="copy">Auer Máté - Blága Máté - Gyenes Bálint - Preisler András &copy; 2022</div></footer>-->
</body>
</html>