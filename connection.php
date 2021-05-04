 <?php


 try
 {
     $connection_bd = new PDO('mysql:host=localhost;port=3306;dbname=tp2_web;charset=utf8', 'root', '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 }
 catch (Exception $e)
 {
     die('Erreur : ' . $e->getMessage());
 }


?>
