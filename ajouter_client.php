<?php
include("dashboardAdmin.php");
include("connection.php");  

$ID_client="";
$nom_client="";
$prenom_client="";
$Adresse="";
$username="";
$password="";

if(isset($_POST["nom_client"]) && isset($_POST["prenom_client"]) && isset($_POST["Adresse"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
    $nom_client = $_POST["nom_client"];
    $prenom_client = $_POST["prenom_client"];
    $Adresse = $_POST["Adresse"];
    $username = $_POST["username"];
    $password = $_POST["password"];
	if((!empty($nom_client)) && (!empty($prenom_client)) && (!empty($Adresse)) && (!empty($username)) && (!empty($password)) )
	{
		$query = "INSERT INTO client VALUES(NULL, '$nom_client', '$prenom_client', '$Adresse', '$username', '$password')";
		$connection_bd->exec($query);
		header("Location:gerer_clients.php");
	}
}
?>

<html>
<head>
  <title>Ajout </title>
  <link rel="stylesheet" type="text/css"href="affichage_list.css" />
</head>
<body>
	<div class="container">
    <center>
	<h1> Ajout d'un client </h1>
	<form method="post" action="#">
		Client: <input type="text" placeholder="Nom client" name="nom_client" value="<?php echo $nom_client?>"/>
        <input type="text" placeholder="Prenom client" name="prenom_client" value="<?php echo $prenom_client?>"/>
        <input type="text" placeholder="Adresse client" name="Adresse" value="<?php echo $Adresse?>"/>
        <input type="text" placeholder="username" name="username" value="<?php echo $username?>"/>
        <input type="password" placeholder="********" name="password" value="<?php echo $password?>"/>
        <br/>
        <br/>
			<input class = "btn ajouter" value="ajouter" type="submit" />
	</div>	
	</form>		
    </center>	
	<br>
</body>

</html>