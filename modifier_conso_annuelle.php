<?php
include("dashboardAdmin.php");
include("connection.php"); 
$ID_client = "";
$nom_client = "";
$prenom_client="";
$Adresse="";
$username="";
$password=""; 


if(isset($_GET["ID_fichier"]))
{
    $ID_fichier=$_GET["ID_fichier"];
    if(!empty($ID_fichier) && is_numeric($ID_fichier))
    { 
		$query = "SELECT * FROM fichier_consommation WHERE ID_fichier=$ID_fichier";
        $result = $connection_bd->query($query);
        $data = $result->fetchAll();
        $conso=$data[0]["Consommation_annuelle"];
        $ID_client=$data[0]["ID_client"];
  
     //  echo $ID_client;
    }
}


if(isset($_POST["conso"])) {
   // $ID_fichier=$_GET["ID_fichier"];
    $conso = $_POST["conso"];

    if($conso <= 100) $prix_ht = $conso * 0.91;
    else if($conso >= 101 && $conso <= 200) $prix_ht = $conso * 1.01;
    else $prix_ht = $conso * 1.12;
    
    $prix_total = $prix_ht + $prix_ht * 0.14;

    if(!empty($ID_fichier) && is_numeric($ID_fichier))
    { 
		$query1 = "UPDATE fichier_consommation SET Consommation_annuelle=$conso WHERE ID_fichier=$ID_fichier";
        $connection_bd->exec($query1);


        $query2 = $connection_bd->prepare('SELECT * FROM facture  WHERE ID_client=:id ORDER BY Date DESC LIMIT 1');
        //using bindParam helps prevent SQL Injection
        $query2->bindParam(':id', $ID_client);
        $query2->execute();
        //$results is now an associative array with the result
        $result1 = $query2->fetchAll(PDO::FETCH_ASSOC);
        if($result1 != NULL){
           $date = $result1[0]['Date'];
           $conso_mensuelle= $result1[0]['Consommation_mensuelle'];
           $conso_cumule_old=$result1[0]['consommation_cumule'];

           echo $date;
           echo $conso_mensuelle;
           echo $conso_cumule_old;

           $diff=$conso - $conso_cumule_old;

           $conso_mensuelle = $conso_mensuelle + $diff;

           echo $diff;
                   
        $query3 = "UPDATE facture SET consommation_cumule=$conso, Consommation_mensuelle=$conso_mensuelle, prix_ht=$prix_ht, Prix_total=$prix_total WHERE Date='$date'";
        $connection_bd->exec($query3);


		header("Location:ConsommationsAnnuelles.php");
        }
        
    }
}

?>

<html>
<head>
  <title>Modification</title>
  <link rel="stylesheet" type="text/CSS" href="affichage_list.css" />
</head>
<body>
	<div class="container">
    <center>
	<h1> Modifier Consommation </h1>
	<form method="post" action="#">
        Modifier Consommation : <input type="number" placeholder="Consommation" name="conso" value="<?php echo $conso?>"/>
        <br>
        <br>
                <input class = "btn modifier" type="submit" value="modifier" />
                	</div>
</form>
</center>
</body>

</html>