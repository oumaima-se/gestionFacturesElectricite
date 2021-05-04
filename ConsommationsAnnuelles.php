<?php
include("dashboardAdmin.php");
include("connection.php");  
?>
<html>
<head>
    <title>Verification des consommations annuelles</title> 
    <link rel="stylesheet" type="text/css" href="affichage_list.css" media="screen">
</head>
<body>
	<div class="container">
    <center>
    <h1>Toutes les consommations annuelles</h1>
    <table>
        <tr><th>ID_fichier</th><th>ID_client</th><th>Consommation annuelle</th><th>Annee</th><th>Actions</th></tr>
        <?php   
        $requete = "SELECT * FROM fichier_consommation";    
        $result= $connection_bd->query($requete);
        $data = $result->fetchAll();
        for($i=0; isset($data[$i]); $i++){
            $ID_fichier=$data[$i]["ID_fichier"];
            $ID_client=$data[$i]["ID_client"];
            $conso=$data[$i]["Consommation_annuelle"];
            $Annee=$data[$i]["Annee"];

            echo "<tr><td>$ID_fichier</td><td>$ID_client</td><td>$conso</td><td>$Annee</td>";
            echo"<td>";
            echo "<a href='modifier_conso_annuelle.php?ID_fichier=$ID_fichier' class='btn afficher'>Rectifier Consommation</a>";
           // echo"<td>";
            echo "<a href='fichier_conso.php?ID_fichier=$ID_fichier' class='btn modifier'>Télécharger Fichier </a>";
            echo "</tr>";
        }
        ?>
    </table>
    </center>
    
    </div>
</body>

</html>