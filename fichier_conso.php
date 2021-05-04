<?php
include("protectionAdmin.php");
include("connection.php");   
require('fpdf.php');

//require("afficher_facture.php");

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm


$ID_fichier = "";
        if(isset($_GET["ID_fichier"]))
        {
            $ID_fichier=$_GET["ID_fichier"];
            if(!empty($ID_fichier) && is_numeric($ID_fichier))
            {
                        
            $requete = "SELECT * FROM fichier_consommation WHERE ID_fichier=$ID_fichier";
            $result = $connection_bd->query($requete);
            $data = $result->fetchAll();

                for($i=0; isset($data[$i]); $i++){
                    $ID_fichier=$data[$i]["ID_fichier"];
                    $Annee=$data[$i]["Annee"];
                    $ID_client=$data[$i]["ID_client"];
                    $conso=$data[$i]["Consommation_annuelle"];
                }

                $requete1 = "SELECT * FROM client WHERE ID_client=$ID_client";
                $result1 = $connection_bd->query($requete1);
                $data1 = $result1->fetchAll();
    
                    for($i=0; isset($data1[$i]); $i++){
                        $nom_client=$data1[$i]["Nom"];
                        $prenom_client=$data1[$i]["Prenom"];
                        $adresse=$data1[$i]["Adresse"];
                    }


                    $requete2 = "SELECT Prix_total FROM facture WHERE consommation_cumule=$conso";
                $result2 = $connection_bd->query($requete2);
                $data2 = $result2->fetchAll();
    
                    for($i=0; isset($data2[$i]); $i++){
                        $Prix_total=$data2[$i]["Prix_total"];
                    }

            }
        }


$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(105	,5,'Electroweb, Inc.',0,0);
$pdf->Cell(59	,5,'FICHIER DE CONSOMMATION ANNUEL',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(120	,5,'Tetouan Shore',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(120	,5,'Tetouan, Maroc',0,0);
$pdf->Cell(25	,5,'Annee',0,0);
$pdf->Cell(38	,5,$Annee,0,1);//end of line

//$pdf->Cell(130	,5,'Phone [+12385678]',0,0);
$pdf->Cell(25	,5,'Fichier #',0,0);
$pdf->Cell(38	,5,$ID_fichier,0,1);//end of line

$pdf->Cell(120	,5,'Fax +212 5 28 25 67 65',0,0);
$pdf->Cell(25	,5,'ID Client : ',0,0);
$pdf->Cell(38	,5,$ID_client,0,1);//end of line

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

$pdf->Cell(120	,5,'Type de Consommation',1,0);
//$pdf->Cell(25	,5,'Taxable',1,0);
$pdf->Cell(43	,5,'Consommation',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(120	,5,'Consommation de l annee '.$Annee,1,0);
//$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(43	,5,$conso.' KW',1,1,'R');//end of line

//$pdf->Cell(130	,5,'Consommation Mensuelle',1,0);
//$pdf->Cell(25	,5,'-',1,0);
//$pdf->Cell(43	,5,$Consommation_mensuelle.' KW',1,1,'R');//end of line

//$pdf->Cell(130	,5,'Something Else',1,0);
//$pdf->Cell(25	,5,'-',1,0);
//$pdf->Cell(38	,5,'1,000',1,1,'R');//end of line

//summary
$pdf->Cell(95	,5,'',0,0);
$pdf->Cell(25	,5,'Total TTC',0,0);
$pdf->Cell(13	,5,'MAD',1,0);
$pdf->Cell(30	,5,$Prix_total,1,1,'R');


//end of line

// // $pdf->Cell(130	,5,'',0,0);
// // $pdf->Cell(25	,5,'Taxable',0,0);
// // $pdf->Cell(4	,5,'$',1,0);
// // $pdf->Cell(30	,5,'0',1,1,'R');//end of line

// $pdf->Cell(105	,5,'',0,0);
// $pdf->Cell(25	,5,'Tax ',0,0);
// $pdf->Cell(13	,5,'-',1,0);
// $pdf->Cell(30	,5,'10%',1,1,'R');//end of line

// $pdf->Cell(105	,5,'',0,0);
// $pdf->Cell(25	,5,'Total TTC',0,0);
// $pdf->Cell(13	,5,'MAD',1,0);
// $pdf->Cell(30	,5,$Prix_total,1,1,'R');//end of line





















$pdf->Output();
?>
