<?php include_once 'controllers/log/logado.php';?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>MedHub | Painel Hospital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets/libs/multiselect/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    </head>

    <body data-sidebar="dark">
        <div id="wrapper">
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="pro-user-name ml-1">
                                Hospital <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bem vindo !</h6>
                            </div>
                            <a href="home.php?acao=seguranca&id_hosp=<?= $idLog;?>" class="dropdown-item notify-item">
                                <i class="fe-lock mr-1"></i>
                                <span>Alterar Senha</span>
                            </a>
                            <a href="?sair" onClick="return confirm('Deseja realmente sair do Sistema?')" class="dropdown-item notify-item">
                                <i class="fe-log-out mr-1"></i>
                                <span>Sair</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <div class="logo-box">
                    <a href="home.php?" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="16">
                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                    <a href="home.php?" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="35">
                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                    <li>
                        <button class="button-menu-mobile disable-btn waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <h4 class="page-title-main"><?= $nomeLog;?></h4>
                    </li>
        
                </ul>

            </div>
            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="home.php?">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
