<?php

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

$nome_modulo = null;
if(isset($_GET['nome_modulo'])){
    $nome_modulo = preventToXSS($_GET['nome_modulo']);
}



?>
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
                <center>
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
                                $caminhoPdf = "v2.php?acao=visualizar-pdf&id_aula=" . $id_aula . "&id_pdf=" . $id_pdf;
                                $listaPdfs .= '
                                    <li>
                                        <a href="'.$caminhoPdf.'" target="_blank">PDF 2</a>
                                        <a href="'.$caminhoPdf.'" target="_blank" class="view-btn">Visualizar</a>
                                    </li>
                                ';
                            }

                            $materialApoioBox = '
                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                <div class="collapse" id="collapseMaterialApoio" aria-expanded="false" style="width: 95%;">
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
                        ';


                            $collpaseMaterialApoio = '
                            <div style="width: 90%; text-align: center;">
                            <div class="content d-flex clique mt-1 mb-2" class="collapse" id="toCollapseMaterialApoio" data-target="#collapseMaterialApoio" aria-expanded="false">
                                    <div class="d-flex w-100 pre-teste" class="header-material-apoio" style="background-color: white;">
                                        <div class="d-flex w-100 p-3">
                                            <div>
                                                <div class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                                    <span class="titulo-quiz" style="color: #88E450; font-size: 3vh;">MATERIAL DE APOIO</span>
                                                </div>

                                            </div>

                                            <!-- BLOQUEADO -->
                                            <div class="d-flex ml-auto">
                                                
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            ';

                            $quizBox = '
                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                
                            <div class="collapse" id="collapseQuiz" style="width: 95%;" aria-expanded="false">
                                    
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">
                                        <div class="d-flex flex-column mt-1 p-3">

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
                            
                            <div class="content d-flex clique mt-1 mb-2" id="forOpenQuiz" aria-expanded="false">
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
                            <div class="collapse bottom collapseAula" id="aula'.$id_aula.'" aria-expanded="false" style="width: 90%; background: white;">
                                <div class="content d-flex justify-content-center clique">
                                    <div class="w-100" style="text-align: center; background-color: white;">
                                        <div class="pt-5" style="background-color: black;"">

                                            <video
                                            id="video"
                                            data-id-vid-aula="'.$aula_id_vid.'"
                                            class="video-js"
                                            preload="auto"
                                            width="640"
                                            height="264"
                                            controls
                                            data-setup="{}"
                                            style="width: 100%; height: 300px;"
                                            >
                                            <source src="video.mp4" type="video/mp4" />
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
                                            PRÉ-TESTE
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

                            
                            </div>
                            '.$collapseAula.'

                            <div class="mt-3 mb-5" style="width: 90%; text-align: center;"> 
                            '.$quiz.'
                            
                            '.$quizBox.'

                            </div>
                            <!--- INICIO MATERIAL DE APOIO --->
                            '.$collpaseMaterialApoio.'
                            <!--- FIM MATERIAL DE APOIO --->
                            '.$materialApoioBox.'

                            
                        </div>
                        <!--- FIM AULA --->


                        </div>
        
                        ';
                    echo $modulo;
                    }
                }
            ?>

                </center>
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
    }

    .clique {
        cursor: pointer;
    }

</style>

