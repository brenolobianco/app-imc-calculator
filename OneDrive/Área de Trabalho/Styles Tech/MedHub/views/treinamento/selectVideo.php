<?php

//include_once 'vendor/autoload.php';

// use nvan\BabelTranspiler\Transpiler;

include_once 'controllers/aulaVideo/ControllerSelect.php';


function getAulasModulos($conexao, $id_mod){
    $select = "SELECT * FROM aula LEFT JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula WHERE mod_id_aula=:mod_id_aula AND treinamento = 'sim' ORDER BY aula.mod_id_aula ASC, aula.id_aula ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':mod_id_aula', $id_mod, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function getAulasByAulaVid($conexao, $id_vid){
    $select = "SELECT * FROM aula_vid LEFT JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid GROUP BY aula.id_aula ORDER BY aula.mod_id_aula ASC, aula.id_aula ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModuloByAulaVid($conexao, $aula_vid_id){
    $select = "SELECT * FROM aula_vid LEFT JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid GROUP BY aula.id_aula ORDER BY aula.mod_id_aula ASC, aula.id_aula ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $aula_vid_id, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModulo($conexao, $id_est) {

    $select = "SELECT * FROM modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim";

    $result = $conexao->prepare($select);
    $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function preventToXSS($text) {
    $text = trim($text);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);
    return $text;
}

