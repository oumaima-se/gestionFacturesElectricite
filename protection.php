<?php
   include('connection.php');
   session_start();
  //$stick = $_SESSION["username"];

  $query = $connection_bd->prepare('SELECT * FROM client WHERE username=:id');
//using bindParam helps prevent SQL Injection
$query->bindParam(':id', $_SESSION["username"]);
$query->execute();
//$results is now an associative array with the result
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$id_client = $result[0]['ID_client'];
$prenom_client = $result[0]['Prenom'];
$nom_client = $result[0]['Nom'];
$adresse = $result[0]['Adresse'];

if(!isset($_SESSION["username"])){
    header("Location:acceuil.php");
}
?>