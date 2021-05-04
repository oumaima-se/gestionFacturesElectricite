<?php  
include("protectionAdmin.php");
include("connection.php");
if(!isset($_SESSION["username"])){
   header("Location:login_admin.php");
}

?>
<html>
   
   <head>
      <title>Dashboard Admin </title>
      <link rel="stylesheet" type="text/css" href="dashboard.css" media="screen">
      <style>
                     
         .dropdown-content {
            list-style-type: none;
            margin: 0;
            padding: 400px 16px;;
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
      <li><a class="dashboard" href="dashboardAdmin.php"><b>Dashboard Admin</b></a></li>
      <li><a class="signout" href= "logout.php"></b>Sign Out</b></a></li>
   </ul>
   <?php

   if(isset($_SESSION["username"]))  
      {  
         echo '<h3 class="welcome" >Bonjour - '.$Prenom. ' '.$Nom .'</h3>';  
      } 
   ?>
   
      <div class="dropdown-content">
        <a href="gerer_clients.php">Gerer les clients</a>
        <a href="ConsommationsAnnuelles.php">Gestion consommatiom annuelle </a>
        <a href="reclamation.php"> Gestion des reclamations </a>
      </div>
      <br>
      <br>
   </body>
</html>