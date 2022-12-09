<?php 
include "maindbcfg.php";
$finadate = str_replace("-", ".", $_POST['tvnapok']);
$sqlcdm = "INSERT INTO `days`(`tipus`,`alert`, `day`) VALUES ('tvhir','".$_POST['tvtext']."','".$finadate."')";
if($_POST['tvnapok'] != ""){
    if(mysqli_query($maindb, $sqlcdm)){
        header('location:home.php?open=Tv+hír+regisztálás');
    }
    else{
        echo mysqli_error($maindb);
    }
}else{
    header('location:home.php?open=Tv+hír+regisztálás&error=EmptyDate');
}
