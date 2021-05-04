<?php 
        include("dashboardClient.php");
        include("connection.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <title>Factures</title> 
            <style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				border-bottom: 1px solid #ddd;
				font-weight: bold;
                background: #eee;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.rtl table {
				text-align: right;
			}

			.rtl table tr td:nth-child(2) {
				text-align: left;
			}

            

		</style>
	</head>
	<body>
        <?php 
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
                    $consommation_cumule=$data[$i]["consommation_cumule"];
                    $Consommation_mensuelle=$data[$i]["Consommation_mensuelle"];
                    $prix_ht=$data[$i]["prix_ht"];
                    $Prix_total=$data[$i]["Prix_total"]; 
                }
            }
        }
   
		echo'<div class="invoice-box">';
			echo'<table cellpadding="0" cellspacing="0">';
                echo'<tr class="top">';
					echo'<td colspan="2">';
						echo'<table>';
							echo'<tr>';
								echo'<td>';
									echo'Date: ' .$Date; echo'<br />';
                                    echo'ID Facture: ' .$ID_facture;
								echo'</td>';
							echo'</tr>';
						echo'</table>';
					echo'</td>';
				echo'</tr>';

				echo'<tr class="information">';
					echo'<td colspan="2">';
						echo'<table>';
							echo'<tr>';
								echo'<td>';
									echo'Electroweb, Inc.'; echo'<br />';
									echo'Tetouan Shore'; echo'<br />';
									echo'Tetouan, Maroc'; echo'<br />';
									echo 'Fax +212 5 28 25 67 65';
								echo'</td>';

								echo'<td>';
									echo'Client n: '.$id_client; echo'<br />';
                                    echo $nom_client; echo' ';
                                    echo $prenom_client; echo'<br />';
                                    echo $adresse;
								echo'</td>';
							echo'</tr>';
						echo'</table>';
					echo'</td>';
				echo'</tr>';

				echo'<tr class="heading">';
					echo'<td>Consommation</td>';

					echo'<td>Montant</td>';
				echo'</tr>';

				echo'<tr class="item">';
					echo'<td>Consommation Cumulé</td>';

					echo'<td>'.$consommation_cumule; echo' KW'; echo'</td>';
				echo'</tr>';

				echo'<tr class="item">';
					echo'<td>Consommation Mensuelle</td>';

					echo'<td>'.$Consommation_mensuelle; echo' KW'; echo'</td>';
				echo'</tr>';

				echo'<tr class="heading">';
                echo'<td>Prix</td> ';

                echo'<td>Montant</td> ';
                echo'</tr>';

                echo'<tr class="details">';
                echo'<td>Prix HT</td>';

                echo'<td>' .$prix_ht; echo' Dhs'; echo'</td>';
                echo'</tr>';

				echo'<tr class="total">';
					echo'<td></td>';

					echo'<td>Prix Total: '.$Prix_total; echo' Dhs'; echo'</td>';
				echo'</tr>';
			echo'</table>';
		echo'</div>';
        ?>
	</body>
</html>

