<?php include_once 'controllers/perfil/ControllerSelect.php';?>
<section class="header14 cid-tbp7qnWREW" id="header14-y" style="margin-top: -80px;">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <a href="home.php?" class="nav-link link btn btn-default mb-4 display-2" style="float: left; margin-left: 40px; margin-top: 0px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6 image-wrapper">
            <?php if($img_acad == null){
                $perfil = "assets/images/user.png";
            }else{
                $perfil = "upload/$img_acad";
            }?>
            <div style='position:relative; top:0px; left:0px;'>
                <img src="assets/images/background_verdeclaro.png">
            </div>
            <div class="img_perfil">
                <img src="<?= $perfil;?>" alt="MedHub">  
            </div>

        </div>
        <div class="col-12 col-md">
            <div class="text-wrapper">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>Perfil</strong></h1>
                <p class="mbr-text mbr-fonts-style display-7">
                <?=$nome_acad;?></p>
                <p class="mbr-text mbr-fonts-style display-7">
                <?=$data_nasc_acad;?></p>
                <p class="mbr-text mbr-fonts-style display-7">
                <?=$univ_imp_acad;?></p>
                
                <p class="mbr-text mbr-fonts-style display-7">
                <a style="margin-left: -10;" class="btn btn-white display-4" href="home.php?acao=meus-dados&id_acad=<?= $id_acad;?>" style="width: 200px;">Meus Dados</a></p>
            </div>
        </div>
    </div>
</div>
</section>

<section class="content11 cid-tbuTtlCPxf" id="content12-1h">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="mbr-section-btn align-center">
                
				<a class="btn btn-black display-4" href="home.php?acao=perfil-estagios&id_acad=<?= $id_acad;?>" style="width: 200px;">Meu Estágio</a> 
				<a class="btn btn-white display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?= $id_acad;?>"  style="width: 200px;">Minhas Inscrições</a>
                <a class="btn btn-white display-4" href="home.php?acao=perfil-meus-dados&id_acad=<?= $id_acad;?>"  style="width: 200px;">Meus Dados</a>
				</div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="features16 cid-tbuZATmCi7" id="features18-1i">
    <div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <strong>Escolher Estágio:</strong>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <select class="place_form2 form-control form-control-sm">
                      <option>estágio 1</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

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
            <div class="modal fade bd-example-modal-lg-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #065021; height: 500px;">
                    
                    
                    <div class="container">
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style display-5">
                                <center><br>
                                <strong>Falta</strong> 
                                </center>
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-6" style="color: #fff;">
                              <h4><br><br><br><?= $nomeLog;?>, você já tem <br><br><span style="color: orange;">12 faltas!</span><br><br><h4>
                              <p>
                               A última foi dia <span style="color: orange;">04/07/2022</span><br><br>
                              </p>
                              
                            </div>
                            <div class="col-sm-5">
                              <img src="assets/images/hipocrates-fdo-400x400.png">
                            </div>
                         </div>
                         <div class="row">
                        <div class="col-sm-12">
                            <center><br>
                            <a class="btn btn-white display-4" href="/home.php?acao=perfil-faltas" style="width: 280px;">Visualizar Todas Faltas</a> 
                            </center>
                        </div>
           
                      </div>
                    </div>
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
            <div class="modal fade bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #88e450; height: 500px;">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Registrar Crachá</strong> 
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
            <div class="modal fade bd-example-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #065021; height: 500px;">
                  <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Tempo</strong> 
                            <br><br><br>
                            <img src="assets/images/tempo.png" width="80%">
                            </center>
                            <div class="container">
                              <div class="row">
                                <div class="col-sm-6">
                                    <center>
                                      Começa <br>
                                      <span style="font-size: 16px;">08/09/22</span>
                                    </center>
                                </div>
                                <div class="col-sm-6">
                                    <center>
                                      Termina<br>
                                      <span style="font-size: 16px;">10/04/24</span>
                                    </center>
                                </div>
                            
                              </div>
                            </div>
                        </h6>
                    </div>
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
            <div class="modal fade bd-example-modal-lg-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #88e450; height: 500px;">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Detalhes</strong> 
                            <br><br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-4">
                          <img src="assets/images/box-minhas-inscr001-980x784.png">
                        </div>
                        <div class="col-sm-8">
                            <h6 class="card-title mbr-fonts-style display-5">
                             <strong>Nome do Hospital</strong>
                            </h6>
                         <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-7" style="font-size: 16px; color: #fff;">
                             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
                             industry's standard dummy text ever since the 1500s.
                             <br><br>
                             <div class="row">
                             <div class="col-sm-2">
                             <img src="assets/images/endereco.png" style="width: 40%;">  
                             </div>
                             <div class="col-sm-5">
                             <span style="margin-left: -60px; font-size: 16px;">Endereço</span>   
                             </div>
                             <div class="col-sm-2">
                             <img src="assets/images/telefone.png" style="width: 40%;">  
                             </div>
                             <div class="col-sm-3">
                             <span style="margin-left: -60px; font-size: 16px;">(00) 0000-0000</span>   
                             </div>
                             </div>
                         </h4>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-6">
                            <center>
                             <h6 class="card-title mbr-fonts-style display-5">
                             <strong>Horário</strong><br>
                             <span style="font-size: 16px;">das 8h até às 16h</span>
                            </h6>  
                            </center>
                        </div>
                        <div class="col-sm-6">
                          <center>
                             <h6 class="card-title mbr-fonts-style display-5">
                             <strong>Dia da Semana</strong><br>
                             <span style="font-size: 16px;">segundas e quintas</span>
                            </h6>
                          </center>
                        </div>
                      </div>
                    </div>
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
             <div class="modal fade bd-example-modal-lg-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #065021; height: 500px;">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Documentos</strong> 
                            <br><br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12">
                            <img src="assets/images/arquivos-2.png">
                        </div>
                      </div>
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
            <div class="modal fade bd-example-modal-lg-6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #88e450; height: 500px;">
                   <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Sair do Estágio</strong> 
                            <br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10" style="background-color: #fff; border-radius: 25px; font-size: 12px;">
                                <h4 class="align-center" style="font-size: 12px; line-height: 1.5;">
                                <br>
                                <strong>CARTA DE PEDIDO DE ENCERRAMENTO DE ESTÁGIO</strong><br>
                                À MedHub, de CNPJ 47.204.204/0001-08.<br>
                                Eu, (nome do acadêmico), inscrito(a) no CPF sob o nº (informar), venho por meio desta solicitar o encerramento de meu estágio 
                                junto a esta empresa, agradecendo a oportunidade de complementação de minha formação acadêmica e experiência profissional, 
                                além de estar ciente da impossibilidade de inverter tal decisão.
                                <br>(dia) de (mês) de (ano). - arquivar dados da renuncia no nbanco de dados.
                                
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
                            <form action="">
                              <div class="form-group">
                                <input type="text" class="place_form form-control" id="formGroupExampleInput" placeholder="Senha">
                              </div>
                              <div class="form-group">
                                <input type="text" class="place_form form-control" id="formGroupExampleInput2" placeholder="Confirmar senha">
                              </div>
                              <div class="form-group">
                                <center>
                                <a class="btn btn-white display-4" href="home.php?acao=motivo-da-desistencia" style="width: 280px;">Sair do Estágio</a> 
                                </center>
                              </div>
                            </form>
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




