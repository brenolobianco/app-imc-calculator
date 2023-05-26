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
            <div class="container">
              <div class="row">
                <div class="col-sm-7" style="margin-left: 50px; color: #fff;">
                  <h1 style="fotn-size: 130px;"><strong style="color: yellow;">PARABÉNS!!!</strong><h1> 
                  <h4>Você foi APROVADO e está CLASSIFICADO!</h4>
                  <br>
                  <p class="mbr-text mbr-fonts-style display-7"><?= $nomeLog;?>, é com enorme prazer que te entregamos o <span style="color: yellow;">Selo MedHub de Qualidade.</span> Você passou em nosso crivo e agora deve aguardar o contato da equipe MedHub para mais informações. Fique de olho em seu e-mail/WhatsApp.
                </div>
                <div class="col-sm-4">
                  <img src="assets/images/selo-medhub-506x506.png">
                </div>
                <div class="col-sm-12" style="margin-left: 50px; color: #fff;">
                  <p class="mbr-text mbr-fonts-style display-7">
                  <strong>Siga os próximos passos clicando em “Documentos”</strong></p>
                  <!-- <p class="mbr-text mbr-fonts-style display-7" style="color: yellow;"> -->
                  <!-- Você tem até o dia 10/10/2022 para registrar o seu crachá</p> -->
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
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12">
                            <center><br><br>
                              <p class="mbr-text mbr-fonts-style display-7" style="color: #fff;">
                              É obrigatório o registro do crachá na plataforma MedHub. Pegue seu crachá no Hospital e envie uma foto para nós.
                              </p>
                            </center>
                        </div>
                        <div class="col-sm-12">
                            <center><br />
                            <a class="btn btn-white display-4" href="" style="width: 280px;">Enviar Foto</a> 
                            </center>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper2" style="background-color: #555;">
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
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-align-justify mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Detalhes
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-5">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-paperclip mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Visualizar Comprovant
                        </h4>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #88e450; height: 500px;">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <center><br>
                            <strong>Visualizar Comprovant</strong> 
                            <br>
                            </center>
                        </h6>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12">
                            <center><br>
                              <p class="mbr-text mbr-fonts-style display-7" style="color: #fff;">
                              Agora você deverá levar o COMPROVANTE e DUAS fotos 3x4 para o Hospital, 
                              para receber o seu crachá. Após isso, você deverá vir aqui na plataforma para registrá-lo em “Registrar Crachá”.
                              <br>
                              Para conseguir entrar no estágio, você precisa mostrar de alguma forma esse comprovante aqui:
                              </p>
                            </center>
                        </div>
                        <div class="col-sm-12">
                            <center>
                            <a class="btn btn-white display-4" href="" style="width: 280px;">Baixar Comprovante</a> 
                            </center>
                        </div>
                        <div class="col-sm-12">
                            <center>
                              <p class="mbr-text mbr-fonts-style display-7" style="color: #fff;">
                              Ou você imprime o comprovante e mostra o papel no Hospital, ou pode somente baixar o comprovante e mostrar na tela do seu celular!
                              </p>
                              <br>
                              <p style="color: #fff; font-size: 12px;">Caso você não siga esses passos, sua vaga poderá ser destinada para outra pessoa.</p>
                            </center>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-logout mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Sair do Estágio
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








