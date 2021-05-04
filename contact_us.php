<?php 
use PHPMailer\PHPMailer\PHPMailer;
error_reporting(0); 
include("dashboardClient.php");
include("connection.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contact Form</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            form{
                background: #FAFAFA;
                padding: 25px 25px;
            }

            
            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 20px;
                cursor: pointer;
            }
  
            input[type=submit]:hover {
                background-color: #45a049;
            }
  
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form action="" method="post">
                        <h3>Contact form</h3>
                        <?php

                        require("vendor/autoload.php");
                        if (isset($_POST['email'])) {

                            $email = $_POST['email'];
                            $subject = $_POST['subject'];
                            $query = $_POST['query'];

                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            $mail->Host = "smtp.gmail.com"; // Enter your host here
                            $mail->SMTPAuth = true;
                            $mail->Username = "contact.hellosew@gmail.com"; // Enter your email here
                            $mail->Password = "hellosew123456.."; //Enter your passwrod here
                            $mail->Port = 587;
                            $mail->IsHTML(true);
                            //$mail->From = "ayoubyam@gmail.com";
                            $mail->setFrom($email);
                           // $mail->AddReplyTo($email);
                           $name = $nom_client;
                           $name .= " ";
                           $name .= $prenom_client;
                    
                            $mail->FromName = $name;
                         //   $mail->SMTPDebug = 3;

                            $mail->Subject = $subject;

                           // $message = file_get_contents('template.php');
                           // $message = str_replace('%subject%', $subject, $message);
                           // $message = str_replace('%message%', $query, $message);
                            $mail->msgHTML($query);
                          //  $mail->AddAddress($ayoubyam@gmail.com);
                            $mail->AddAddress('ayoubyam@gmail.com'); //admin email
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                echo "SENT!";
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="subject">Subject:</label> 
                            <input type="text" name="subject" id="subject" maxlength="255" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Your email address:</label> 
                            <input type="email" name="email" id="email" maxlength="255" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="query">Your question:</label>
                            <textarea cols="30" rows="8" name="query" id="query" placeholder="Your question" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                        <center>
                            <input type="submit" value="Submit">
                        </center>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

    </body>
</html>