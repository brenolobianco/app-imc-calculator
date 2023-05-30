<?php include_once 'controllers/matricula/ControllerUpdateTermos.php';  ?>
<div class="container">
<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <a href="home.php?acao=upload-plano-de-aula" class="nav-link link btn btn-default mb-4 display-2" style="float: left; margin-left: 0px; margin-top: -20px;">
                <img src="assets/images/voltar-light.png" style="width: 100px;">
            </a>
            </div>
            <div class="col-sm-12">
                <center>
                <img src="assets/images/step-1.png" style="width: 300px; margin-top: -20px">
                <br>
                </center>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Conferir Apólice e os Termos!!!</strong>
                </h3>
                <center>
                 <h5 style="color: #fff; line-height: 1.4;">As informações sobre a apólice de seguro necessárias 
                 para a realização do estágio, você tratar perante o hospital/instituição de ensino.</h5> <br>
                 <h3>
                    <a href="arquivos/TERMO_DE_COMPROMISSO_DE_ESTÁGIO_EXTRACURRICULAR_att.pdf" style="color: orange;" download>Baixar os Termos de Compromisso</a>
                 </h3> 
                </center>
            </div>
        </div>
    </div>
</section>
<br>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <center>
                    <form action="#" method="POST">
                     <input type="hidden" name="termos_mat" value="Eu <?=$nomeLog;?>, aceito as definições da apólice e os termos."> 
                     <button type="submit" name="atualizar" class="btn btn-white display-4" style="width: 200px;">Eu Aceito</button>   
                    </form>
                </center>
            </div>
        </div>
        <div class="col-sm-12" style="height: 100px;">

        </div>
    </div>
</div>
</section>
