<?php 
$host = "localhost";
$username = "root";
$pass = "";
$db = "helyettesites";

$maindb = mysqli_connect($host, $username, $pass, $db);
if(!$maindb)
{
    echo 'could not connect'.mysqli_error();
}
$today = date("Y.m.d");
if (isset($_GET['status'])){
    switch ($_GET['status']){
        case "napihely":
            if(isset($_GET['ora'])){
                $ora = $_GET['ora'];
                $sql = "SELECT tname, ora, helytan, terem, class, ovh, day FROM days WHERE tipus='tanar' AND `ora` = '".$ora."' AND day = '$today'";
                $result = mysqli_query($maindb, $sql);
                $list = array();
                while($row = mysqli_fetch_assoc($result)){
                        $list[] = $row;
                }
                if($list != []){
                    for($i = 0; $i < count($list); $i++){
                        $list[$i] = str_replace(["\r","\n"], "", $list[$i]);
                    }
                    echo json_encode($list, JSON_UNESCAPED_UNICODE);
                }
                break;
            }else{
                $sql = "SELECT tname, ora, helytan, terem, class, ovh, day FROM days WHERE tipus='tanar' AND day = '".$today."'";
                $result = mysqli_query($maindb, $sql);
                $list = array();
                while($row = mysqli_fetch_assoc($result)){
                        $list[] = $row;
                }
                if($list != []){
                    for($i = 0; $i < count($list); $i++){
                        $list[$i] = str_replace(["\r","\n"], "", $list[$i]);
                    }
                    echo json_encode($list, JSON_UNESCAPED_UNICODE);
                }
                break;
            }
        case "teremhely":
            if(isset($_GET['ora'])){
                $sql2 = "SELECT tname, ora, terem, class, day FROM days WHERE ora='".$_GET['ora']."' and tipus='terem' and day = '".$today."'";
                $result2 = mysqli_query($maindb, $sql2);
                $list2 = array();
                while($row = mysqli_fetch_assoc($result2)){
                    $list2[] = $row;
                }
                if($list2 != []){
                    for($i = 0; $i < count($list2); $i++){
                        $list2[$i] = str_replace(["\r","\n"], "", $list2[$i]);
                    }
                    echo json_encode($list2, JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode("empty");
                }
                break;
            }else{
                $sql2 = "SELECT tname, ora, terem, class, day FROM days WHERE tipus='terem' and day = '".$today."'";
                $result2 = mysqli_query($maindb, $sql2);
                $list2 = array();
                while($row = mysqli_fetch_assoc($result2)){
                    $list2[] = $row;
                }
                if($list2 != []){
                    for($i = 0; $i < count($list2); $i++){
                        $list2[$i] = str_replace(["\r","\n"], "", $list2[$i]);
                    }
                    echo json_encode($list2, JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode("empty");
                }
                break;
            }
        case "napihir":
            $sql3 = "SELECT alert, day FROM days WHERE tipus='tvhir' and day = '".$today."'";
            $result3 = mysqli_query($maindb, $sql3);
            $list3 = array();
            while($row = mysqli_fetch_assoc($result3)){
                $list3[] = $row;
            }
            if($list3 != []){
                for($i = 0; $i < count($list3); $i++){
                    $list3[$i] = str_replace(["\r","\n"], "", $list3[$i]);
                }
                echo json_encode($list3, JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode("empty");
            }
            break;
    }
}
