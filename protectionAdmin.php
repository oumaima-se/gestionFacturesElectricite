<?php
   include('connection.php');
   session_start();
  //$stick = $_SESSION["username"];

  $query = $connection_bd->prepare('SELECT * FROM agent WHERE username=:id');
//using bindParam helps prevent SQL Injection
$query->bindParam(':id', $_SESSION["username"]);
$query->execute();
//$results is now an associative array with the result
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$ID_Agent = $result[0]['ID_agent'];
$Prenom = $result[0]['Prenom'];
$Nom = $result[0]['Nom'];

if(!isset($_SESSION["username"])){
    header("Location:acceuil.php");
}
?>