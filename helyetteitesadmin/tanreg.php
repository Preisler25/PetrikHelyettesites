<?php
session_start();
include 'maindbcfg.php';
$tname = $_POST['tname'];
$helytan = $_POST['helytan'];
$terem = $_POST['terem'];
$counter = 0;
$class = $_POST['class'];
$lessonsList = array();
$special = $_SESSION['special'];
for($i = 1; $i <= 16; $i++){
    if(isset($_POST[$i."helyettesites"])){
        array_push($lessonsList, $i);
    }
}

if($_POST['napok'] != ""){
    $dayl = explode("-",$_POST['napok']);
    $day =  $dayl[0].".".$dayl[1].".".$dayl[2];
    if($special != "nothin"){
        if($special == "haza"){
            for($x=0; $x<=count($lessonsList)-1; $x++){
                $ora = $lessonsList[$x].".óra";
                $sqlimportcommand = "INSERT INTO `days` (`tname`, `ora`, `helytan`, `terem`, `class`, `tipus`, `day`)    VALUES ('". $tname. "','". $ora. "','-','Haza','". $class. "','tanar', '". $day. "')";
                if(mysqli_query($maindb, $sqlimportcommand)){
                    $counter++;
                }
            }
        }
        if($special == "njb"){
            for($x=0; $x<=count($lessonsList)-1; $x++){
                $ora = $lessonsList[$x].".óra";
                $sqlimportcommand = "INSERT INTO `days` (`tname`, `ora`, `helytan`, `terem`, `class`, `tipus`, `day`)    VALUES ('". $tname. "','". $ora. "','-','Nem Jön Be','". $class. "','tanar', '". $day. "')";
                if(mysqli_query($maindb, $sqlimportcommand)){
                    $counter++;
                }
            }
        }
        if($special == "ovh"){
            for($x=0; $x<=count($lessonsList)-1; $x++){
                $ora = $lessonsList[$x].".óra";
                $sqlimportcommand = "INSERT INTO `days` (`tname`, `ora`, `helytan`, `terem`, `class`, `ovh`,`tipus`, `day`)    VALUES ('". $tname. "','". $ora. "','". $helytan. "','". $terem. "','". $class. "','1','tanar', '". $day. "')";
                if(mysqli_query($maindb, $sqlimportcommand)){
                    $counter++;
                }else{
                    header('location:home.php?open=Helyettesítés&error=databaseerror');
                }
            }
        }
        if($special != "njb" && $special != "haza" && $special != "ovh"){
            header('location:home.php?open=Helyettesítés&error=requesterror');
        }
    }else{
        if($tname == $helytan){
            header('location:home.php?open=Helyettesítés&error=tanar1');
        }else{
            for($x=0; $x<=count($lessonsList)-1; $x++){
                $ora = $lessonsList[$x].".óra";
                $sqlimportcommand = "INSERT INTO `days` (`tname`, `ora`, `helytan`, `terem`, `class`, `ovh`,`tipus`, `day`)    VALUES ('". $tname. "','". $ora. "','". $helytan. "','". $terem. "','". $class. "','0','tanar', '". $day. "')";
                if(mysqli_query($maindb, $sqlimportcommand)){
                    $counter++;
                }else{
                    header('location:home.php?open=Helyettesítés&error=databaseerror');
                }
            }
        }
    }
}else{
    header('location:home.php?open=Helyettesítés&error=EmptyDate');
}
if($counter == count($lessonsList)){
    header('location:home.php?open=Helyettesítés');
}