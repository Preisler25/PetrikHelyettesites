<?php 
include 'maindbcfg.php';
if($_POST['alertday'] != ""){
    $dayl = explode("-",$_POST['alertday']);
    $day =  $dayl[0].".".$dayl[1].".".$dayl[2];
    $sqlimportcd ="INSERT INTO `days`(`tipus`, `alert`, `day`) VALUES ('alert','".$_POST['alerttext']."', '".$day."')";
    if(mysqli_query($maindb, $sqlimportcd)){header('location:home.php?open=Hír');}
    else{
        header('location:home.php?open=Hír&error=sqlerror');
    }
}else{
    header('location:home.php?open=Hír&error=EmptyDate');
}