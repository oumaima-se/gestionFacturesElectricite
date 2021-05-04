<?php 
        include("dashboardClient.php");
        include("connection.php");
?>
<html>
<head>
    <title>Client Dashboard</title> 
    <link rel="stylesheet" type="text/css" href="affichage_list.css" media="screen">
</head>
<body>
	<div class="container">
    <center>
    <h1> Mes Factures</h1>
    <table>
        <tr><th>ID_facture</th><th>Date</th><th>Actions</th></tr>
        <?php    
        $requete = "SELECT ID_facture,Date FROM facture WHERE ID_client=$id_client";    
        $result= $connection_bd->query($requete);
        $data = $result->fetchAll();
        for($i=0; isset($data[$i]); $i++){
            $ID_facture=$data[$i]["ID_facture"];
            $Date=$data[$i]["Date"];
            echo "<tr><td>$ID_facture</td><td>$Date</td>";
            echo"<td>";
            echo "<a href='afficher_facture.php?ID_facture=$ID_facture' class='btn afficher'>afficher</a>";
           // echo "<td>";
            echo "<a href='invoice.php?ID_facture=$ID_facture' class='btn modifier'>telecharger</a>";
            echo "</tr>";
        }
        ?>
    </table>
    </center>
    
    </div>
</body>

</html>