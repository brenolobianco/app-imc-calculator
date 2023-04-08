<<<<<<< HEAD
<?php
ob_start();
session_start();
if(isset($_SESSION['emailAcad']) && (isset($_SESSION['senhaAcad']))){
  header("Location: home.php");exit;
}
  include("models/conecta.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.3.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>MedHub</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/animatecss/animate.css">  
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="engine1/style.css" />
  <link rel="stylesheet" href="assets/css-personalizado/responsivo.css">
  <style>

    .place_form{
      border-radius: 25px;
      background-color: #757575;
      text-align: center;
      color: #fff;
      
    }
    
    .place_form::placeholder {
        color: #fff; 
        text-align: center; 
       
        
    }  
    
    .form_espaco{
        margin-top: 30px;
    }
    
    
        
  </style>
  <script type="text/javascript" src="engine1/jquery.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>
<body>
<?php // include 'lgpd.php';?>
<section class="menu menu3 cid-taGdXBPlfb" once="menu" id="menu3-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                        <img src="assets/images/logo-menu-beta.png" alt="MedHub" style="height: 4rem;">
                    </a>
                </span>
                
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
					<li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="index.php#content4-c">A Plataforma</a></li>
				    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="quem-somos.php">Quem Somos</a></li>
				    <li class="nav-item dropdown open">
						<a class="nav-link link text-white text-primary dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="true">Contato</a>
						<div class="dropdown-menu">
							<a class="text-white text-primary dropdown-item display-4" href="contato-med.php">Fale com a MedHub</a>
							<a class="text-white text-primary dropdown-item display-4" href="contato-hospital.php">MedHub no seu Hospital</a>
							<a class="text-white text-primary dropdown-item display-4" href="contato-parceiro.php">Seja Nosso Parceiro</a>
						</div>
					</li>
                </ul>
            <div class="navbar-buttons mbr-section-btn">
                <a class="btn btn-white display-4" href="entrar.php" style="width: 100px;">Entrar</a></div>	          
            </div>
        </div>
    </nav>
</section>
=======
<?php
ob_start();
session_start();
if(isset($_SESSION['emailAcad']) && (isset($_SESSION['senhaAcad']))){
  header("Location: home.php");exit;
}
  include("models/conecta.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.3.10, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>MedHub</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/animatecss/animate.css">  
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="engine1/style.css" />
  <link rel="stylesheet" href="assets/css-personalizado/responsivo.css">
  <style>

    .place_form{
      border-radius: 25px;
      background-color: #757575;
      text-align: center;
      color: #fff;
      
    }
    
    .place_form::placeholder {
        color: #fff; 
        text-align: center; 
       
        
    }  
    
    .form_espaco{
        margin-top: 30px;
    }
    
    
        
  </style>
  <script type="text/javascript" src="engine1/jquery.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>
<body>
<?php // include 'lgpd.php';?>
<section class="menu menu3 cid-taGdXBPlfb" once="menu" id="menu3-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                        <img src="assets/images/logo-menu-beta.png" alt="MedHub" style="height: 4rem;">
                    </a>
                </span>
                
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
					<li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="index.php#content4-c">A Plataforma</a></li>
				    <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="quem-somos.php">Quem Somos</a></li>
				    <li class="nav-item dropdown open">
						<a class="nav-link link text-white text-primary dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="true">Contato</a>
						<div class="dropdown-menu">
							<a class="text-white text-primary dropdown-item display-4" href="contato-med.php">Fale com a MedHub</a>
							<a class="text-white text-primary dropdown-item display-4" href="contato-hospital.php">MedHub no seu Hospital</a>
							<a class="text-white text-primary dropdown-item display-4" href="contato-parceiro.php">Seja Nosso Parceiro</a>
						</div>
					</li>
                </ul>
            <div class="navbar-buttons mbr-section-btn">
                <a class="btn btn-white display-4" href="entrar.php" style="width: 100px;">Entrar</a></div>	          
            </div>
        </div>
    </nav>
</section>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
