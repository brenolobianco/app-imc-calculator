

<?php
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

    $userEst = getAcademicoEst($conexao, $idLog);
?>
<section class="features1 cid-tbuO2OyHXT" id="features2-1f">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container">
              <div class="row">
                <div class="col-sm-7" style="margin-left: 50px; color: #fff;">
                  <h1 style="fotn-size: 130px;"><strong style="color: yellow;">PARABÉNS!!!</strong><h1> 
                  <h4>Você foi APROVADO e está CLASSIFICADO!!</h4>
                  <br>
                  <p class="mbr-text mbr-fonts-style display-7"><?= $nomeLog;?>, é com enorme prazer que te entregamos o <span style="color: yellow;">Selo MedHub de Qualidade.</span> Você passou em nosso crivo e agora deve aguardar o contato da equipe MedHub para mais informações. Fique de olho em seu e-mail/WhatsApp.
                </div>
                <div class="col-sm-4">
                  <img src="assets/images/selo-medhub-506x506.png">
                </div>
                <div class="col-sm-12" style="margin-left: 50px; color: #fff;">
                  <p class="mbr-text mbr-fonts-style display-7">
                  <strong>Siga os próximos passos clicando em “Documentos”</strong></p>
                  <p class="mbr-text mbr-fonts-style display-7" style="color: yellow;"><?=$mostra2->msn_mat;?></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper2" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-error mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                         Falta
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-camera mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                          Registrar Crachá
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-5">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        
                        <span class="mbr-iconfont mobi-mbri-paperclip mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Documentos
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-alert mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Notificação / FOBS
                        </h4>
                    </div>
                </div>
            </div>

            <!--- AREA DE TREINAMENTO ---> 
            <div class="col-12 col-md-6 col-lg-3" style="cursor: pointer;" onclick="document.location.href = 'home.php?acao=treinamento&id_est=<?= $userEst ?>' ">
                <div class="card-wrapper2" style="background-color: #88e450;">
                    <div class="card-box align-center">
                    <i class="fa fa-graduation-cap mbr-iconfont" style="color: #fff;"></i>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Área de treinamento
                        </h4>
                    </div>
                </div>
            </div>
            <!--- AREA DE TREINAMENTO --->

            
            <div class="modal fade bd-example-modal-lg-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #88e450; height: 500px;">
                    <div class="text-wrapper">
                        <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Documentos</strong> 
                            <br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12">
                            <center>
                              <p class="mbr-text mbr-fonts-style display-7" style="color: #fff;">Precisamos que você nos envie alguns documentos. 
                              É bem rapidinho. Após enviá-los, você poderá acessar.
                              </p>
                            </center>
                        </div>
                        <div class="col-sm-12">
                            <img src="assets/images/arquivos.png">
                        </div>
                        <div class="col-sm-12">
                            
                            <?php 
                            
                            $atual = date("Y-m-d");
                            //$atual = date('Y-m-d H:i:s', strtotime('+2 days'));
                            $ck_timestamp1 = strtotime($atual);
                            
                            $tempo = $mostra2->exp_msn_mat;// horário cadastrado no sistema
                            $ck_timestamp2 = strtotime($tempo);//horario de agora - hoje
                            
                            
                            if($ck_timestamp1 >= $ck_timestamp2){ ?>
                                
                                <center><br />
                                <a class="btn btn-black display-4" href="" style="width: 280px;" disabled>
                                    Expirou seu tempo 
                                </a>
                                </center>
                                
                            <?php }else{ ?>
                            
                                <center><br />
                                <?php
                                if($mostra2->termos_mat == null){?>
                                <a class="btn btn-white display-4" href="home.php?acao=termos-de-compromisso&id_mat=<?=$mostra2->id_mat;?>" style="width: 280px;">
                                    Enviar Documentos 
                                </a>
                                <?php }else{?>
                                <a class="btn btn-white display-4" href="home.php?acao=upload-comprovante-de-residencia" style="width: 280px;">
                                    Atualizar Documentos 
                                </a>
                                <?php }?>
                                </center>
                                
                            <?php } ?>
                            
                            
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!--- Avaliações --->
            <div class="col-12 col-md-6 col-lg-3" style="cursor: pointer;" onclick="document.location.href = 'home.php?acao=avaliacao&id_est=<?= $userEst ?>' ">
                <div class="card-wrapper" style="background-color: #88e450;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-contact-form mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Avaliações
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>