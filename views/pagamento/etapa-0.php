<br />
<?php 
include 'controllers/pagamento/ControllerSelect.php';

include_once 'controllers/matricula/ControllerInsert0-pag.php';

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
                    <?php
                        $select2 = "SELECT * from matricula WHERE est_id_mat = $id_est && acad_id_mat = $idLog LIMIT 1";  
                        try{
                        $result2 = $conexao->prepare($select2);
                        $result2 ->execute();
                        $contar = $result2->rowCount();

                        if($contar>0){
                        while($mostra2 = $result2->FETCH(PDO::FETCH_OBJ)){
                        
                           
                    ?>
                    <div class="alert alert-info">
                        <strong> Voc já possui este curso, favor entrar em contato com suporte!</strong> 
                    </div>
                    
                    <?php
                    
                    }
                    }else{ ?>
                    <div class="col-lg-12 col-md col-sm-12 form-group">
                        <label style="color: #fff;"></label>
                        <label style="color: #fff;"><?= $nomeLog;?>!</label>
                        <label style="color: #fff;">Você possui um código de CASHBACK? 
  
                        <br />Se sim, <a href="<?= $link_huber_est; ?>" target="_blank"><u style="color: orange;">clique aqui</u></a> para reembolso!</label>
                        <label style="color: #fff;"><?= $nome_hosp;?>, escolher o curso *</label>
                        
                        <input type="hidden" name="acad_id_mat" value="<?=$idLog;?>">
                        <input type="hidden" name="insc_mat" value="Liberado">
                        <input type="hidden" name="pag_mat" value="Conferir">
                        <input type="hidden" name="data_cad_mat" value="<?= date("d/m/Y H:i");?>">
                        <input type="hidden" name="est_id_mat" value="<?= $id_est;?>">
                        <input type="hidden" name="hosp_id_mat" value="<?= $hosp_id_est;?>">
                        <input type="text" class="place_form form-control" id="whatsApp" name="whats_mat" placeholder="Seu WhatsApp *" required>
                        <br>
                        <select class="place_form form-control"  name="curso_id_mat" required>
                            <?php
                                $select = "SELECT * from curso WHERE est_id_curso = $id_est";  
                                try{
                                $result = $conexao->prepare($select);
                                $result ->execute();
                                $contar = $result->rowCount();

                                if($contar>0){
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                    
                                   
                            ?>
                            <option value="<?= $mostra->id_curso;?>"><?= $mostra->nome_curso;?></option>
                            <?php
                            
                            }
                            }else{
                                echo '<div class="alert alert-info">
                                    <strong> Pendente de Aprovação!</strong> 
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
                    
                    <?php }
                    }catch(PDOException $e){
                        echo $e;
                    }
                    ?> 
                </form>
                <script>
                $("#whatsApp").mask("(99) 9 9999-9999");
            </script>
            </div>
            <div style="width: 100%; height:10px;"></div>
            <h3 style="align-center; color: yellow;">IMPORTANTE</h3>
            <p>
                <center style="color: #fff; padding: 5px;">
                    Após a compra, você poderá realizar o upload dos documentos, no seu perfil.<br>
                Com a MedHub você está <span style="color: yellow";>sempre seguro(a)</span>. Qualquer dvida ou ajuda que você venha a precisar, é só entrar em <span style="color: orange";>contato pelo contato@medhub.app.br</span>.
                </center>
            </p>
            <div class="offset-lg-1"></div>
        </div>
    </div>
</section>