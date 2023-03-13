<?php

include_once 'controllers/aulaVideo/ControllerSelect.php';

function getAulasModulos($conexao, $id_mod){
    $select = "SELECT * FROM aula INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula WHERE mod_id_aula=:mod_id_aula AND treinamento = 'sim' ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':mod_id_aula', $id_mod, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function getAulasByAulaVid($conexao, $id_vid){
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModuloByAulaVid($conexao, $aula_vid_id){
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $aula_vid_id, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModulo($conexao, $id_est) {

    $select = "SELECT * FROM modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


?>
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
                            $arq_vid = $fetchAula->arq_vid;
                            $id_vid = $fetchAula->id_vid;
                            $id_aula = $fetchAula->id_aula;
                            $aula_id_vid = $fetchAula->aula_id_vid;

                            $quizBox = '
                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                <div class="collapse" id="collapseQuiz" aria-expanded="false" style="width: 95%;">
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">

                                        <div class="d-flex flex-column mt-3 p-3">

                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                                <span class="titulo-quiz">QUESTÂO QUIZ<span class="titulo-quiz">01</span> -
                                                    <span class="titulo-quiz">'.$fetchAula->nome_aula.'</span></span>
                                            </div>


                                            <div class="questoes mt-5">

                                            </div>


                                        </div>

                                    </div>

                                    <div class="botoes d-flex col-md-12">
                                        <button class="radius-quiz btn bg-white w-25 ">
                                            <div style="width: 20%; text-align: left;">
                                                <img class="ml-n5" src="/assets/images/voltar-dark.png" alt=""
                                                    style="max-width: 100%;">
                                            </div>
                                            <span style="font-size: 1em;">VOLTAR</span>
                                        </button>
                                        <button class="radius-quiz btn bg-white w-25 btn-proximo-quiz">PRÓXIMO</button>
                                        <button class="radius-quiz btn bg-white w-25"
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
                                                    <span class="texto-modulo-accordion titulo-quiz-pre-teste" style="color: #88E450; font-size: 3vh;">
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
                                        <button class="radius-quiz btn bg-white w-25">
                                            <div style="width: 20%; text-align: left;">
                                                <img class="ml-n5" src="/assets/images/voltar-dark.png" alt=""
                                                    style="max-width: 100%;">
                                            </div>
                                            <span style="font-size: 1em;">VOLTAR</span>
                                        </button>
                                        <button class="radius-quiz btn bg-white w-25 btn-proximo-pre-teste">PRÓXIMO</button>
                                        <button class="radius-quiz btn bg-white w-25"
                                            style="margin-left: 20%;">FINALIZAR</button>
                                    </div>
                                </div>
                            </div>
                            ';

                            $quiz = '
                            
                            <div class="content d-flex clique mt-1 mb-2" data-toggle="collapse" data-target="#collapseQuiz"
                            aria-expanded="false">
                            <div class="d-flex w-100" style="background-color: white;">
                                    <div class="d-flex w-100 p-3">
                                        <span class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                            Quiz de fixação
                                        </span>
                                        <span class="mr-3 texto-modulo-accordion-minusculo">
                                            X
                                        </span>
                                    </div>
                                </div>
                            </div>
                            ';
                            
                            $collapseAula = '
                            <div class="collapse bottom" id="aula'.$id_aula.'" aria-expanded="false" style="width: 90%; background: white;">
                                <div class="content d-flex justify-content-center clique">
                                    <div class="w-100" style="text-align: center; background-color: white;">
                                        <div class="pt-5" style="background-color: black;">
                                            <video width="80%" height="300" data-id-vid-aula="'.$aula_id_vid.'" controls>
                                                <source src="video.mp4" type="video/mp4">
                                                Seu navegador não suporta video.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                                                                  
                                '.$quiz.'
                                '.$quizBox.'
                            </div>
                            ';

                            $collapseTeste = '';
                            $preTeste = '
                            <div class="content d-flex clique mt-1 mb-2" data-toggle="collapse" data-target="#collapsePreTeste"
                            aria-expanded="false">
                            <div class="d-flex w-100 pre-teste" class="header-preteste" data-id-aula="'.$aula_id_vid.'" style="background-color: white;">
                                    <div class="d-flex w-100 p-3">
                                        <span class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                            PRÉ-TESTE
                                        </span>
                                        <span class="mr-3 texto-modulo-accordion-minusculo">
                                            X
                                        </span>
                                    </div>
                                </div>
                            </div>
                            '.$quizPreTeste.'
                            ';


                            $aulas .= '
                            <div class="mt-3">
                                <div class="d-flex content w-100" onclick="hiddenLeft(this)">

                                

                                    <div data-toggle="collapse"  aria-expanded="false" data-target="#aula'.$id_aula.'"
                                        class="collapse-aula bg-white nome-aula d-flex alinhar" style="width: 100%;">
                                        <span class="alinhar texto-modulo-accordion-minusculo" data-id-aula="'.$id_aula.'">AULA - '.$fetchAula->nome_aula.'</span>
                                    </div>


                                    <div class="mr-auto bg-white ml-n3">
                                        <div class="max" style="max-width: 42px;">
                                            <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
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
                                            MODULO 01
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

                            
                            <!--- INICIO MATERIAL DE APOIO --->
                            <div style="width: 90%; text-align: center;">
                                <div class="content d-flex clique mt-1 mb-2" data-toggle="collapse" data-target="#collapseMaterialApoio" aria-expanded="false">
                                    <div class="d-flex w-100 pre-teste" class="header-preteste" style="background-color: white;">
                                        <div class="d-flex w-100 p-3">
                                            <span class="mr-auto ml-3 texto-modulo-accordion-minusculo">
                                                MATERIAL DE APOIO
                                            </span>
                                            <div class="max" style="max-width: 42px;">
                                                <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- FIM MATERIAL DE APOIO --->

                            
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
    .texto-modulo {
        font-size: 3vh;
        text-shadow:
            1px 1px 1px #eaeaea,
            1px 1px 0px #ccc,
            1px 1px 0px #777,
            1px 1px 0px #333;
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

    .radius-quiz {
        border-radius: "30px 30px 30px 30px";
    }
</style>

<script>
    let c1 = 0;
    let quizId = 0;

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

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        });
    }

    function getPerguntasPreTeste() {

    }

    function proximo(btn) {
        if(c1 === 3) {

        }

        let marcado = document.querySelector("[name='check']:checked").value;
        console.log(marcado);
        if(marcado) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_perguntas_pre_teste.php?id_quiz=' + quizId + "&resposta=" + marcado + "&acao=verificar-quiz-pre-teste");
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

    document.querySelector('.btn-proximo-pre-teste').addEventListener('click', (el) => proximo(el));

    function insertPreTeste(aulaId) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_perguntas_pre_teste.php?id_aula=' + aulaId + '&acao=get-pre-teste');
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response)[0];
            let res = response['result'];
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

    document.querySelector("video").onended = function() {
        if(this.played.end(0) - this.played.start(0) === this.duration) {
            let attr = this.getAttribute('data-id-vid-aula');
            alert(attr);
        }else {
            console.log("Some parts were skipped");
        }
    }

    let header = document.querySelector(".pre-teste");
    let aulaId = header.getAttribute('data-id-aula');
    header.addEventListener('click', () => {
        insertPreTeste(aulaId);
    });

    function redirect(id) {
        location.href = "home.php?acao=treinamento-video&id_vid=" + id;
    }
</script>

<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>


<!-- https://stackoverflow.com/questions/64566873/how-to-check-a-user-watched-the-full-video-in-html5-video-player-without-skippin --->