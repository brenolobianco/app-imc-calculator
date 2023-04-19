<?php include_once 'controllers/log/logado.php';

// PERMISSOES
$res_permissao = $conexao->prepare("SELECT * FROM permissao_setor WHERE id_login = :id");
$res_permissao->bindParam(':id', $idLogado, PDO::PARAM_INT);
$res_permissao->execute();

$perm = array("medico" => 0);

if(isset($perm['medico']) && $perm['medico'] > 1) {
    echo "sem permissão agora! agora tem que fazer esse trabalho manual aí, é bem chato hehe";
    echo "essa foi minha pequena contribuição. Qualquer coisa só chamar!blz";
    // aqui vai retornar false, agora vai retornar true mesmo sem permissão 
}
if($res_permissao->rowCount() > 0){
	$perm = $res_permissao->FETCH(PDO::FETCH_OBJ);
}
?>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
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
<?php if(isset($perm->dashboard) && $perm->dashboard){?>
                        <li>
                            <a href="home.php?">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
<?php }
if(isset($perm->conteudo) && $perm->conteudo){?>
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
<?php }
if(isset($perm->ranking)){?>
                        <li>
                            <a href="home.php?acao=lista-ranking">
                                <i class="mdi mdi-chart-bar-stacked"></i>
                                <span> Ranking </span>

                            </a>

                        </li>
<?php }

if(isset($perm->academico)){?>
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
<?php }
if(isset($perm->medico)){?>
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
<?php } 
if(isset($perm->professor)){?>
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
<?php }
if(isset($perm->hospital)){?>
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
<?php }
if(isset($perm->curso)){?>
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
<!--<?php }
if(isset($perm->aula)){?>-->
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
//<?php }?>
                        <li>
                            <a href="home.php?acao=area-gestor-notificacao">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                    <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z" />
                                </svg>
                                <span> Área do Gestor</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>