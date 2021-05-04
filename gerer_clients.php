<?php
include("dashboardAdmin.php");
include("connection.php");  
?>
<html>
<head>
    <title>Dashboard Admin</title> 
    <link rel="stylesheet" type="text/css" href="affichage_list.css" >
</head>
<body>
	<div class="container">
    <center>
        <h1> Clients</h1>
        <table>
            <tr><th>ID_client</th><th>Nom</th><th>Prenom</th><th>Adresse</th><th>Actions</th></tr>
            <?php    
            $requete = "SELECT ID_client, Nom, Prenom, Adresse FROM client";    
            $result= $connection_bd->query($requete);
            $data = $result->fetchAll();
            for($i=0; isset($data[$i]); $i++){
                $ID_client=$data[$i]["ID_client"];
                $Nom=$data[$i]["Nom"];
                $Prenom=$data[$i]["Prenom"];
                $Adresse=$data[$i]["Adresse"];
                echo "<tr><td>$ID_client</td><td>$Nom</td><td>$Prenom</td><td>$Adresse</td>";
                echo"<td>";
                echo "<a href='modifier_client.php?ID_client=$ID_client' class='btn modifier'>modifier</a>";
                echo "<a href='supprimer_client.php?ID_client=$ID_client' class='btn supprimer'>supprimer</a>";
                echo "</tr>";
            }
            ?>
        </table>
        <br> 
        <a href='ajouter_client.php?ID_client=$ID_client' class='btn ajouter'>ajouter</a>
    </center>
    
    </div>
</body>

</html>