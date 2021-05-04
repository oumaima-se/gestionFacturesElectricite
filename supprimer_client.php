<?php
if(isset($_GET["ID_client"]))
{
    $ID_client = $_GET["ID_client"];
    if(!empty($ID_client) && is_numeric($ID_client))
    {
        include("protectionAdmin.php");
        include("connection.php");  
        $requete1 = "DELETE FROM client WHERE ID_client=$ID_client";
        $connection_bd->exec($requete1);
        header("Location:gerer_clients.php");
        if($requete1){
            echo 'Suppression avec succes';
        }
    }
}
?>

