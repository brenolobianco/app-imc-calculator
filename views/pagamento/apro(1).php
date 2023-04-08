<br />
<?php 
include 'controllers/pagamento/ControllerSelect.php';

include_once 'controllers/matricula/ControllerInsert.php';

?>
<div class='alert alert-success'>
    <button type='button' class='close' data-dismiss='alert'>x</button>
    <strong> Compra aprovada com sucesso.</strong> 
</div>
<section class="form3 cid-tc0bT9FsJh" id="form3-3r" style="margin-top: 50px;">

    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="card mb-3">
                  <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                  <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;">
                    <h5 style="text-align: center; margin-top: 10px; font-size: 20px; color: #fff;">
                        de <s style="color: red;"><?= $valor_est?></s> por <strong style="color: #4ee44e; font-size: 30px;"><?= $valor_desc_est?></strong>
                    </h5>
                  </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <form action="" method="POST">
                    <div class="col-lg-12 col-md col-sm-12 form-group">
                        <label style="color: #fff;"></label>
                        <label style="color: #fff;"><?= $nomeLog;?>!</label>
                        <label style="color: #fff;">Você possui um código de CASHBACK? 
  
                        <br />Se sim, <u style="color: orange;"><a href="<?= $link_huber_est; ?>" target="_blank">clique aqui</a></u> para reembolso!</label>
                        <label style="color: #fff;">Com a MedHub você está sempre seguro(a). Qualquer dúvida ou ajuda que você venha a precisar, é só entrar em contato pelo contato@medhub.app.br</label>
                        <input type="hidden" name="acad_id_mat" value="<?=$idLog;?>">
                        <input type="hidden" name="insc_mat" value="Liberado">
                        <input type="hidden" name="data_cad_mat" value="<?= date("d/m/Y h:i");?>">
                        <input type="hidden" name="est_id_mat" value="<?= $id_est;?>">
                        <input type="hidden" name="hosp_id_mat" value="<?= $hosp_id_est;?>">
                            <?php
                                $select = "SELECT * from curso c LEFT JOIN matricula m ON m.curso_id_mat = c.id_curso ORDER BY id_curso DESC LIMIT 1";  
                                try{
                                $result = $conexao->prepare($select);
                                $result ->execute();
                                $contar = $result->rowCount();

                                if($contar>0){
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                    
                                    if($mostra->insc_mat != 'Liberado'){
                            ?>
                            <input type="hidden" name="curso_id_mat" value="<?= $mostra->id_curso;?>">
                            
                            <?php
                            }
                            }
                            }else{
                                echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="warning">x</button>
                                    <strong> Sem curso adicionado, entrar em contato com suporte!</strong> 
                                    </div>';
                            }
                            }catch(PDOException $e){
                                echo $e;
                            }
                            ?> 
                        </select>
                    </div>
                     <div class="col-md-auto col-lg-12 mbr-section-btn" style="margin-top: 0px;">
                        <button name="cadastrar" type="submit" class="btn btn-white display-4" style="width: 250px;">Confirmar Inscrição</button>
                    </div>
                </form>
            </div>
            <div style="width: 100%; height:10px;"></div>
            <h3 style="align-center; color: #fff;">IMPORTANTE</h3>
            <p>
                <center style="color: #fff; padding: 5px;">
                Você deve confirmar a sua inscrição no botão exibido acima. Caso não confirme, você precisará entrar 
                em contato com o suporte e o processo de liberação pode demorar até 72 horas para ser concluído.
                </center>
            </p>
            <div class="offset-lg-1"></div>
        </div>
    </div>
</section>