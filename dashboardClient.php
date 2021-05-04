<?php  
include("protection.php");
include("connection.php");
if(!isset($_SESSION["username"])){
   header("Location:pdo_login.php");
}

?>
<html>
   
   <head>
      <title>Dashboard Client </title>
      <link rel="stylesheet" type="text/css" href="dashboard.css" media="screen">
      <style>
                     
         .dropdown-content {
            list-style-type: none;
            margin: 0;
            padding: 385px 16px;;
            overflow: hidden;
            background-color: A0D3F8;
            float: left;
         }
            
         .dropdown-content a {
            display: block;
            color: black;
            text-align: left;
            padding: 14px 16px;
            text-decoration: none;
         }
         
         .dropdown-content a:hover {background-color: #C6E5FB}
         
    </style>
   </head>
   
   <body>
   <ul>
      <li><a class="dashboard" href="dashboardClient.php"><b>Dashboard Client</b></a></li>
      <li><a class="signout" href= "logout.php"></b>Sign Out</b></a></li>
   </ul>
   <?php

   if(isset($_SESSION["username"]))  
      {  
         echo '<h3 class="welcome" >Bonjour - '.$_SESSION["username"].'</h3>';  
      } 
   ?>
   
      <div class="dropdown-content">
        <a href="ajout_conso.php">Entrer ma consommation</a>
        <a href="affichageFactures.php">Afficher Factures</a>
        <a href="reclamation.php">Réclamer </a>
        <a href="contact_us.php">Contactez-nous </a>
      </div>
      <br>
      <br>
      
   </body>
   
   
</html>