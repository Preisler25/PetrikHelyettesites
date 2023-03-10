<?php 
$host = "localhost";
$username = "root";
$pass = "";
$db = "helyettesites";

$maindb = mysqli_connect($host, $username, $pass, $db);
if(!$maindb)
{
    echo 'could not connect';
}
session_start();