<?php include_once 'controllers/log/logado.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>MedHub | Painel Administrativo</title>
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
    <link href="assets/libs/multiselect/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>

<body data-sidebar="dark">
    <div id="wrapper">
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="pro-user-name ml-1">
                            Admin <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bem vindo !</h6>
                        </div>
                        <a href="home.php?acao=seguranca&id=<?= $idLogado; ?>" class="dropdown-item notify-item">
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
                    <h4 class="page-title-main">Painel Admin</h4>
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

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-format-font"></i>
                                <span> Conteúdo </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li> Indisponível</li>
                                <!-- <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Apresentação
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li>
                                                <a href="javascript: void(0);">Texto</a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">Carrocel</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Quem Somos
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li>
                                                <a href="javascript: void(0);">Artigo</a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">Final</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Acadêmico</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Médico</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Estágio</a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript: void(0);">Pesquisa</a>
                                    </li>-->

                            </ul>
                        </li>

                        <li>
                            <a href="home.php?acao=lista-ranking">
                                <i class="mdi mdi-chart-bar-stacked"></i>
                                <span> Ranking </span>

                            </a>

                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-account-group"></i>
                                <span> Acadêmicos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=academicos">Cadastrados</a></li>
                                <li><a href="home.php?acao=matriculas">Matriculados</a></li>
                                <li><a href="home.php?acao=lista-de-aprovados">Lista de Aprovados</a></li>
                                <li><a href="home.php?acao=cracha">Crachá</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-account-details-outline"></i>
                                <span> Médicos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=medicos">Cadastrados</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-account"></i>
                                <span> Professores </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=novo-professor">Novo Professor</a></li>
                                <li><a href="home.php?acao=professores">Prof´s Cadastrados</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-home"></i>
                                <span> Hospitais </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="home.php?acao=hospitais">Hospitas</a></li>
                                <li><a href="home.php?acao=estagios">Estágios</a></li>
                                <li><a href="home.php?acao=editais-pdf">Editais</a></li>
                                <li>Pesquisas ( Indisponível )</li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-layers"></i>
                                <span> Cursos/Treinamento </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=cursos">Cursos</a></li>
                                <li><a href="home.php?acao=modulos">Módulos</a></li>
                                <li><a href="home.php?acao=quiz">Quiz</a></li>
                                <li><a href="home.php?acao=quiz-pre-teste">Quiz pre-teste</a></li>
                                <li><a href="home.php?acao=aulas-treinamento-v2">Aula</a></li>
                                <!--<li>
                                        <a href="javascript: void(0);" aria-expanded="false">Aulas
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="home.php?acao=aulas">Aulas</a></li>
                                            <li><a href="home.php?acao=aulas-videos">Vídeo Aula</a></li>
                                            <li><a href="home.php?acao=aulas-pdf">PDF Aula</a></li>    
                                        </ul>
                                    </li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-file"></i>
                                <span> Aulas </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="home.php?acao=aulas">Aulas</a></li>
                                <li><a href="home.php?acao=aulas-videos">Vídeo Aula</a></li>
                                <li><a href="home.php?acao=aulas-pdf">PDF Aula</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>