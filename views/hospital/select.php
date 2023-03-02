<?php

include_once 'controllers/estagio/ControllerSelect.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=estagio">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>
<section class="header11 cid-tbZJ1jcHgh" id="header11-3c" style="margin-top: -50px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5 image-wrapper">
                <div style='position:relative; top:0px; left:0px;'>
                    <img src="assets/images/background_verdeclaro.png">
                </div>
                <div class="img_hosp">
                    <img class="w-100" src="upload/<?= $img_hosp; ?>" alt="Hospital">
                </div>
            </div>
            <div class="mar-per col-md-7">
                <div class="text-wrapper text-center" style="margin-right: 50px;">
                        <?php

                        $estagioApresentacao = '
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong> '.$nome_hosp.'</strong>
                    </h1>
                    <h5 class="mbr-section-title mbr-fonts-style mb-3 display-6">
                        '.$nome_est.'
                    </h5>
                    <h5 class="mbr-section-title mbr-fonts-style mb-3 display-7" style="color: yellow;">
                        '.$exc_est.'
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            '.$desc_est.'
                        </p>
                        '; 
                        
                        // caso o usuário esteja classificado.
                        $estagioClassificado = '
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong> '.$nome_hosp.'</strong>
                    </h1>
                    <h5 class="mbr-section-title mbr-fonts-style mb-3 display-6">
                        '.$nome_est.'
                    </h5>
                    <h5 class="mbr-section-title mbr-fonts-style mb-3 display-7" style="color: yellow;">
                        '.$exc_est.'
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            '.$desc_est.'
                        </p>
                        '; 
                        $select = "SELECT * from matricula m 
                    JOIN estagio e ON e.id_est = m.est_id_mat
                    JOIN hospital h ON h.id_hosp = m.hosp_id_mat
                    JOIN academico a ON a.id_acad = m.acad_id_mat
                    JOIN curso c ON c.id_curso = m.curso_id_mat 
                    WHERE acad_id_mat = $idLog && est_id_mat = $id_est LIMIT 1";
                        try {
                            $result = $conexao->prepare($select);
                            $result->execute();
                            $contar = $result->rowCount();
                            
                            if ($contar > 0) {
                                while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

                                    if ($mostra->pag_mat != 'Conferir') { ?>
                                    
                                        <div class="mbr-section-btn mt-3">
                                            <?php 
                                            $btnsNaoAprovado = '
                                            <a class="btn btn-white display-7" href="home.php?acao=area-da-prova&id_curso='.$mostra->id_curso.' ">Área da Prova</a>
                                            <a class="btn btn-white display-7" href="home.php?acao=curso&id_curso='.$mostra->id_curso.' ">Meu Curso</a>
                                            ';
                                            $btnsSimAprovado = '
                                            <a class="btn btn-white display-7" href="home.php?acao=treinamento&id_est='.$mostra->id_est.'">Treinamento</a>
                                            <a class="btn btn-white display-7" href="home.php?acao=curso&id_est='.$mostra->id_est.'">Avaliações</a>
                                            ';
                                            if($mostra->class_mat == 'sim') {
                                                echo $estagioClassificado;
                                                echo $btnsSimAprovado;
                                            } else {
                                                echo $estagioApresentacao;
                                                echo $btnsNaoAprovado;
                                            }
                                            ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="mbr-section-btn mt-3">
                                            <a class="btn btn-black display-4" disabled>Aguardando Confirmação</a>
                                        </div>
                        <?php
                                    }
                                }
                            } else {
                                echo '<div class="mbr-section-btn mt-3"><a class="btn btn-white display-7" href="#content4-3s">Comprar</a></div>';
                            }
                        } catch (PDOException $e) {
                            echo $e;
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="image3 cid-tc04cqrQrh" id="image3-3h">




    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img src="assets/images/img-nova-boxhospital1-800x560.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content4 cid-tc04yEivk8" id="content4-3i">


    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-7">
                    O nosso produto inclui: o exame do concurso, o preparatório para os aprovados se adequarem ao corpo
                    clínico e o Selo MedHub de Qualidade para que você, quando selecionado(a), seja estagiário(a) do Hospital
                </h4>
            </div>
        </div>
    </div>
</section>
<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Edital Resumido</strong>
                </h3>
            </div>
        </div>
    </div>
</section>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <blockquote style="height: 300px; overflow-y: scroll;">
                    <p class="mbr-text mbr-fonts-style display-4">
                        <?= $edital_est; ?>
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="mbr-section-btn mt-3">
                <?php
                $select = "SELECT * from edital_pdf WHERE est_id_edital = $id_est LIMIT 1";
                try {
                    $result = $conexao->prepare($select);
                    $result->execute();
                    $contar = $result->rowCount();

                    if ($contar > 0) {
                        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

                ?>
                            <a class="btn btn-white display-7" href="editais/<?= $mostra->id_edital; ?>/<?= $mostra->arq_edital; ?>" download>Download Edital Completo</a>
                <?php
                        }
                    } else {
                        echo 'Nenhum edital cadastrado!';
                    }
                } catch (PDOException $e) {
                    echo $e;
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="content4 cid-tc04yEivk8" id="content4-3i">


    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Aulas e Módulos</strong>
                </h3>

            </div>
        </div>
    </div>
</section>
<?php
$select = "SELECT * from modulo WHERE est_id_mod = $id_est";
try {
    $result = $conexao->prepare($select);
    $result->execute();
    $contar = $result->rowCount();

    if ($contar > 0) {
        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

            $valor = $mostra->id_mod;
            if ($valor % 2 == 0) {
                $cor = "cid-tc092epVkT";
            } else {
                $cor = "cid-tc091nX6wd";
            }

?>
            <section class="gallery3 <?= $cor; ?>" id="gallery3-3k">
                <div class="container-fluid">
                    <div class="mbr-section-head">
                        <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                            <strong><?= $mostra->nome_mod; ?></strong>
                        </h4>

                    </div>
                    <div class="row mt-4">
                        <?php
                        $select2 = "SELECT * from aula WHERE mod_id_aula = $mostra->id_mod";
                        try {
                            $result2 = $conexao->prepare($select2);
                            $result2->execute();
                            $contar2 = $result->rowCount();

                            if ($contar2 > 0) {
                                while ($mostra2 = $result2->FETCH(PDO::FETCH_OBJ)) {
                        ?>
                                    <div class="item features-image сol-12 col-md-6 col-lg-3">
                                        <div class="item-wrapper">
                                            <div class="item-content">
                                                <h5 class="item-title mbr-fonts-style display-7">
                                                    <strong><?= $mostra2->nome_aula; ?></strong>
                                                </h5>
                                                <p class="mbr-text mbr-fonts-style mt-3 display-7">
                                                    <?= $mostra2->desc_aula; ?>
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            } else {
                                echo 'Nenhuma aula cadastrada';
                            }
                        } catch (PDOException $e) {
                            echo $e;
                        }
                        ?>
                    </div>
                </div>
            </section>
<?php
        }
    } else {
        echo 'Nenhum módulo cadastrado';
    }
} catch (PDOException $e) {
    echo $e;
}
?>

<!--<section class="content11 cid-tc0gHyP9rr" id="content11-3t">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="mbr-section-btn align-center"><a class="btn btn-white display-4" href="">Ver mais</a></div>
        </div>
    </div>
</div>
</section>-->
<?php
$select = "SELECT * from matricula m 
    JOIN estagio e ON e.id_est = m.est_id_mat
    JOIN hospital h ON h.id_hosp = m.hosp_id_mat
    JOIN academico a ON a.id_acad = m.acad_id_mat
    JOIN curso c ON c.id_curso = m.curso_id_mat 
    WHERE acad_id_mat = $idLog && est_id_mat = $id_est";
try {
    $result = $conexao->prepare($select);
    $result->execute();
    $contar = $result->rowCount();

    if ($contar > 0) {
        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
?>
            <section class="content4 cid-tc0eUQvbqD" id="content4-3s">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="title col-md-12 col-lg-10">
                            <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                                <br />
                            </h3>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    } else { ?>

        <section class="content4 cid-tc0eUQvbqD" id="content4-3s">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="title col-md-12 col-lg-10">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                            <strong>Comprar</strong>
                        </h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="form3 cid-tc0bT9FsJh" id="form3-3r">

            <div class="container">


                <div class="row justify-content-center">
                    <div class="col-lg-5 col-12">
                        <div class="card mb-3">
                            <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                            <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;">
                                <h5 style="text-align: center; margin-top: 10px; font-size: 20px; color: #fff;">
                                    de <s style="color: red;"><?= $valor_est ?></s> por <strong style="color: #4ee44e; font-size: 30px;"><?= $valor_desc_est ?></strong>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 mbr-form" data-form-type="formoid">

                        <div data-for="name" class="col-lg-12 col-md col-sm-12 form-group">
                            <center>
                                <label style="color: #fff;"><b style="color: orange;">IMPORTANTE!</b>
                                    Após a compra, para validar a sua inscrição, você deve anexar CV Lattes, Comprovante de Matricula e RG.</label>
                                <?php if (!isset($_SESSION['isMed'])) : ?>
                                    <br /><br /><a href="arquivos/Contrato_MedHub.pdf" style="color: #fff;" target="_black">VISUALIZAR CONTRATO</a>
                                <?php endif; ?>
                            </center>
                        </div>

                        <?php if (isset($_SESSION['isMed'])) : ?>
                            <div class="col-md-auto col-lg-12 mbr-section-btn" style="margin-top: 30px;">
                                <b href="" class="btn btn-black display-4" style="margin-left: 20px;" disabled>Esse recurso é destinado para acadêmicos.</b>
                            </div>
                        <?php else : ?>
                            <?php if ($ativo_est == 'Ativado') { ?>
                                <div class="col-md-auto col-lg-12 mbr-section-btn" style="margin-top: 30px;">
                                    <a href="home.php?acao=endereco-confirmar&id_est=<?= $id_est; ?>" class="btn btn-white display-4" style="margin-left: 20px;">Aceito os termos do contrato</a>

                                </div>
                            <?php } else { ?>
                                <div class="col-md-auto col-lg-12 mbr-section-btn" style="margin-top: 30px;">
                                    <b href="" class="btn btn-black display-4" style="margin-left: 20px;" disabled>Indisponível no momento</b>
                                </div>
                            <?php } ?>
                        <?php endif; ?>
                    </div>
                    <div class="offset-lg-1"></div>
                </div>


            </div>
        </section>
<?php

    }
} catch (PDOException $e) {
    echo $e;
}
?>


<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">