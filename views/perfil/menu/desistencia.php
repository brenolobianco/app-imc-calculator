<?php
include_once 'controllers/matricula/ControllerUpdateCancel.php';
?>
<div class="container">
    <div class="row">
        <a class="nav-link link btn btn-default mb-4 display-2" style="margin-left: -60px; margin-top: 30px;" href="home.php?acao=perfil&id_acad=<?=$idLog;?>" style="width: 150px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="content4 cid-tc0htyQ19O" id="content4-41" style="margin-top: -50px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Aconteceu algo? Conta pra gente... </strong></h3>
            </div>
        </div>
    </div>
</section>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST">
                  <div class="form-group"> 
                    <input type="hidden" name="insc_mat" value="Desistente">
                    <input type="hidden" name="data_des_mat" value="<?= date('Y-m-d H:i:s')?>">
                    <textarea class="form-control" name='motivo_mat' rows="8" style="border-radius: 25px;" required>Eu, <?= $nomeLog?>, inscrito(a) no CPF sob o nº <?= $cpfLog;?>, solicito o cancelamento, da minha inscrição...
                    </textarea>
                  </div>
           
                  <center>
                  <button type="submit" name="atualizar" class="btn btn-white display-4" style="width: 300px;">Confirmar Cancelamento</button>
                  </center>
                  </p>
                  <br><br>
                  <br><br>
                </form>
            </div>
        </div>
    </div>
</section>