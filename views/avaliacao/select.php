<?php 

    require_once(__DIR__ . "/../../area-restrita/controllers/avaliacao/Fiscallize.php");
    $rankingEstagio = $fiscallize->numeroRankingEstagio($cpfLog);
    function getAvaliacoes($conexao, $idLog) {
        $est = getAcademicoEst($conexao, $idLog); // filtro pelo estágio do usuário
        $sql = "SELECT * FROM avaliacoes INNER JOIN estagio ON avaliacoes.id_est = estagio.id_est WHERE avaliacoes.id_est = :est";
        $result = $conexao->prepare($sql);
        $result->bindParam(':est', $est, PDO::PARAM_INT);
        $result->execute();

        $avaliacoes = $result->fetchAll();
        return $avaliacoes;
    }


    function formatDateAndTime($dateTime) {
        /**
         * 
         * ENTRADA: 2023-02-02 00:00:00
         * 
         */
        $data = date('d/m/Y', strtotime($dateTime));
        $hora = date('H:i', strtotime($dateTime));
        $string = $data . ' ÁS ' . $hora;
        return $string;
    }


    $avaliacoes = getAvaliacoes($conexao, $idLog);

    function getAcademicoEst($conexao, $idLog){
        $select = "SELECT est_id_mat FROM `matricula` WHERE acad_id_mat = :idLog";
        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':idLog', $idLog, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();
            if($contar>0){
                return $result->fetchAll()[0]['est_id_mat'];
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
    
    function getIdByCPF($conexao, $cpf){
        $select = "SELECT * FROM academico WHERE cpf_acad = :cpf_acad";
        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':cpf_acad', $cpf, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();
            if($contar>0){
                return $result->fetchAll()[0]['id_acad'];
            }
        }catch(PDOException $e){
            echo $e;
        }
    } 
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="mt-5 content">
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
                <p style="color: #88E450; font-weight: 800; text-align:center;">AVALIAÇÔES</p>
            </div>

            <div class="header-avaliacoes col-md-6">
                <div class="container col-sm-12" style="overflow: scroll;">

                    <div class="row ">
                        <div class="col col-sm-6 info-nivelamento d-inline">
                            <div class="row">
                                <div class="col-sm-9">
                                    <span>Ranking Geral - <?php echo $rankingEstagio ?></span>
                                </div>
                                
                                <div class="col-sm-2">
                                    <span class="icon" style="max-width: 30px; max-height: 30px;">
                                        <img style="width: 30px;" src="/assets/images/trofeu.png" alt="" srcset="">
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row nivelamento">
                        <div class="content d-flex flex-1 overflow-scroll">
                            <div class="box d-flex align-items-start">

                                <?php foreach ($avaliacoes as $avaliacao) : ?>
                                <div class="col col-sm-12">
                                    <div class="col info-nivelamento">
                                        <span><?php echo $avaliacao['nome_avaliacao'] ?></span>
                                    </div>
                                    <div class="col info-nivelamento">
                                        <span>Nota: <?php echo $fiscallize->nota($avaliacao['avaliacao_id_fiscallize']) ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-sm-12 col-md-2 m-3 mt-4">
                <button class="btn btn-dark"
                    style="background-color: #231f20; border: none; width: 120%; border-radius: 10px 10px 10px;"
                    onclick="history.back()">
                    <div style="width: 30%;" style="background-color: black;">
                        <img src="/assets/images/voltar-light.png" alt=""
                            style="background-color: #231f20; max-width: 100%;">
                    </div>
                </button>
            </div>
        </div>


        <div class="avaliacoes">
            
            <?php foreach ($avaliacoes as $avaliacao) : ?>
            <div class="avaliacao">
                
                    <div class="content d-flex justify-content-center mt-3">
                        <div class="row align-items-center clique" style="width: 100%;" data-toggle="collapse"
                            data-target="#avaliacao<?= $avaliacao['id_avaliacao']; ?>" aria-expanded="true" aria-controls="">
                            <div class="col-md-12 col-sm-12 " style="background: #737373;">
                                <div class="row">
                                    <p class="mt-3 texto-modulo col-md-10" style="color: #88E450; font-weight: 800; text-align:left;">
                                        <?= $avaliacao['nome_avaliacao'] ?>
                                    </p>

                                    <p class="mt-3 col-md-2" style="color: #fff; font-weight: 700; text-align:left; font-size: 1.2em;">
                                        Ranking: <?= $fiscallize->numeroRankingProva($cpfLog, $avaliacao['avaliacao_id_fiscallize']); ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                

                    <!--- INICIO AVALIACAO --->
                    <div class="content d-flex justify-content-center clique">

                        <div style="width: 100%; text-align: center;" id="avaliacao<?= $avaliacao['id_avaliacao']; ?>" class="collapse"
                            aria-labelledby="headingOne" data-id-aula="1">
                            <!--- INICIO LISTA AVALIACAO--->
                            <div class="mt-3">
                                <div class="d-flex content w-100">
                                    <input type="hidden" id="<?php echo $avaliacao['id_avaliacao']; ?>" value="<?php $avaliacao_id_fiscallize = $avaliacao['avaliacao_id_fiscallize']; echo "https://remote.fiscallize.com.br/aplicacoes/$avaliacao_id_fiscallize/orientacoes";  ?>">

                                    <div class="aula bg-white p-3" class="d-flex" style="width: 24%; margin-right: 1%;">
                                        <div class="d-flex alinhar" style="text-align: center;">
                                            <span class="alinhar texto-mudulo-accordion"><?= formatDateAndTime($avaliacao['data_avaliacao']) ?></span>
                                        </div>
                                    </div>

                                    <div data-toggle="collapse" aria-expanded="false"
                                        class="bg-white nome-aula d-flex alinhar" style="width: 75%;">
                                    </div>

                                    <?php if ($avaliacao['liberado'] == 'liberado') : ?>
                                    <div class="button-iniciar bg-white mr-auto w-80" style="width: 20%;">
                                        <button class="bg-third btn-iniciar mr-4 mt-2 clique" onclick="showModal('<?php $avaliacao_id_fiscallize = $avaliacao['avaliacao_id_fiscallize']; echo 'https:/\\/medhub.app.br/v2.php?acao=fiscallize&id_avaliacao='. $avaliacao_id_fiscallize.''; ?>')" data-toggle="modal"
                                            data-target="#modalExemplo">
                                            INICIAR
                                        </button>
                                    </div>
                                    

                                    <?php else : ?>
                                    <div class="mr-auto bg-white ml-n3">
                                        <div class="max" style="max-width: 42px;">
                                            <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--- FIM LISTA AULAS--->
                        </div>
                    </div>
                <!--- FIM AULA --->
            </div>
            <?php endforeach; ?>

                <!-- Modal -->
                <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
                    aria-labelledby="modalExemploTitulo" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalExemploTitulo">AVISO IMPORTANTE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body overflow-scroll">
                                <div class="overflow-scroll">
                                    <p>Para realizar o Login na plataforma Fiscallize, você deve inserir seu e-mail cadastrado na MedHub (usuário) e CPF (senha).</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox bottom">
                                    <input type="checkbox" class="custom-control-input" id="checkModal">
                                    <label class="custom-control-label" for="checkModal">Eu li e estou ciente</label>
                                </div>
                                <input type="hidden" id="redirect">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <!-- Botão para confirmar o checkbox -->
                                <button type="button" class="btn btn-primary" id="confirmarCheckbox" disabled>Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!--- FIM AULA --->

</div>
<!--- FIM AULA --->


</div>
</div>
</section>
</div>

</div>


<style>
    .header-avaliacoes {
        background-color: #231f20;
        border-radius: 10px 10px 10px;
        padding: 10px;
        margin: 10px;
    }

    .info-nivelamento {
        background-color: #fff;
        color: #231f20;
        border-radius: 10px 10px 10px;
        padding: 10px;
        margin: 10px;
    }

    .info-nivelamento span {
        font-weight: 600;
        color: #231f20;
    }




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

    .bg-third {
        background-color: #88E439;
        color: #fff;
    }

    .btn-iniciar {
        border: none;
        border-radius: 10px 10px 10px;
        width: 80%;
        height: 35px;
    }

    .modal-content {
        border-radius: 10px 10px 10px;
        height: auto;
    }

    .modal-body {
        height: 400px;
        overflow-y: auto;
    }

    .modal-content {
        overflow-y:auto;
    }
</style>


<script>
    
    //showModal = (redirect) => {
    //    document.querySelector("#redirect").value = redirect;
    //    $('#modalExemplo').modal('show');
    //}
    function showModal(redirect) {
        console.log(redirect);
        document.querySelector("#redirect").value = redirect;
        document.querySelector("#modalExemplo").style.display = "block";
    }


    let check = document.querySelector("#checkModal");
    check.addEventListener("change", function () {
        if (check.checked) {
            document.querySelector("#confirmarCheckbox").disabled = false;
        } else {
            document.querySelector("#confirmarCheckbox").disabled = true;
        }
    });

    document.querySelector("#confirmarCheckbox").addEventListener('click', function() {
        let redirect = ($("#redirect").val());
        window.open(redirect, '_blank');
    });

</script>

<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
