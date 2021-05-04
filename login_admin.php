<?php  
 session_start();  

 try  
 {  
      $connect = new PDO('mysql:host=localhost;port=3306;dbname=tp2_web;charset=utf8', 'root', '');  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<center><label>Tous les champs sont requis!</label></center>';  
           }  
           else  
           {  
                $query = "SELECT * FROM agent WHERE username = :username AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:dashboardAdmin.php");  
                }  
                else  
                {  
                     $message = '<center><label>Les données entrées sont incorrectes!</label></center>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
      <link rel="stylesheet" type="text/css" href="login_style.css" media="screen"/>
           <title>Login Page</title>  
  
      </head>  
      <body>  
           <br />  
           <div class="main" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <p class="sign" align="center">S'identifier</p> 
                <form class="form1" method="post">  
                       
                     <input type="text" name="username" class="un " placeholder="Nom d'utilisateur" />  
                     <br />  
                     
                     <input align="center" type="password" name="password" class="pass" placeholder="Mot de Passe"/>  
                     <br />  
                     <input type="submit" name="login" class="submit" align="center" value="Login" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  

 