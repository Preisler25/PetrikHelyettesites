<?php 
require ('fpdf.php');
//require('makefont/makefont.php');
include '../maindbcfg.php';
function conv ($text){
    $ftext = str_ireplace("ő","ö",$text);
    return iconv('UTF-8', 'windows-1252', $ftext);
}

function pdfheader($title,$imgsrc,$file){
    $file->SetFont('Arial','B',15);
    $file->Image($imgsrc,15,6,25);
    $file->Cell(60);
    $file->Cell(10,10,$_SESSION['epday']);
    $file->Cell(20);
    $file->Cell(30,10,$title);
    $file->Ln(20);
}

// Variables //

if(isset($_POST['exportday'])){
    $_SESSION['epday'] = $_POST['exportday'];
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle($_SESSION['epday']);   
pdfheader("BMSzC Petrik Lajos Technikum","../icon.png",$pdf);
$dayl = explode("-",$_SESSION['epday']);
$day =  $dayl[0].".".$dayl[1].".".$dayl[2];
$sqlcmd = "SELECT tname, ora, class, day, helytan, terem, ovh FROM days WHERE day='".$day."' AND tipus='tanar'";
$request = mysqli_query($maindb, $sqlcmd);
$pdf->SetFont('Arial','B',11);
$starthvalue = 40;
$pdf->Ln(10);
$pdf->Cell(70,10,conv("Hiányzó Tanár"));
$pdf->Cell(50,10,conv("helyettesítő tanár"));
$pdf->Cell($starthvalue,10,conv("Osztály"));
$pdf->Cell($starthvalue,10,conv("Óra"));
$pdf->Ln(10);
while($row = $request ->fetch_assoc()){
    $pdf->Cell(70,10,conv($row['tname']));
    if($row['helytan'] == "-"){
        $pdf->Cell(50,10,conv("-"));
    }else{
        $pdf->Cell(50,10,conv($row['helytan']));
    }
    $pdf->Cell(40,10,conv($row['class']));
    $pdf->Cell(40,10,conv($row['ora']));
    if($row['ovh']==1){
        $pdf->Cell($starthvalue,20,conv("Összevont óra"));
    }
    $pdf->Ln(8);
};
$pdf->Output('D',$_SESSION['epday'].".pdf");