function getPdfs($conexao, $id_aula) {
    $select = "SELECT * FROM aula_pdf WHERE aula_id_pdf = :id_aula ORDER BY id_pdf";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function videoJsUrl($conexao, $id_vid) {
    $aula = getAulasByAulaVid($conexao, $id_vid);
    $video = $aula->FETCH(PDO::FETCH_OBJ);
    $arqVid  = $video->arq_vid;
    $aulaIdVid = $video->id_vid;
    $caminho = "/videos/$aulaIdVid/$arqVid";

    return $caminho;
}

$videoJsPath = videoJsUrl($conexao, $id_vid);

$nome_modulo = null;
if(isset($_GET['nome_modulo'])){
    $nome_modulo = preventToXSS($_GET['nome_modulo']);
}


?>
<style>
    .vjs-default-skin .vjs-big-play-button {
  /* The font size is what makes the big play button...big. 
     All width/height values use ems, which are a multiple of the font size.
     If the .video-js font-size is 10px, then 3em equals 30px.*/
  font-size: 3em;
  /* We're using SCSS vars here because the values are used in multiple places.
     Now that font size is set, the following em values will be a multiple of the
     new font size. If the font-size is 3em (30px), then setting any of
     the following values to 3em would equal 30px. 3 * font-size. */
  /* 1.5em = 45px default */
  line-height: 1.5em;
  height: 1.5em;
  width: 3em;
  /* 0.06666em = 2px default */
  border: 0.06666em solid #fff;
  /* 0.3em = 9px default */
  border-radius: 0.3em;
  /* Align top left. 0.5em = 15px default */
  left: 0.5em;
  top: 0.5em;
}
</style>
<link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" onclick="javascript:window.history.back()">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>


<section class="header11 cid-tbTu6UKcUD" id="header11-2u" style="margin-top: -50px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="curso-per col-12 col-md-12 image-wrapper">
                <br>
                <div>
                <?php 

                $modulos = getModuloByAulaVid($conexao, $id_vid);
                $modulosCount = $modulos->rowCount();
                if($modulosCount>0){
                    $estagios = []; // contar modulo 1, 2, 3 -> 01, 02, 03
                    while($mostra = $modulos->FETCH(PDO::FETCH_OBJ)){
                        $est_id_mod = $mostra->est_id_aula;
                        $id_mod = $mostra->mod_id_aula;
                        array_push($estagios, $est_id_mod);
                        $num = count($estagios);
                        $aulas = getModuloByAulaVid($conexao, $id_vid);


                        $aulas = '';
                        $aulasFetch = getAulasByAulaVid($conexao, $id_vid);
                        while($fetchAula = $aulasFetch->FETCH(PDO::FETCH_OBJ)) {
                            $id_vid = $fetchAula->id_vid;
                            $id_aula = $fetchAula->id_aula;
                            $aula_id_vid = $fetchAula->aula_id_vid;
                            $caminhoPdf = "v2.php?acao=visualizar-pdf&id_aula=" . $id_aula;


                            $listaPdfs = '';
                            $pdfs = getPdfs($conexao, $id_aula);
                            while($pdf = $pdfs->FETCH(PDO::FETCH_OBJ)) {
                                $id_pdf = $pdf->id_pdf;
                                $aula_id_pdf = $pdf->aula_id_pdf;
                                $caminhoPdf = $pdf->caminho_pdf;
                                $nomePdf = $pdf->nome_pdf;
                                $caminhoPdf = "v2.php?acao=visualizar-pdf&id_aula=" . $id_aula . "&id_pdf=" . $id_pdf;
                                $listaPdfs .= '
                                    <li>
                                        <a href="'.$caminhoPdf.'" target="_blank">'.$nomePdf.'</a>
                                        <a href="'.$caminhoPdf.'" target="_blank" class="view-btn">Visualizar</a>
                                    </li>
                                ';
                            }

                            $materialApoioBox = '
                            <div class="quiz-box d-flex row" style="justify-content: center;align-content: center;">

                                <div class="collapse col" id="collapseMaterialApoio"  style="width: 95%;" aria-expanded="false">
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">
                                        <div class="col-md-12 d-flex flex-column mt-1 p-3">
                                            <div class="pdf-list w-100">
                                                <ul>
                                                    '.$listaPdfs.'
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        ';


                            $collpaseMaterialApoio = '
                            
                            <div style="width: 100%; text-align: center;" class="clique collapse d-flex justify-content-center mb-5 mt-3 p-0">
                                <div style="width: 90%" id="toCollapseMaterialApoio" data-target="#collapseMaterialApoio" aria-expanded="false">
                                        <div class="d-flex w-100 pre-teste" class="header-material-apoio" style="background-color: white;">
                                            <div class="d-flex w-100 p-3">
                                                <div>
                                                    <div class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                                        <span class="titulo-quiz" style="color: #88E450; font-size: 3vh;">MATERIAL DE APOIO</span>
                                                    </div>
                                                </div>

                                                <!-- BLOQUEADO -->
                                                <div class="d-flex ml-auto status-material-apoio-header">

                                                </div>
                                        </div>
                                    </div>
                            ';

                            $quizBox = '
                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                
                            <div class="collapse" id="collapseQuiz" style="width: 95%;" aria-expanded="false">
                                    
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">
                                        <div class="d-flex flex-column mt-1 p-3">

                                        <div class="d-flex flex-column mt-1 p-1 ml-auto">
                                            <p class="titulo-quiz mb-3 text-right">NÚMERO TENTATIVAS: <span class="numero-tentativas">00</p>
                                        </div>

                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                            </div>


                                            <div class="quizes">
                                                <div>
                                                    <span class="texto-modulo-accordion titulo-quiz-quiz titulo-quiz" style="color: #88E450; font-size: 3vh;">
                                                    </span>
                                                    
                                                        <div class="questoes-quiz mt-3 mb-3">
                                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                                            <span class="titulo-quiz mb-3">QUESTÂO <span class="numero-quiz">01</span> -
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column mt-1 p-3 ml-auto">
                                                    
                                            <div>
                                                <div>
                                                        <div class="questoes-quiz mb-3">
                                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="botoes d-flex col-md-12">
                                        <button class="radius-quiz btn bg-white w-25 btn-voltar-quiz">

                                            <span style="font-size: 1em;">VOLTAR</span>
                                        </button>
                                        <button class="radius-quiz btn bg-white w-25 btn-proximo-quiz">PRÓXIMO</button>
                                        <button class="radius-quiz btn bg-white w-25 btn-finalizar-quiz"
                                            style="margin-left: 20%;">FINALIZAR</button>
                                    </div>
                                </div>
                            </div>
                            ';

                            $quizPreTeste = '
                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                <div class="collapse" id="collapsePreTeste" aria-expanded="false" style="width: 95%;">
                                    
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">
                                        <div class="d-flex flex-column mt-1 p-3">

                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                            </div>


                                            <div class="quizes">
                                                <div>
                                                    <span class="texto-modulo-accordion titulo-quiz-pre-teste titulo-quiz" style="color: #88E450; font-size: 3vh;">
                                                    </span>
                                                    
                                                        <div class="questoes-pre-teste mt-3 mb-3">
                                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                                            <span class="titulo-quiz mb-3">QUESTÂO <span class="numero-quiz">01</span> -
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="botoes d-flex col-md-12">
                                        <button class="radius-quiz btn bg-white w-25 btn-voltar-pre-teste">

                                            <span style="font-size: 1em;">VOLTAR</span>
                                        </button>
                                        <button class="radius-quiz btn bg-white w-25 btn-proximo-pre-teste">PRÓXIMO</button>
                                        <button class="radius-quiz btn bg-white w-25 btn-finalizar-pre-teste"
                                            style="margin-left: 20%;">FINALIZAR</button>
                                    </div>
                                </div>
                            </div>
                            ';

                            $quiz = '
                            
                            <div class="content d-flex clique mt-1 mb-2" style="width: 90%;" id="forOpenQuiz" aria-expanded="false">
                            <div class="d-flex w-100 quiz-fixacao-header" style="background-color: white;">
                                    <div class="d-flex w-100 p-3">
                                        <span class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                            Quiz de fixação
                                        </span>

                                        <span class="mr-3 texto-modulo-accordion-minusculo info-res">
                                        </span>
                                        <div class="quiz-status-header" class="max" style="max-width: 30px;">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                            
                            $collapseAula = '
                            <div class="collapse bottom collapseAula" id="aula'.$id_aula.'" aria-expanded="false" style="width: 100%;">
                                <div class="content d-flex justify-content-center clique">
                                    <div style="text-align: center; background-color: white; width: 90%;">
                                        <div class="pt-5" style="background-color: black; height: 300px; width: 100%; ">

                                            <video
                                            id="video"
                                            data-id-vid-aula="'.$aula_id_vid.'"
                                            class="video-js vjs-big-play-centered vjs-icon-play"
                                            preload="auto"
                                            width="640"
                                            height="264"
                                            controls
                                            data-setup="{  playbackRates: [0.5, 1, 1.5, 2]
                                            }"
                                            style="width: 100%; height: 100%;"
                                            >
                                            <source src="'.$videoJsPath.'" type="video/mp4" />
                                            <p class="vjs-no-js">
                                                To view this video please enable JavaScript, and consider upgrading to a
                                                web browser that
                                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                                >supports HTML5 video</a
                                                >
                                            </p>
                                                </video>
                                  
                                        </div>
                                    </div>
                                </div>
                                                                  
                            </div>
                            ';

                            $collapseTeste = '';
                            $preTeste = '
                            <div class="content d-flex clique mt-1 mb-2" data-toggle="collapse" data-target="#collapsePreTeste" aria-expanded="false">
                            <div class="d-flex w-100 pre-teste header-preteste" data-id-aula="'.$aula_id_vid.'" style="background-color: white;">
                                    <div class="d-flex w-100 p-3">
                                        <span class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                            PRÉ-AULA
                                        </span>
                                        
                                        <span class="mr-3 texto-modulo-accordion-minusculo pre-teste-status-header">

                                        </span>
                                    </div>
                                </div>
                            </div>
                            '.$quizPreTeste.'
                            ';


                            $aulas .= '
                            <div class="mt-3">
                                <div class="d-flex content w-100" ">

                                

                                    <div id="toCollapseAula" aria-expanded="false" data-target="#aula'.$id_aula.'"
                                        class="collapse-aula bg-white nome-aula d-flex alinhar" style="width: 100%;">
                                        <span class="alinhar texto-modulo-accordion-minusculo" data-id-aula="'.$id_aula.'">AULA - '.$fetchAula->nome_aula.'</span>
                                    </div>


                                    <div class="mr-auto bg-white ml-n3 p-4">
                                        <div class="aula-status-header" class="max" style="max-width: 30px;">

                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            ';

                            
                        }

                        $modulo = '
                        <div class="modulo">
                            <div class="content d-flex justify-content-center mt-3">
                                <div class="row align-items-center clique" style="width: 90%;" data-toggle="collapse"
                                     aria-expanded="true" aria-controls="">
                                    <div class="col-md-12 col-sm-12 show" style="background: #737373;">
                                        <p class="mt-3 texto-modulo" style="color: #88E450; font-weight: 800; text-align:left;">
                                            '.$nome_modulo.'
                                        </p>
                                    </div>
                                </div>
                            </div>


                        <!--- INICIO AULA --->
                        <div class="content mt-3 d-flex justify-content-center clique">
                            
                            <div style="width: 90%; text-align: center;" id="modulo'.$id_mod.'"
                                aria-labelledby="headingOne" data-id-aula="1">
                                    '.$preTeste.'
                                    <!--- INICIO LISTA AULAS--->
                                    '.$aulas.'

                                    <!--- FIM LISTA AULAS--->
                            </div>
                            
                        </div>

                            '.$collapseAula.'


                            <div class="content d-flex justify-content-center clique mt-3 mb-1 text-center"> 
                            '.$quiz.'

                            </div>
                            '.$quizBox.'

                            <!--- INICIO MATERIAL DE APOIO --->
                            '.$collpaseMaterialApoio.'
                            <!--- FIM MATERIAL DE APOIO --->
                            '.$materialApoioBox.'

                            
                        </div>
                        <!--- FIM AULA --->

                            </div>

                        </div>
                    </div>
        
                        ';
                    echo $modulo;
                    }
                }
            ?>

            </div>
        </div>
    </div>
