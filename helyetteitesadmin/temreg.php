<?php
include 'maindbcfg.php';
$counter = 0;
$teremList = array();
for($i = 1; $i <= 16; $i++){
    if(isset($_POST[$i."teremora"])){
        array_push($teremList, $i);
        echo $i;
    }
}
if($_POST['teremnapok'] != ""){
    $dayl = explode("-",$_POST['teremnapok']);
    $day =  $dayl[0].".".$dayl[1].".".$dayl[2];
    if($_POST['teremh'] != $_POST['teremhe']){
        for($x=0; $x <= count($teremList)-1; $x++){
            $ora = $teremList[$x].".óra";
            $sqltermimportcmd = "INSERT INTO `days` (`tname`, `ora`, `terem`, `class`,`tipus`,`day`)    VALUES ('". $_POST['teremh']. "','". $ora. "','". $_POST['teremhe']. "','". $_POST['teremclass']. "','terem','". $day. "')";
            if(mysqli_query($maindb, $sqltermimportcmd)){
                $counter++;
            }
        }
    }else{
        header('location:home.php?open=Teremcsere&error=terem1');
    }
}else{
    header('location:home.php?open=Teremcsere&error=EmptyDate');
}
if($counter == count($teremList)){
    header('location:home.php?open=Teremcsere');
}