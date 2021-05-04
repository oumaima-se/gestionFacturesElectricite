<?php
include("protection.php");
include("connection.php");  
require('fpdf.php');

//require("afficher_facture.php");

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm


$ID_facture = "";
        if(isset($_GET["ID_facture"]))
        {
            $ID_facture=$_GET["ID_facture"];
            if(!empty($ID_facture) && is_numeric($ID_facture))
            {               
            $requete = "SELECT * FROM facture WHERE ID_facture=$ID_facture";
            $result = $connection_bd->query($requete);
            $data = $result->fetchAll();

                for($i=0; isset($data[$i]); $i++){
                    $ID_facture=$data[$i]["ID_facture"];
                    $Date=$data[$i]["Date"];
                    $ID_client=$data[$i]["ID_client"];
                    $Consommation_cumule=$data[$i]["consommation_cumule"];
                    $Consommation_mensuelle=$data[$i]["Consommation_mensuelle"];
                    $prix_ht=$data[$i]["prix_ht"];
                    $Prix_total=$data[$i]["Prix_total"]; 
                }
            }
        }


$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'Electroweb, Inc.',0,0);
$pdf->Cell(59	,5,'FACTURE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Tetouan Shore',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Tetouan, Maroc',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(38	,5,$Date,0,1);//end of line

//$pdf->Cell(130	,5,'Phone [+12385678]',0,0);
$pdf->Cell(25	,5,'Facture #',0,0);
$pdf->Cell(38	,5,$ID_facture,0,1);//end of line

$pdf->Cell(130	,5,'Fax +212 5 28 25 67 65',0,0);
$pdf->Cell(25	,5,'ID Client : ',0,0);
$pdf->Cell(38	,5,$id_client,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Information Client ',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$nom_client.' '.$prenom_client,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$adresse,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Type de Consommation',1,0);
//$pdf->Cell(25	,5,'Taxable',1,0);
$pdf->Cell(43	,5,'Consommation',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130	,5,'Consommation Cumulee',1,0);
//$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(43	,5,$Consommation_cumule.' KW',1,1,'R');//end of line

$pdf->Cell(130	,5,'Consommation Mensuelle',1,0);
//$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(43	,5,$Consommation_mensuelle.' KW',1,1,'R');//end of line

//$pdf->Cell(130	,5,'Something Else',1,0);
//$pdf->Cell(25	,5,'-',1,0);
//$pdf->Cell(38	,5,'1,000',1,1,'R');//end of line

//summary
$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Total HT',0,0);
$pdf->Cell(13	,5,'MAD',1,0);
$pdf->Cell(30	,5,$prix_ht,1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Taxable',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,'0',1,1,'R');//end of line

$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Tax ',0,0);
$pdf->Cell(13	,5,'-',1,0);
$pdf->Cell(30	,5,'10%',1,1,'R');//end of line

$pdf->Cell(105	,5,'',0,0);
$pdf->Cell(25	,5,'Total TTC',0,0);
$pdf->Cell(13	,5,'MAD',1,0);
$pdf->Cell(30	,5,$Prix_total,1,1,'R');//end of line





















$pdf->Output();
?>
