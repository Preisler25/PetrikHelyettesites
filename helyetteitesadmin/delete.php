<?php
include 'maindbcfg.php';
if(isset($_SESSION['uname'])){
    $id = $_POST['id'];
    $sqldeletcmd = "DELETE FROM `days` WHERE id ='". $id. "'"; 
    if(mysqli_query($maindb, $sqldeletcmd)){header('location:home.php?open=Törlés');}
}else{
    header('location:index.php');
}