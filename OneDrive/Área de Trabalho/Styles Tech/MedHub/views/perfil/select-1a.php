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
                <div class="col-12 col-lg-5">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <strong>Escolher Estágio:</strong>
                        </h6>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <form action="#" method="POST">
                    <select class="place_form2 form-control form-control-sm">
                      <option><a href="" class="btn btn-white display-4">Estágio 1</a></option>
                    </select>
                </div>
                <div class="col-12 col-lg-2">
                    <button class="btn btn-white display-4">OK</button>
                    </form>
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
                  <h4> Você foi APROVADO!</h4>
                  <br>
                  <p class="mbr-text mbr-fonts-style display-7"> 
                   <?= $nomeLog;?>, é com enorme prazer que te entregamos o Selo MedHub de Qualidade. Você passou em nosso crivo e agora se encontra na LISTA DE ESPERA. Entraremos em contato caso você seja classificado(a).
                  <br>
                  Obs: a aprovação se refere à pontuação acima da média estabelecida pelo edital, já a classificação se refere ao fato de o acadêmico estar ou não dentro do número de vagas oferecidas.
                </div>
                <div class="col-sm-4">
                  <img src="assets/images/selo-medhub-506x506.png">
                </div>
                <!--<div class="col-sm-12" style="margin-left: 50px; color: #fff;">
                  <p class="mbr-text mbr-fonts-style display-7">
                  <strong>Siga os próximos passos clicando em “Documentos”</strong></p>
                  <p class="mbr-text mbr-fonts-style display-7" style="color: yellow;">Você tem até o dia 05/05/22, às 
                  23h59 para enviar todas as informações necessárias, se não sua vaga poderá ser destinada 
                  para outra pessoa!</p>
                </div>-->
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
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-wrapper" style="background-color: #555;">
                    <div class="card-box align-center">
                        <span class="mbr-iconfont mobi-mbri-paperclip mobi-mbri" style="font-size: 64px; color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
                        <h4 class="card-title align-center mbr-black mbr-fonts-style display-7">
                            Documentos
                        </h4>
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




