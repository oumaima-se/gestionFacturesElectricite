<?php
include("dashboardClient.php");
include("connection.php");

if(isset($_POST["conso"]))
{
    $annee = "";
	$conso=$_POST["conso"];
    $date=$_POST["date_conso"];
    $year = date('Y', strtotime($date));
   // $month = date('M',strtotime($date));

   echo "<center><h3><span style='color:salmon;font-weight:bold'>Votre consommation a ete ajoutee avec succes!</span></h3></center> ";

    if($conso <= 100) $prix_ht = $conso * 0.91;
    else if($conso >= 101 && $conso <= 200) $prix_ht = $conso * 1.01;
    else $prix_ht = $conso * 1.12;

    $prix_total = $prix_ht + $prix_ht * 0.14;

	if(!empty($conso))
	{

        $query1 = $connection_bd->prepare('SELECT * FROM facture  WHERE ID_client=:id ORDER BY Date DESC LIMIT 1');
        //using bindParam helps prevent SQL Injection
        $query1->bindParam(':id', $id_client);
        $query1->execute();
        //$results is now an associative array with the result
        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        if($result1 != NULL){
           $conso_cumule = $result1[0]['consommation_cumule'];
           $conso_mensuel = $conso - $conso_cumule;

           if($conso_mensuel <= 100) $prix_ht = $conso_mensuel * 0.91;
           else if($conso_mensuel >= 101 && $conso_mensuel <= 200) $prix_ht = $conso_mensuel * 1.01;
           else $prix_ht = $conso_mensuel * 1.12;
       
           $prix_total = $prix_ht + $prix_ht * 0.14;

           $requete3 = "INSERT INTO facture VALUES(NULL,'$date','$id_client' ,'$conso', '$conso_mensuel','$prix_ht', '$prix_total', 0)";
            $connection_bd->exec($requete3);
        }

        $query = $connection_bd->prepare('SELECT * FROM facture WHERE ID_client=:id');
        //using bindParam helps prevent SQL Injection
        $query->bindParam(':id', $id_client);
        $query->execute();
        //$results is now an associative array with the result
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result == NULL){
            $requete = "INSERT INTO facture VALUES(NULL,'$date','$id_client' ,'$conso', '$conso','$prix_ht', '$prix_total', 0)";
            $connection_bd->exec($requete);
       //$annee = $result[0]['Annee'];
        }

            $query2 = $connection_bd->prepare('SELECT * FROM fichier_consommation WHERE ID_client=:id');
            //using bindParam helps prevent SQL Injection
            $query2->bindParam(':id', $id_client);
            $query2->execute();
            //$results is now an associative array with the result
            $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            if($result2 != NULL){
            $annee = $result2[0]['Annee'];
            }

            if($annee == $year ){
                $requete = "UPDATE fichier_consommation set Consommation_annuelle='$conso' where ID_client=$id_client AND Annee=$year";
                $connection_bd->exec($requete);
            }

            else {
            $requete2 = "INSERT INTO fichier_consommation VALUES(NULL,'$id_client' ,'$conso','$year')";
            $connection_bd->exec($requete2);
            }

	}
}

?>
<html>

<head>
<title> Ajout Consommation </title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="affichage_list.css" media="screen">
</head>

<body>
<div class="container">
<center>
<h2> Ajouter Consommation </h2>
<br><br>
<form method="post" action="">
<label>Votre Consommation actuelle en KW :</label> <input type="number"  name="conso"/>
<br> <br>
<label>la date de votre consommation :</label> <input type="date"  name="date_conso"/>
<br><br>
<input class="ajouter" name = "ajouter" type="submit" value="Ajouter"/>
</form>
</center>
</body>
</html>