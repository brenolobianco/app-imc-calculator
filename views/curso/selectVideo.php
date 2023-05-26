<?php

include_once 'controllers/aulaVideo/ControllerSelect.php';



?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=curso&id_curso=<?= $curso_id_aula; ?>">
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
                    <video oncontextmenu="return false;" width="70%" height="70%" autoplay controls controlsList="nodownload">
                        <source src="videos/<?= $nome_vid ?>" type="video/mp4">
                    </video>
                    <br />
                   <?php

                    $select = "SELECT * from aula_pdf WHERE aula_id_pdf = $id_aula";
                    try {
                        $result = $conexao->prepare($select);
                        $result->execute();
                        $contar = $result->rowCount();

                        if ($contar > 0) {
                            while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {

                    ?>
                                <a class="btn btn-white display-4" href="pdfs/<?= $mostra->id_pdf; ?>/<?= $mostra->arq_pdf; ?>" download><?= $mostra->nome_pdf; ?></a>
                    <?php
                            }
                        } else {
                            echo '';
                        }
                    } catch (PDOException $e) {
                        echo $e;
                    }
                    ?>
                </center>
            </div>
        </div>
    </div>
</section>

<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">


