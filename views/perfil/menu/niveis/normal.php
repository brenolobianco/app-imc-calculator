<section class="features1 cid-tbuO2OyHXT" id="features2-1f">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-1">
                <div class="card-wrapper2">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-error mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                         Faltas 
                        </h4>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-2">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-camera mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                          Registrar Crachá
                        </h4>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-3">
                <div class="card-wrapper2">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-clock mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                          Tempo
                        </h4>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row justify-content-center">
            
            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-4">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-align-justify mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Detalhes
                        </h4>
                    </div>
                </div>
            </div>
            
            

            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-5">
                <div class="card-wrapper2">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-paperclip mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Documentos
                        </h4>
                    </div>
                </div>
            </div>
             
            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-6">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-logout mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Sair do Estágio
                        </h4>
                    </div>
                </div>
            </div>
            
            <!-- MODALS -->
            <div class="modal fade bd-example-modal-lg-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-per modal-content" style="background-color: #065021;">
                    
                    
                    <div class="container">
                        <div class="text-wrapper">
                            <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="margin-right:-15px; float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Faltas </strong> 
                                </center>
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-6" style="color: #fff;">
                              <?php
                                $query_pres = "SELECT COUNT(id_pres) AS qnt_pres FROM presenca WHERE sit_pres ='Ausente' && mat_id_pres = $mostra2->id_mat";
                                $result_pres = $conexao->prepare($query_pres);
                                $result_pres->execute();
                        
                                $row_pres = $result_pres->fetch(PDO::FETCH_ASSOC);
                                
                                 if($row_pres['qnt_pres'] == 1){
                                    $f = 'falta';
                                }else{
                                    $f = 'faltas';
                                }
                            
                              if($row_pres['qnt_pres'] != 0){
                              ?>
                              <h4><br><br><br><?= $nomeLog;?>, você já tem <br><br><span style="color: orange;"><?= $row_pres['qnt_pres'];?> <?= $f;?>!</span><br><br><h4>
                              <?php 
                              }else{
                                echo "<h4><br><br><br><h1 style='color: #fff;'>Nehuma Falta</h1>";
                              }
                              $select = "SELECT * from presenca WHERE sit_pres = 'Ausente' && mat_id_pres = $mostra2->id_mat ORDER BY id_pres DESC LIMIT 1";  
                              try{
                              $result = $conexao->prepare($select);
                              $result ->execute();
                              $contar = $result->rowCount();
                            
                              if($contar>0){
                              while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                              ?>
                              <p>
                               A última foi dia 
                               <span style="color: orange;">
                                   <?php $input = $mostra->data_pres; $date = strtotime($input); echo date('d/m/Y', $date);?>
                               </span><br><br>
                              </p>
                              <?php
                                }
                                }else{
                                  echo "<strong style='color: #fff;'>Parabéns você não tem nehuma falta!!!</strong>";
                                }
                                }catch(PDOException $e){
                                  echo $e;
                                }
                             ?> 
                            </div>
                            <div class="col-sm-5">
                              <img src="assets/images/hipocrates-fdo-400x400.png">
                            </div>
                         </div>
                         <div class="row">
                        <div class="col-sm-12">
                            <center><br>
                            <?php if($row_pres['qnt_pres'] != 0){?>
                            <a class="btn btn-white display-4" href="/home.php?acao=perfil-faltas&acad_id_pres=<?= $id_acad?>" style="width: 280px;">Visualizar Todas Faltas</a> 
                            <?php } ?>
                            </center>
                        </div>
           
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-per modal-content" style="background-color: #88e450;">
                    <div class="text-wrapper">
                        <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" 
                            style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Registrar Crachá</strong> 
                            <br>
                            <div class="col-md-5">
                            <img src="assets/images/cracha.png">
                            </div>
                            <p style="font-size: 22px;">
                            Uma cópia do seu crachá já consta no nosso banco de dados.</p>
                            </center>
                        </h6>
                    </div>
                    <br>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #065021; height: 500px;">
                  <div class="text-wrapper">
                        <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Tempo</strong> 
                            <br><br><br>
                            <img src="assets/images/tempo.png" width="80%">
                            </center>
                            <div class="container">
                              <div class="row">
                                <div class="col-sm-6">
                                    <center>
                                      Começa <br>
                                      <span style="font-size: 16px;"><?= $mostra2->data_inicio_est;?></span>
                                    </center>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                      Termina<br>
                                      <span style="font-size: 16px;"><?= $mostra2->data_termino_est;?></span>
                                    </center>
                                </div>
                            
                              </div>
                            </div>
                        </h6>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-lg-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-per modal-content" style="background-color: #88e450;">
                    <div class="text-wrapper">
                        <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Detalhes</strong> 
                            <br><br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-4">
                          <img src="upload/<?= $mostra2->img_hosp;?>">
                        </div>
                        <div class="col-sm-8">
                            <h6 class="card-title mbr-fonts-style display-7">
                             <strong><?= $mostra2->nome_hosp;?></strong>
                            </h6>
                         <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-14" style="font-size: 14px; color: #fff;">
                             <blockquote style="height: 150px; overflow-y: scroll;"><?= $mostra2->desc_est;?></blokquote>
                             <br><br>
                             <div class="row">
                             <div class="col-sm-2">
                             <img src="assets/images/endereco.png" style="width: 50%;">  
                             </div>
                             <div class="col-sm-10">
                             <span style="margin-left: -30px; font-size: 16px;"><?= $mostra2->rua_hosp .', '. $mostra2->num_hosp .' no '. $mostra2->bairro_hosp .
                             ' de '. $mostra2->cidade_hosp.' - '.$mostra2->uf_hosp;?></span>   
                             </div>
                             <br>
                             <div class="col-sm-2">
                             <img src="assets/images/telefone.png" style="width: 40%;">  
                             </div>
                             <div class="col-sm-10">
                             <span style="margin-left: -30px; font-size: 16px;"><?= $mostra2->fone_hosp;?></span>   
                             </div>
                             </div>
                         </h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                            <center>
                             <h6 class="card-title mbr-fonts-style display-7">
                             <strong>Horário</strong><br>
                             <span style="font-size: 16px;">
                                 <?php
                              $select = "SELECT * from horarios WHERE est_id_hora = $mostra2->id_est";  
                              try{
                              $result = $conexao->prepare($select);
                              $result ->execute();
                              $contar = $result->rowCount();
                            
                              if($contar>0){
                              while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                              ?>
                              das <?= $mostra->in_hora;?> até às <?= $mostra->out_hora;?> <br />
                              <?php
                                }
                                }else{
                                  echo "<strong style='color: #fff;'>Nada cadastrado!</strong>";
                                }
                                }catch(PDOException $e){
                                  echo $e;
                                }
                             ?> 
             
                            </span>
                            </h6>  
                            </center>
                        </div>
                        <div class="col-sm-6">
                          <center>
                             <h6 class="card-title mbr-fonts-style display-7">
                             <strong>Dias da Semana</strong><br>
                             <span style="font-size: 16px;">
                              <?php
                              $select = "SELECT * from horarios WHERE est_id_hora = $mostra2->id_est";  
                              try{
                              $result = $conexao->prepare($select);
                              $result ->execute();
                              $contar = $result->rowCount();
                            
                              if($contar>0){
                              while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                              ?>
                              <?= $mostra->dia_hora;?><br />
                              <?php
                                }
                                }else{
                                  echo "<strong style='color: #fff;'>Nada cadastrado!</strong>";
                                }
                                }catch(PDOException $e){
                                  echo $e;
                                }
                             ?> 
                             </span>
                            </h6>
                          </center>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-lg-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-per-doc modal-content" style="background-color: #065021;">
                    <div class="text-wrapper">
                        <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Documentos</strong> 
                            <br><br>
                            </center>download
                        </h6>
                    </div>
                    <div class="container">
                      <div class="container">
                          <div class="row">
                            <div class="col-sm">
                              <a href="home.php?acao=atualizar-comprovante-de-residencia"><img src="assets/images/comprovante-de-residencia.png"></a>
                            </div>
                            <div class="col-sm">
                              <a href="home.php?acao=atualizar-plano-de-aula"><img src="assets/images/plano-de-aula.png"></a>
                            </div>
                            <div class="col-sm">
                              <a href="home.php?acao=atualizar-comprovante-de-vacinacao"><img src="assets/images/comprovante-de-vacina.png"></a>
                            </div>
                            <div class="col-sm">
                              <a href="arquivos/TERMO_DE_COMPROMISSO_DE_ESTÁGIO_EXTRACURRICULAR_att.pdf" target="_blank"><img src="assets/images/termos-de-compromisso.png"></a>
                            </div>
                          </div>
                        </div>
                        <br><br>
                        <div class="row">
                          <div class="col-sm-12">
                            <center><br>
                            <p style="font-size: 22px; color: #fff;">
                            As cópias dos seus documentos já constam<br><br> no nosso banco de dados.</p>
                            </center>
                          </div>
           
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal fade bd-example-modal-lg-6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-per modal-content" style="background-color: #88e450;">
                                                
                   <div class="text-wrapper">
              
                       <div class="col-md-12">
                            <span type="button" data-dismiss="modal" class="mbr-iconfont mobi-mbri-error mobi-mbri" style="float: right; font-size: 44px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        </div>
                
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong style="margin-left: 70px;">Sair do Estágio</strong> 
                            <br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1">
                                
                            </div>
                            <div class="col-md-10" style="background-color: #fff; border-radius: 25px; font-size: 12px;">
                                <h4 class="align-center" style="font-size: 14px; line-height: 1.5;">
                                <br>
                                <strong>CARTA DE PEDIDO DE ENCERRAMENTO DE ESTÁGIO</strong><br>
                                À MedHub, de CNPJ 47.204.204/0001-08.<br><br>
                                Eu, <?=$nomeLog;?>, inscrito(a) no CPF sob o nº <?=$cpfLog;?>, venho por meio desta solicitar o encerramento de meu estágio 
                                junto a esta empresa, agradecendo a oportunidade de complementação de minha formação acadêmica e experiência profissional, 
                                além de estar ciente da impossibilidade de inverter tal decisão.
                                <br>Serão arquivados os dados da renúncia no nosso banco de dados.
                                <br><br>
                                </h4>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-6">
                                <center>
                                <a href="home.php?acao=confirmar-senha&id_mat=<?= $mostra2->id_mat;?>" class="btn btn-white display-4" style="width: 280px;">Sair do Estágio</a> 
                                </center>
                            </div>
                            <div class="col-md-3">
                               
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>