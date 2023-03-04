<?php

include_once('controllers/treinamento/ControllerModulo.php');

?>
<div class="content mt-5" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="wrap m-5 mt-5">
        <div class="row">
            <div class="col-md-3 col-sm-12"
                style="background-color:#231f20; height: 20%; border-radius: 10px 10px 10px;">
                <button class="btn btn-dark" style="background-color: #231f20; border: none; width: 90%;">
                    <div style="width: 30%;" style="background-color: black;">
                        <img src="/assets/images/chapeu-formatura-preto.png" alt=""
                            style="background-color: #231f20; max-width: 100%;">
                    </div>
                </button>
                <p style="color: #88E450; font-weight: 800; text-align:center;">AREA DE TREINAMENTO</p>
            </div>

            <div class="col-sm-12 col-md-5 mt-5 ml-2" style="margin-right: 5%;">
                <div class="d-flex row progress w-100 " style="position: absolute; height: 50px;">
                    <div class="progress-bar color-success" role="progressbar"
                        style="width: 25%; background-color: #88E450;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-end">
                    <div style="z-index: 1; margin-top: 10px; font-weight: 600; font-size: 16pt;">50%</div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 m-3 mt-4">
                <button class="btn btn-dark"
                    style="background-color: #231f20; border: none; width: 90%; border-radius: 10px 10px 10px;">
                    <div style="width: 30%;" style="background-color: black;">
                        <img src="/assets/images/voltar-light.png" alt=""
                            style="background-color: #231f20; max-width: 100%;">
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div class="">


        <div class="modulos">

            <div class="modulo">
                <div class="content d-flex justify-content-center mt-3">
                    <div class="row align-items-center clique" style="width: 90%;" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="">
                        <div class="col-md-12 col-sm-12 " style="background: #737373;">
                            <p class="mt-3 texto-modulo" style="color: #88E450; font-weight: 800; text-align:left;">
                                MODULO 0'.$num.' -
                                '.$mostra->nome_mod.'</p>
                        </div>
                    </div>
                </div>

                <div class="content mt-3 d-flex justify-content-center clique">
                    <div style="width: 90%; text-align: center;" id="collapseOne" class="collapse"
                        aria-labelledby="headingOne" data-id-aula="1">
                        <div class="d-flex content" onclick="hiddenLeft(this)">

                            <div class="aula bg-white" class="d-flex" style="width: 24%; margin-right: 1%;">
                                <div class="d-flex alinhar" style="text-align: center;">
                                    <span class="alinhar texto-mudulo-accordion">1° semana</span>
                                </div>
                            </div>

                            <div data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false"
                                class="bg-white nome-aula d-flex alinhar" style="width: 75%;">
                                <span class="alinhar texto-modulo-accordion-minusculo" data-id-aula="1">Protocolo de
                                    Sepse</span>
                            </div>


                            <div class="mr-auto bg-white ml-n3">
                                <div class="max" style="max-width: 42px;">
                                    <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                                </div>
                            </div>

                        </div>



                        <div class="collapse w-100 bottom" id="collapseOne1" aria-expanded="false">
                            <div class="content d-flex justify-content-center clique">
                                <div class="w-100" style="text-align: center; background-color: white;">
                                    <div class="ml-3 mr-3 mb-3 mt-1 pt-5" style="background-color: black;">
                                        <video width="80%" height="300" controls>
                                            <source src="video.mp4" type="video/mp4">
                                            Seu navegador não suporta video.
                                        </video>
                                    </div>
                                </div>
                            </div>

                            <div class="content d-flex clique mt-2" data-toggle="collapse" data-target="#collapseQuiz"
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

                            <div class="quiz-box d-flex" style="justify-content: center;align-content: center;">
                                <div class="collapse" id="collapseQuiz" aria-expanded="false" style="width: 95%;">
                                    <div class="d-flex flex-row box bg-white mt-2" style="border-radius: 7px 7px 7px;">

                                        <div class="d-flex flex-column mt-3 p-3">

                                            <div class="texto-modulo-accordion" style="color: #88E450; font-size: 3vh;">
                                                <span class="titulo-quiz">QUESTÂO <span class="titulo-quiz">01</span> -
                                                    <span class="titulo-quiz">SEPSE</span></span>
                                            </div>


                                            <div class="questoes mt-5">
                                                <div class="d-flex flex-row texto-modulo-accordion ml-2 p-2"
                                                    style="color: #88E450; font-size: 2vh;">
                                                    <input type="checkbox" name="" id="" style="width: 50px;">
                                                    <span class="titulo-quiz mt-1">QUESTÂO <span
                                                            class="titulo-quiz">01</span></span>
                                                </div>

                                                <div class="d-flex flex-row texto-modulo-accordion ml-2 p-2"
                                                    style="color: #88E450; font-size: 2vh;">
                                                    <input type="checkbox" name="" id="" style="width: 50px;">
                                                    <span class="titulo-quiz mt-1">QUESTÂO <span
                                                            class="titulo-quiz">01</span></span>
                                                </div>


                                                <div class="d-flex flex-row texto-modulo-accordion ml-2 p-2"
                                                    style="color: #88E450; font-size: 2vh;">
                                                    <input type="checkbox" name="" id="" style="width: 50px;">
                                                    <span class="titulo-quiz mt-1">QUESTÂO <span
                                                            class="titulo-quiz">01</span></span>
                                                </div>


                                                <div class="d-flex flex-row texto-modulo-accordion ml-2 p-2"
                                                    style="color: #88E450; font-size: 2vh;">
                                                    <input type="checkbox" name="" id="" style="width: 50px;">
                                                    <span class="titulo-quiz mt-1">QUESTÂO <span
                                                            class="titulo-quiz">01</span></span>
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
                                        <button class="radius-quiz btn bg-white w-25">PRÓXIMO</button>
                                        <button class="radius-quiz btn bg-white w-25"
                                            style="margin-left: 20%;">FINALIZAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php 
            if($contar>0){
                $estagios = [];
                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                    $est_id_mod = $mostra->est_id_mod;
                    array_push($estagios, $estagios_id_mod);
                    $num = count($estagios);
                    echo '
                        <div class="modulo">
                    ';
                    $modulo = '            
                    <div class="content d-flex justify-content-center mt-3">
                        <div class="row align-items-center clique" style="width: 90%;" data-toggle="collapse"
                            data-target="#accordion-'.$num.'" aria-expanded="true" aria-controls="#accordion-'.$num.'">
                            <div class="col-md-12 col-sm-12 " style="background: #737373;">
                                <p class="mt-3 texto-modulo"
                                    style="color: #88E450; font-weight: 800; text-align:left;">MODULO 0'.$num.' -
                                    '.$mostra->nome_mod.'</p>
                            </div>
                        </div>
                    </div>
                ';
                echo $modulo;
                
                $acordionModulo = '
                <div class="content mt-3 d-flex justify-content-center clique">
                <div style="width: 90%; text-align: center;" id="accordion-'.$num.'" class="collapse"
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="d-flex content">
                    
                        <div class="d-flex" style="background-color: white; width: 24%; margin-right: 1%;">
                            <div class="d-flex alinhar" style="text-align: center;">
                                <h2 class="alinhar texto-mudulo-accordion">1° semana</h2>
                            </div>
                        </div>

                        <div class="d-flex alinhar" style="background-color: white; width: 75%;">
                            <h2  class="alinhar texto-modulo-accordion-minusculo">Protocolo de sepse</h2>
                        
                        </div>

                        <div class="mr-auto bg-white ml-n3">
                            <div class="max" style="max-width: 42px;">
                                <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
            ';

            echo $acordionModulo;
            echo "</div>";
                }
            }
            ?>


    </div>
</div>
</div>


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
</script>

<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>