<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
<script>
    let c1 = 0;
    let quizId = 0;
    let res = [];
    let header = document.querySelector(".pre-teste");
    let aulaId = header.getAttribute('data-id-aula');
    let forOpenQuiz = document.querySelector("#forOpenQuiz");
    var player = videojs('video');
    
    updateInfo();


    function hiddenLeft(element) {
        let nomeAula = element.querySelector('.nome-aula')
        let aula = element.querySelector('.aula');
        var isActive = !document.querySelector('.aula').classList.contains('d-none');
        if (isActive) {
            nomeAula.classList.add('w-100');
            aula.classList.add('d-none');
        } else {
            nomeAula.classList.remove('w-100');
            aula.classList.remove('d-none');
        }

    }



    function sendRequestAssistirAula() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=assistir-aula');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.response);
                let success = response['success'];
                if(success) {
                    updateInfo();
                }
            }
        };

        xhr.send();
    }


    function setWatchedVideo() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=concluir-aula');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.response);
                let success = response['success'];
                if(success) {
                }
            }
        };

        xhr.send();
    }


    function liberarAula() {
        let aula = document.querySelector("#toCollapseAula");
        aula.setAttribute('data-toggle', 'collapse');
    }

    function liberarMaterialApoio() {
        let materialApoio = document.querySelector("#toCollapseMaterialApoio");
        materialApoio.setAttribute('data-toggle', 'collapse');

    }


    function getWatchedVideo() {
        return localStorage.getItem('watchedVideo');
    }

    function hasWatchedVideo() {
        return new Promise((resolve, reject) => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=info-situacao-aula');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response);
                    let success = response['success'];
                    let aula = response['aula'];
                    if(aula) {
                        resolve(true);
                    } else {
                        reject(false);
                    }
                }
            };

            xhr.send();
        });
    }


    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        });
    }


    function proximoPreTeste(btn) {


        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + quizId + "&resposta=" + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
            };

            xhr.send();
        }
    }


    function proximoQuiz(btn) {
        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertQuiz(aulaId);
            }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + res[0]['id_vid_aula'] + "&resposta=" + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertQuiz(aulaId);
            }
            };

            xhr.send();
        }
    }

    function ultimoProximoQuiz() {
        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

            }
            };

            xhr.send();
        }
    }


    function voltarPreTeste() {
        c1 -= 1;


        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-pre-teste');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
        };

        xhr.send();
    }


    function finalizarPreTeste(event) {
        aulaId = res[c1]['id_vid_aula'];
        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz-pre-teste");
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(this.response);
                }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + quizId + "&resposta=" + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                updateInfo();
            }
            };

            xhr.send();
        }
        

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&acao=finalizar-pre-teste');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                let collapsePreTeste = document.getElementById('collapsePreTeste');
                
                document.querySelector('[data-target="#collapsePreTeste"]').removeAttribute('data-toggle');
                collapsePreTeste.classList.remove('show');
            }
        };

        xhr.send();

    }

    function vQuizEstaAberto() {
        let quiz = document.querySelector('#collapseQuiz');
        return quiz.classList.contains('show');
    }

    function updateInfo() {
        watchVideo();
        let quizEstaAberto = vQuizEstaAberto();
        if(quizEstaAberto) {
            bloquearMaterialApoio();
        }

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + "&acao=info-situacao-aula");
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                let preTeste = response.pre_teste;
                let quiz = response.quiz;
                let aula = response.aula;
                let collapsePreTeste = document.getElementById('collapsePreTeste');
                let toCollapaseAula = document.getElementById('toCollapseAula');
                let paused = player.paused()

                if(preTeste) {
                    let header = document.querySelector('.pre-teste-status-header');
                    header.innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>`;

                    document.querySelector('[data-target="#collapsePreTeste"]').removeAttribute('data-toggle');
                    collapsePreTeste.classList.remove('show');

                    if(!quizEstaAberto) {
                        liberarAula();
                        liberarMaterialApoio();
                    }
                }

                if(aula) {
                    document.querySelector('.aula-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>
                    `;

                    if(!quizEstaAberto) {
                        liberarAula();
                        liberarMaterialApoio();
                    }
                }

                if(quiz) {
                    forOpenQuiz.removeAttribute('data-target');
                    document.querySelector('.quiz-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>
                    `;
                }

                if(preTeste && aula && !quiz && !quizEstaAberto) {
                    abrirQuiz();
                }


                let quizFixacao = response.quiz;
            }
        };


        xhr.send();
    }

    function bloquearMaterialApoio() {
        let materialApoio = document.querySelector('#toCollapseMaterialApoio');
        let box = document.querySelector('#collapseMaterialApoio');
        box.classList.remove('show');
        materialApoio.removeAttribute('data-toggle');
    }

    document.querySelector('#toCollapseAula').addEventListener('click', () => {
        updateInfo();
    });

    document.querySelector('#toCollapseMaterialApoio').addEventListener('click', () => {
        updateInfo();
    });

    function naoAbrirAula() {
        let collapseAula = document.querySelector('#toCollapseAula');
        collapseAula.classList.remove('show');
        collapseAula.removeAttribute('data-toggle');
    }

    function abrirAula() {
        let collapseAula = document.querySelector('#toCollapseAula');
        collapseAula.setAttribute('data-toggle', 'collapse');
    }

    function naoAbrirQuiz() {
        let collapseQuiz = document.querySelector('#collapseQuiz');
        collapseQuiz.classList.remove('show');
        collapseQuiz.removeAttribute('data-toggle');
    }

    function abrirQuiz() {
        forOpenQuiz.setAttribute('data-target', '#collapseQuiz');
        forOpenQuiz.setAttribute('data-toggle', 'collapse');
    }

    function aulaEstaAberta() {
        let aula = document.querySelector('#toCollapseAula');
        return aula.classList.contains('show');
    }


    function wasWatchingVideo() {
        let video = document.querySelector('video');
        let time = video.currentTime;

    }


    forOpenQuiz.addEventListener('click', (event) => {
        updateInfo();
        // verificar se o video foi assistido
        hasWatchedVideo().catch(res => {
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            }).fire({
                icon: 'error',
                title: 'Você precisa assistir o vídeo para continuar!'
            });
        });
                            
        watchVideo();
    });

    function watchVideo() {
        hasWatchedVideo().then((res) => {
            document.querySelector('.collapseAula').classList.remove('show');
            document.getElementById('toCollapseAula').removeAttribute('data-toggle');
            // document.querySelector('[data-target="#collapseQuiz"]').setAttribute('data-toggle', 'collapse');

            let headerToCollapseAula = document.querySelector('.aula-status-header');
            headerToCollapseAula.innerHTML = `
            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
            `;
        });
    }



    document.querySelector('.btn-voltar-pre-teste').addEventListener('click', (event) => {
        if(c1 === 0) {
            throw new Error("Não pode voltar!");
        }
        let el = document.querySelector('.btn-proximo-pre-teste');
        if(c1 !== res.length - 2) {
            el.classList.remove('disabled');
        }
        voltarPreTeste()
    
    }); 


    document.querySelector('.btn-voltar-quiz').addEventListener('click', (event) => {
        if(c1 === 0) {
            throw new Error("Não pode voltar!");
        }
        
        c1--;
        insertQuiz(aulaId)

        if(!isLast()) {
            document.querySelector('.btn-proximo-quiz').classList.remove('disabled');
        }
    
    }); 


    document.querySelector('.btn-finalizar-pre-teste').addEventListener('click', (event) => {
        finalizarPreTeste(event);
        updateInfo();
    });

    document.querySelector('.btn-proximo-pre-teste').addEventListener('click', (event) => {

        if(c1 === res.length - 1) {
            throw new Error("Não pode ir!");
        }

        proximoPreTeste(event);

        
        let el = event.target;
        if(c1 === res.length - 2) {
            el.classList.add('disabled');
        }

    });

    document.querySelector('.btn-proximo-quiz').addEventListener('click', (event) => {
        if(c1 === res.length - 1) {
            throw new Error("Não pode ir!");
        }

        proximoQuiz(event.target)


        let el = event.target;
        if(c1 === res.length - 2) {
            el.classList.add('disabled');
        }

    });

    document.querySelector('.btn-finalizar-quiz').addEventListener('click', (event) => {
        ultimoProximoQuiz();
        finalizarQuiz(event);
    });

    let novaTentativa = () => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=nova-tentativa-quiz&quiz_id=' + quizId);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response);
                    let success = response['success'];
                    if(success) {
                        c1 = 0;
                        insertQuiz(aulaId);

                    }
                }
            };
        }

    function mensagemTentarDnv(text) {

        
        return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: text,
            footer: '<a href>Why do I have this issue?</a>'
        });
    }



    function isLast() {
        if(c1 === res.length - 1) {
            return true;
        }
        return false;
    }

    function finalizarQuiz(event) {
        let el = event.target;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=finalizar-quiz&quiz_id=' + quizId);
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response);
            let success = response['success'];
            let aprovado = response['aprovado'];
            let message = response['text'];
            if(success) {
                document.querySelector('.quiz-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div`;

                closeFinalizarQuiz();

                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire({
                    icon: 'success',
                    title: 'Quiz finalizado com sucesso!'
                });
            } else {

                mensagemTentarDnv(message).then((result) => {
                    if(result.isConfirmed) {
                        novaTentativa();
                    }
                });
            }
        
        };
    };

        updateInfo();
        xhr.send();
    }

    function closeFinalizarQuiz() {
        let collapseQuiz = document.getElementById('collapseQuiz');
        collapseQuiz.classList.remove('show');
        document.querySelector('[data-target="#collapseQuiz"]').removeAttribute('data-toggle');
        updateInfo();
    }


    function inputNotaAula() {

        let request = (nota, comentario) => {
            
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=input-nota&nota=' + nota + "&comentario=" + comentario);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response)[0];
                    let success = response['success'];        
                };
                        
            };

            xhr.send();
        }

        Swal.fire({
            title: 'De 0 a 10 o quanto você recomendaria esta aula.',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            html: '<input placeholder="Nota" type="number" max="10" id="swal-input1" class="swal2-input">' + '<input placeholder="Comentário" id="swal-input2" class="swal2-input">',

            preConfirm: function() {
                let nota = document.getElementById('swal-input1').value;
                let comentario = document.getElementById('swal-input2').value;
                request(nota, comentario);

                return new Promise(function(resolve, reject) {
                    resolve({
                        nota: document.getElementById('swal-input1').value,
                        comentario: document.getElementById('swal-input2').value,
                    });
                });
            },
            showCancelButton: true,
        }).then((result) => {
            if (result.value.nota <= 10) {
                Swal.fire({
                    title: 'Nota inserida com sucesso!',
                });
            } else if(result.value.nota > 10) {
                Swal.fire({
                    title: 'Nota inválida!<br>Digite novamente.',
                }).then((result) => {
                    inputNotaAula();
                });
                
            }
        })
    }


    function insertPreTeste(aulaId) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-pre-teste');
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response)[0];
            res = response['result'];
            let resLast = res.length - 1;
            let success = response['success'];
            let questoes = '';
            let titulo = document.querySelector('.titulo-quiz-pre-teste');
            titulo.innerHTML = '';
            if(success) {
                document.querySelector('.questoes-pre-teste').innerHTML = '';      

                let key = res[c1];
                let id = key['id_pre_teste'];
                quizId = id;

                let alternativaA = key['alternativa_a'];
                let alternativaB = key['alternativa_b'];
                let alternativaC = key['alternativa_c'];
                let alternativaD = key['alternativa_d'];
                let alternativaE = key['alternativa_e'];

                let pergunta = key['pergunta'];
                titulo.innerHTML = pergunta;
                
                let a = '<div data-questao-id="'+ id +'" class="mt-3"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="A" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaA +'</span> </span></div>';
                document.querySelector('.questoes-pre-teste').innerHTML += a;
                let b = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="B" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaB +'</span> </span></div>';
                document.querySelector('.questoes-pre-teste').innerHTML += b;
                let c = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="C" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaC +'</span> </span></div>';
                document.querySelector('.questoes-pre-teste').innerHTML += c;


                if(alternativaD) {
                    d = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="D" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                    document.querySelector('.questoes-pre-teste').innerHTML += d;
                }

                if(alternativaE) {
                        let e = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="E" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                        document.querySelector('.questoes-pre-teste').innerHTML += e;
                }
            }
            }
        };
        xhr.send();
    }


    function insertQuiz(aulaId) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-quiz');
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response)[0];
            res = response['result'];
            let resLast = res.length - 1;
            let success = response['success'];
            let questoes = '';
            let titulo = document.querySelector('.titulo-quiz-quiz');
            titulo.innerHTML = '';
            if(success) {
                document.querySelector('.questoes-quiz').innerHTML = '';      
                let key = res[c1];
                let id = key['id_quiz'];
                quizId = id;

                let alternativaA = key['alternativa_a'];
                let alternativaB = key['alternativa_b'];
                let alternativaC = key['alternativa_c'];
                let alternativaD = key['alternativa_d'];
                let alternativaE = key['alternativa_e'];

                let pergunta = key['pergunta'];
                titulo.innerHTML = pergunta;
                
                let a = '<div data-questao-id="'+ id +'" class="mt-3"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="A" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaA +'</span> </span></div>';
                document.querySelector('.questoes-quiz').innerHTML += a;
                let b = '<div data-questao-id="'+ id +'"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="B" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaB +'</span> </span></div>';
                document.querySelector('.questoes-quiz').innerHTML += b;
                let c = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="C" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaC +'</span> </span></div>';
                document.querySelector('.questoes-quiz').innerHTML += c;


                if(alternativaD) {
                    d = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="D" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                    document.querySelector('.questoes-quiz').innerHTML += d;
                }

                if(alternativaE) {
                        let e = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><input type="checkbox" onclick="onlyOne(this)" id="1" name="check" value="E" id="" style="width: 50px;"><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                        document.querySelector('.questoes-quiz').innerHTML += e;
                }
        

            }
            }
        };
        xhr.send();
    }

    function materialApoioEstaAberto() {
        let materialApoio = document.querySelector('#collapseMaterialApoio');
        let materialApoioAberto = materialApoio.classList.contains('show');
        if(materialApoioAberto) {
            return true;
        } else {
            return false;
        }
    }

    document.querySelector(".quiz-fixacao-header").addEventListener('click', () => {
        let materialApoio = materialApoioEstaAberto();
        if(materialApoio) {
            document.querySelector('#collapseMaterialApoio').classList.remove('show');
        }
        updateInfo();
        insertQuiz(aulaId);
    });

    
    header.addEventListener('click', () => {
        insertPreTeste(aulaId);
    });


    function redirect(id) {
        location.href = "home.php?acao=treinamento-video&id_vid=" + id;
    }

    let handleWatchedVideo = false;
    player.on('timeupdate', function() {
        var duration = player.duration();
        var currentTime = player.currentTime();
        var threshold = duration * 1; // verificar se o usuário assistiu a 100% do vídeo

        if (currentTime >= threshold && handleWatchedVideo != true) {
            handleWatchedVideo = true;

            console.log('vídeo assistido');
            player.pause();
            setWatchedVideo();
            inputNotaAula();
        }
    });
</script>


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