</section>


<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">

<style>
    .radius-quiz {
        border-radius: "30px 30px 30px 30px";
    }
    .texto-modulo {
        font-size: 3vh;
        text-shadow:
            1px 1px 1px #eaeaea,
            1px 1px 0px #ccc,
            1px 1px 0px #777,
            1px 1px 0px #333;
    }

    ::placeholder { 
        color: black;
        opacity: 1; 
    }

    .alinhar {
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        .texto-modulo {
            font-size: 2vh;
        }

        .texto-mudulo-accordion {
            font-size: 1vh;
        }
    }

    .texto-mudulo-accordion {
        font-size: 3vh;
        font-weight: 600;
        text-transform: uppercase;
    }

    .texto-modulo-accordion-minusculo {
        font-size: 3vh;
        font-weight: 600;
    }

    .titulo-quiz {
        font-weight: 800;
        text-align: initial;
    }

    .clique {
        cursor: pointer;
    }
</style>

<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
<script src="js/treinamento.js?v=<?= rand(1, 9999) ?>"></script>


<style>
    .pdf-list {
  width: 500px;
  margin: 0 auto;
}
.pdf-list ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.pdf-list li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #ccc;
}
.pdf-list li a {
  color: #333;
  text-decoration: none;
}
.pdf-list li a:hover {
  text-decoration: underline;
}
.pdf-list li .view-btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
}
.pdf-list li .view-btn:hover {
  background-color: #0069d9;
}

</style>


<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>