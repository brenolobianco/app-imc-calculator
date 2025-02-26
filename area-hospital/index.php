<?php
ob_start();
session_start();
if(isset($_SESSION['emailHosp']) && (isset($_SESSION['senhaHosp']))){
  header("Location: home.php");exit;
}
  include("models/conecta.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>MedHub | Controle Administrativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            <a href="index.html" class="logo">
                                <img src="assets/images/logo-light.png" alt="" height="50">

                            </a>
                            <br /><br />
                        </div>
                        <?php include 'controllers/log/login.php';?>
                        <div class="card">

                            <div class="card-body p-4">

                                <form action="#" method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email</label>
                                        <input class="form-control" type="email" id="username" name="email_hosp" placeholder="Email de acesso">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Senha</label>
                                        <input class="form-control" type="password"  id="password" name="senha_hosp" placeholder="Sua senha">
                                    </div>

                                    <!--<div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Lembrar da senha?</label>
                                        </div>
                                    </div>-->

                                    <div class="form-group mb-0 text-center">    
                                        <button type="submit" name="logar" class="btn btn-primary btn-block" type="submit"> Entrar </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                       <!-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="pages-recoverpw.html" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>Forgot your password?</a></p>
                                <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-dark ml-1"><b>Sign Up</b></a></p>
                            </div>
                        </div> -->
                    </div> 
                </div>
            </div>

        </div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>