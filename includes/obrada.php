<?php
// zapocni session
session_start();

// ukljuci/iskljuci error reporting

$error_reporting = 0;
if ($error_reporting){
    ini_set('display_errors','1');
    ini_set('display_startup_errors','1');
    error_reporting (E_ALL ^ E_NOTICE);
} else {
    ini_set('display_errors','0');
    ini_set('display_startup_errors','0');
    error_reporting (E_ALL ^ E_NOTICE);  
}




// odredi varijable iz url-a (umjesto .httaccessa)
$url = $_SERVER['REQUEST_URI'];
$urlArr = explode('/', $url);

// ukljuci potrebne datoteke
include("baza/database.php");
include("includes/funkcije.php");

// ako se dode bez /jezik/home i domena je normalna preusmjeri sa jezikom
if ($_SERVER['REQUEST_URI'] == '/') {
    header('Location: /home');
    die();
}

$maildomena = "";


switch ($urlArr[1]) {

    case (preg_match('/ponuda.*/', $url) ? true : false) :
    $stranica='ponuda';
    break;

    case (preg_match('/search.*/', $url) ? true : false) :
    $stranica='search';
    break;

    // naslovna
    case 'home':
    $stranica = 'home';
    $query = "SELECT * FROM najnovije";
    $result = mysqli_query ( $connection,  $query );
    $data = mysqli_fetch_assoc ( $result ); 

    break;
    
    case 'u-ponudi':
    $stranica = 'u-ponudi';
    $query = "SELECT * FROM najnovije";
    $result = mysqli_query ( $connection,  $query );
    $data = mysqli_fetch_assoc ( $result ); 
    break;
    
    case 'kontakt':
    $stranica = 'contact';
    $query = "SELECT * FROM najnovije";
    $result = mysqli_query ( $connection,  $query );
    $data = mysqli_fetch_assoc ( $result ); 
    break;
 


    //slanje maila iz forme na naslovnoj

        if ($_POST['posiljatelj'] AND $_POST['email']) {

            require_once 'phpmailer/class.phpmailer.php';

            $mail = new PHPMailer();
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';

            if(strlen($_POST['email']) > 0) {
                $mail->From = $_POST['email'];
                $mail->FromName = $_POST['posiljatelj'];
            } else {
                $mail->SetFrom('noreply@centar-prom.hr', 'Online kontakt');
            }

            $mail->AddAddress('simara@hi.t-com.hr');
            //$mail->AddAddress('');
            $mail->Subject = 'Kontakt formular';
            $mail->Body = "<html>
                    <head>
                    <style>
                    body {

                        font-family: Arial, verdana, sans-serif;

                        }

                    </style>
                    </head>
                    <body>
                    <b>Naslov</b>: ".$_POST['naslov']."<br />
                    <b>Pošiljatelj</b>: ".$_POST['posiljatelj']."<br />
                    <b>Telefon</b>: ".$_POST['telefon']."<br />
                    <b>E-mail</b>: ".$_POST['email']."<br />
                    <b>Poruka</b> : ".$_POST['poruka']."<br /></body></html>";
            $mSent = $mail->Send();

    }
    break;


       
	if(!empty($_POST)){
		//var_dump($_POST);
		//die();
	}
	break;
}


// ako se doslo sa nekog starog linka pokazi 404 stranicu
if (!$stranica) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    $stranica = '404';
}
