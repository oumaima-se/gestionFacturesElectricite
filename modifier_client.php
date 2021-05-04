<?php
include("dashboardAdmin.php");
include("connection.php"); 
$ID_client = "";
$nom_client = "";
$prenom_client="";
$Adresse="";
$username="";
$password=""; 

if(isset($_GET["ID_client"]))
{
    $ID_client=$_GET["ID_client"];
    if(!empty($ID_client) && is_numeric($ID_client))
    { 
		$query1 = "SELECT * FROM client WHERE ID_client=$ID_client";
        $result = $connection_bd->query($query1);
        $data = $result->fetchAll();
        $nom_client=$data[0]["Nom"];
        $prenom_client=$data[0]["Prenom"];
        $Adresse=$data[0]["Adresse"];
        $username=$data[0]["username"];
        $password=$data[0]["password"];
        
    }
}

if(isset($_POST["nom_client"]) && isset($_POST["ID_client"]))
{
    $nom_client = $_POST["nom_client"];
    $ID_client = $_POST["ID_client"];
	if(!empty($nom_client) && !empty($ID_client) && is_numeric($ID_client))
	{
		$query = "UPDATE client SET Nom='$nom_client' WHERE ID_client=$ID_client";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
	}
}

if(isset($_POST["prenom_client"]) && isset($_POST["ID_client"]))
{
    $prenom_client = $_POST["prenom_client"];
    $ID_client = $_POST["ID_client"];
	if(!empty($prenom_client) && !empty($ID_client) && is_numeric($ID_client))
	{
		$query = "UPDATE client SET Prenom='$prenom_client' WHERE ID_client=$ID_client";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
	}
}

if(isset($_POST["Adresse"]) && isset($_POST["ID_client"]))
{
    $Adresse = $_POST["Adresse"];
    $ID_client = $_POST["ID_client"];
	if(!empty($Adresse) && !empty($ID_client) && is_numeric($ID_client))
	{
		$query = "UPDATE client SET Adresse='$Adresse' WHERE ID_client=$ID_client";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
	}
}

if(isset($_POST["username"]) && isset($_POST["ID_client"]))
{
    $username = $_POST["username"];
    $ID_client = $_POST["ID_client"];
	if(!empty($username) && !empty($ID_client) && is_numeric($ID_client))
	{
		$query = "UPDATE client SET username='$username' WHERE ID_client=$ID_client";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
	}
}

if(isset($_POST["password"]) && isset($_POST["ID_client"]))
{
    $password = $_POST["password"];
    $ID_client = $_POST["ID_client"];
	if(!empty($password) && !empty($ID_client) && is_numeric($ID_client))
	{
		$query = "UPDATE client SET password='$password' WHERE ID_client=$ID_client";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
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
	<h1> Modifier un client </h1>
	<form method="post" action="#">
        Client: <input type="text" placeholder="Nom client" name="nom_client" value="<?php echo $nom_client?>"/>
        <input type="text" placeholder="Prenom client" name="prenom_client" value="<?php echo $prenom_client?>"/>
        <input type="text" placeholder="Adresse client" name="Adresse" value="<?php echo $Adresse?>"/>
        <input type="text" placeholder="username" name="username" value="<?php echo $username?>"/>
        <input type="password" placeholder="********" name="password" value="<?php echo $password?>"/> 
        <br>
        <br>
                <input class = "btn modifier" type="submit" value="modifier" />
                <input type="hidden" name="ID_client" value="<?php echo $ID_client?>"/>
	</div>
</form>
</center>
</body>

</html>