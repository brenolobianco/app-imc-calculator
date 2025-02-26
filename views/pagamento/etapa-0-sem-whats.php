<br />
<?php 
include 'controllers/pagamento/ControllerSelect.php';

include_once 'controllers/matricula/ControllerInsert.php';

?>

<section class="form3 cid-tc0bT9FsJh" id="form3-3r" style="margin-top: 50px;">

    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="card mb-3">
                  <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                  <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;;">
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
  
                        <br />Se sim, <a href="<?= $link_huber_est; ?>" target="_blank"><u style="color: orange;">clique aqui</u></a> para reembolso!</label>
                        <label style="color: #fff;"><?= $nome_hosp;?>, escolher o curso *</label>
                        <input type="hidden" name="acad_id_mat" value="<?=$idLog;?>">
                        <input type="hidden" name="insc_mat" value="Liberado">
                        <input type="hidden" name="data_cad_mat" value="<?= date("d/m/Y h:i");?>">
                        <input type="hidden" name="est_id_mat" value="<?= $id_est;?>">
                        <input type="hidden" name="hosp_id_mat" value="<?= $hosp_id_est;?>">
                        <select class="place_form form-control"  name="curso_id_mat" required>
                            <?php
                                $select = "SELECT * from curso WHERE est_id_curso = $id_est";  
                                try{
                                $result = $conexao->prepare($select);
                                $result ->execute();
                                $contar = $result->rowCount();

                                if($contar>0){
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                    
                                    if($mostra->insc_mat != 'Liberado'){
                            ?>
                            <option value="<?= $mostra->id_curso;?>"><?= $mostra->nome_curso;?></option>
                            <?php
                            }
                            }
                            }else{
                                echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="warning">x</button>
                                    <strong> Você já possui este curso, favor entrar em contato com suporte!</strong> 
                                    </div>';
                            }
                            }catch(PDOException $e){
                                echo $e;
                            }
                            ?> 
                            
                        </select>
                            
                  
                    </div>
                     <div class="col-md-auto col-lg-12 mbr-section-btn" style="margin-top: 0px;">
                        <button name="cadastrar" type="submit" class="btn btn-white display-4" style="width: 250px; margin-left: 7px;">Fazer Inscrição</button>
                    </div>
                </form>
            </div>
            <div style="width: 100%; height:10px;"></div>
            <h3 style="align-center; color: yellow;">IMPORTANTE</h3>
            <p>
                <center style="color: #fff; padding: 5px;">
                    Após a compra, você poderá realizar o upload dos documentos, ou poteriormente no seu perfil.<br>
                Com a MedHub você está <span style="color: yellow";>sempre seguro(a)</span>. Qualquer dúvida ou ajuda que você venha a precisar, é só entrar em <span style="color: orange";>contato pelo contato@medhub.app.br</span>.
                </center>
            </p>
            <div class="offset-lg-1"></div>
        </div>
    </div>
</section>