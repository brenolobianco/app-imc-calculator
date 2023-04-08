<<<<<<< HEAD
<?php include_once 'controllers/log/logado.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <meta name="description" content="">


    <title>Área do Acadêmico</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/css-personalizado/img-sobreposta.css">
    <link rel="stylesheet" href="assets/css-personalizado/responsivo.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <style>
        .place_form {
            border-radius: 25px;
            background-color: #757575;
            text-align: center;
            color: #fff;

        }

        .place_form::placeholder {
            color: #fff;
            text-align: center;


        }

        .place_form2 {
            border-radius: 25px;
            background-color: #065021;
            text-align: center;
            color: #fff;

        }

        .place_form2::placeholder {
            color: #fff;
            text-align: center;


        }

        .form_espaco {
            margin-top: 30px;
        }

        .zoom {
            transition: transform .2s;
            /* Animation */
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(1.1);

        }
    </style>

    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

</head>

<body>
    <?php include_once 'whats.php'; ?>
    <section class="menu menu3 cid-taGdXBPlfb" once="menu" id="menu3-0">

        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="home.php?">
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
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=estagio">Estágio</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=pesquisa">Pesquisa</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="https://docs.google.com/forms/d/e/1FAIpQLSd3XgJCo8ab5JBEIpXv4r30Msg68PlvQKcn6ta0zfbIIy8tFw/viewform" target="_blank">Huber</a></li>
                        <?php if (!isset($_SESSION['isMed'])) : ?>
                            <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=perfil&id_acad=<?= $idLog; ?>">Perfil</a></li>
                        <?php endif; ?>
                        <?php

                        if (!isset($_SESSION['isMed'])) {
                            $select = "SELECT * from matricula m 
                            JOIN curso c ON c.id_curso = curso_id_mat 
                            WHERE acad_id_mat = $idLog && pag_mat = 'Conferir'";

                            try {
                                $result = $conexao->prepare($select);
                                $result->execute();
                                $contar = $result->rowCount();

                                if ($contar > 0) {
                                    while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

                        ?>
                                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=etapa-0b&id_est=<?= $mostra->est_id_mat ?>">
                                                <strog style="color: orange;">CONFIRMAR PAGAMENTO</strog>
                                            </a></li>
                        <?php

                                    }
                                } else {
                                    echo '';
                                }
                            } catch (PDOException $e) {
                                echo $e;
                            }
                        }
                        ?>

                    </ul>
                    <div class="navbar-buttons mbr-section-btn"><a class="btn btn-white display-4" href="?sair" onClick="return confirm('Deseja realmente sair?')" style="width: 100px;">Sair</a></div>

                </div>
            </div>
        </nav>
=======
<?php include_once 'controllers/log/logado.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <meta name="description" content="">


    <title>Área do Acadêmico</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/css-personalizado/img-sobreposta.css">
    <link rel="stylesheet" href="assets/css-personalizado/responsivo.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <style>
        .place_form {
            border-radius: 25px;
            background-color: #757575;
            text-align: center;
            color: #fff;

        }

        .place_form::placeholder {
            color: #fff;
            text-align: center;


        }

        .place_form2 {
            border-radius: 25px;
            background-color: #065021;
            text-align: center;
            color: #fff;

        }

        .place_form2::placeholder {
            color: #fff;
            text-align: center;


        }

        .form_espaco {
            margin-top: 30px;
        }

        .zoom {
            transition: transform .2s;
            /* Animation */
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(1.1);

        }
    </style>

    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

</head>

<body>
    <?php include_once 'whats.php'; ?>
    <section class="menu menu3 cid-taGdXBPlfb" once="menu" id="menu3-0">

        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="home.php?">
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
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=estagio">Estágio</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=pesquisa">Pesquisa</a></li>
                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="https://docs.google.com/forms/d/e/1FAIpQLSd3XgJCo8ab5JBEIpXv4r30Msg68PlvQKcn6ta0zfbIIy8tFw/viewform" target="_blank">Huber</a></li>
                        <?php if (!isset($_SESSION['isMed'])) : ?>
                            <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=perfil&id_acad=<?= $idLog; ?>">Perfil</a></li>
                        <?php endif; ?>
                        <?php

                        if (!isset($_SESSION['isMed'])) {
                            $select = "SELECT * from matricula m 
                            JOIN curso c ON c.id_curso = curso_id_mat 
                            WHERE acad_id_mat = $idLog && pag_mat = 'Conferir'";

                            try {
                                $result = $conexao->prepare($select);
                                $result->execute();
                                $contar = $result->rowCount();

                                if ($contar > 0) {
                                    while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

                        ?>
                                        <li class="nav-item"><a class="nav-link link text-white text-primary display-4" href="home.php?acao=etapa-0b&id_est=<?= $mostra->est_id_mat ?>">
                                                <strog style="color: orange;">CONFIRMAR PAGAMENTO</strog>
                                            </a></li>
                        <?php

                                    }
                                } else {
                                    echo '';
                                }
                            } catch (PDOException $e) {
                                echo $e;
                            }
                        }
                        ?>

                    </ul>
                    <div class="navbar-buttons mbr-section-btn"><a class="btn btn-white display-4" href="?sair" onClick="return confirm('Deseja realmente sair?')" style="width: 100px;">Sair</a></div>

                </div>
            </div>
        </nav>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
    </section>