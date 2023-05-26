<?php include_once 'controllers/log/logado.php';

// PERMISSOES
$res_permissao = $conexao->prepare("SELECT * FROM permissao_setor WHERE id_login = :id");
$res_permissao->bindParam(':id', $idLogado, PDO::PARAM_INT);
$res_permissao->execute();

$perm = array("medico" => 0);

if (isset($perm['medico']) && $perm['medico'] > 1) {
    echo "sem permissão agora! agora tem que fazer esse trabalho manual aí, é bem chato hehe";
    echo "essa foi minha pequena contribuição. Qualquer coisa só chamar!blz";
    // aqui vai retornar false, agora vai retornar true mesmo sem permissão 
}
if ($res_permissao->rowCount() > 0) {
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
</head>

<body data-sidebar="dark">
    <div id="wrapper">
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="pro-user-name ml-1">
                            <?php echo $nomeLogado; ?> <i class="mdi mdi-chevron-down"></i>
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
                        <?php if (isset($perm->dashboard) && $perm->dashboard) { ?>
                            <li>
                                <a href="home.php?">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                        <?php }
                        if (isset($perm->conteudo) && $perm->conteudo) { ?>
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
                        if (isset($perm->ranking)) { ?>
                            <li>
                                <a href="home.php?acao=lista-ranking">
                                    <i class="mdi mdi-chart-bar-stacked"></i>
                                    <span> Ranking </span>

                                </a>

                            </li>
                        <?php }

                        if (isset($perm->academico) && ($perm->Academicos_Cadastrados || $perm->Academicos_Matriculados || $perm->Academicos_Lista_Aprovados || $perm->Academicos_Cracha)) { ?>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> Acadêmicos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <?php if ($perm->Academicos_Cadastrados) { ?>
                                        <li><a href="home.php?acao=academicos">Cadastrados</a></li>
                                    <?php }
                                    if ($perm->Academicos_Matriculados) { ?>
                                        <li><a href="home.php?acao=matriculas">Matriculados</a></li>
                                    <?php }
                                    if ($perm->Academicos_Lista_Aprovados) { ?>
                                        <li><a href="home.php?acao=lista-de-aprovados">Lista de Aprovados</a></li>
                                    <?php }
                                    if ($perm->Academicos_Cracha) { ?>
                                        <li><a href="home.php?acao=cracha">Crachá</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                        if (isset($perm->medico) && $perm->Medicos_Cadastrados) { ?>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-account-details-outline"></i>
                                    <span> Médicos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <?php if ($perm->Medicos_Cadastrados) { ?>
                                    <ul class="nav-second-level nav" aria-expanded="false">
                                        <li><a href="home.php?acao=medicos">Cadastrados</a></li>

                                    </ul><?php } ?>
                            </li>
                        <?php }
                        if (isset($perm->professor) || $perm->Professores_Novo_Professor || $perm->{"Professores_Profs_Cadastrados"}) { ?>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-account"></i>
                                    <span> Professores </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <?php if ($perm->Professores_Novo_Professor) { ?>
                                        <li><a href="home.php?acao=novo-professor">Novo Professor</a></li>
                                    <?php }
                                    if ($perm->{"Professores_Profs_Cadastrados"}) { ?>
                                        <li><a href="home.php?acao=professores">Prof´s Cadastrados</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                        if (isset($perm->hospital) && $perm->Hospitais_Hospitas || $perm->Hospitais_Estagios || $perm->Hospitais_Editais) { ?>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-home"></i>
                                    <span> Hospitais </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <?php if ($perm->Hospitais_Hospitas) { ?>
                                        <li><a href="home.php?acao=hospitais">Hospitas</a></li>
                                    <?php }
                                    if ($perm->Hospitais_Estagios) { ?>
                                        <li><a href="home.php?acao=estagios">Estágios</a></li>
                                    <?php }
                                    if ($perm->Hospitais_Editais) { ?>
                                        <li><a href="home.php?acao=editais-pdf">Editais</a></li>
                                    <?php } ?>
                                    <li>Pesquisas ( Indisponível )</li>
                                </ul>
                            </li>
                        <?php }


                        if (isset($perm->curso) && $perm->Cursos_Cursos || $perm->Cursos_Módulos || $perm->Cursos_Quiz || $perm->Cursos_Quiz_Pre_Teste || $perm->Cursos_Aula) { ?>
                                                <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-layers"></i>
                                <span> Treinamento hospitalar </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=modulos&treinamento=true">Módulos</a></li>
                                <li><a href="home.php?acao=aulas-treinamento-v2">Aulas</a></li>
                                <!-- <li><a href="home.php?acao=aula-treinamento-v2-video-aula">Video Aula</a></li> -->
                                <li><a href="home.php?acao=quiz-pre-teste">Quiz pre-aula</a></li>
                                <li><a href="home.php?acao=quiz">Quiz de fixação</a></li>

                                <!-- <li><a href="home.php?acao=cursos">Cursos</a></li> -->
                                <li><a href="home.php?acao=aula-treinamento-v2-video-aula-pdf">Material de apoio</a></li>

                                <!--
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Aulas
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="home.php?acao=aulas">Aulas</a></li>
                                            <li><a href="home.php?acao=aulas-videos">Vídeo Aula</a></li>
                                            <li><a href="home.php?acao=aulas-pdf">PDF Aula</a></li>    
                                        </ul>
                                    </li>
                                -->
                            </ul>
                        </li>

                        
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-layers"></i>
                                <span> Avaliacao </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li><a href="home.php?acao=avaliacoes">Avaliacoes</a></li>
                            </ul>
                        </li>

                        
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-file-account"></i>
                                <span> Cursos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="home.php?acao=cursos">Curso</a></li>
                                <li><a href="home.php?acao=modulos">Módulo</a></li>
                                <li><a href="home.php?acao=aulas">Aula</a></li>
                                <li><a href="home.php?acao=aulas-pdf">Material de apoio</a></li>
                            </ul>
                        </li>

                        <?php }
                        if (isset($perm->area_gestor) && $perm->Area_Gestor_Permutas || $perm->Area_Gestor_Notificacao || $perm->Area_Gestor_Comportamento || $perm->Area_Gestor_Desempenho || $perm->Area_Gestor_Frequencia) { ?>
                            <li>
                                <a href="home.php?acao=area-gestor">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                                        <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z" />
                                    </svg>
                                    <span> Área do Gestor</span>
                                </a>
                            </li>
                        <?php }
                        if (isset($perm->Usuario_Cadastro_Permissao) && $perm->Usuario_Cadastro_Permissao) { ?>
                            <li>
                                <a href="home.php?acao=usuario">
                                    <i class="mdi mdi-account"></i>
                                    <span> Setor </span>
                                    <span class="menu-arrow"></span>
                                </a>
                            </li>
                        <?php }

                        ?>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>