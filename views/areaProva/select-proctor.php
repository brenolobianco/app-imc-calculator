<?php include_once 'controllers/curso/ControllerSelect.php';?>
<div class="container">
    <div class="row">
        <a class="nav-link link btn btn-default mb-4 display-2" style="margin-left: -100px; margin-top: 30px;" href="home.php?acao=hospital&id_est=<?= $id_est;?>" style="width: 150px;"><img src="assets/images/voltar-light.png" style="width: 100px;"></a>
    </div>
</div>  
<section class="header11 cid-tc0httnD9Z" id="header11-3v" style="margin-top: -50px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 image-wrapper">
                <div style='position:relative; top:0px; left:0px;'>
                    <img src="assets/images/background_verdeclaro.png">
                </div>
                <div class="img_hosp">
                    <img class="w-100" src="upload/<?= $img_curso;?>" alt="Área de prova">
                </div>
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper text-center" style="margin-right: 50px;">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong>Área de Prova</strong></h1>
                        <p class="mbr-text mbr-fonts-style display-7">
                        Nesse ambiente, você tem acesso ao concurso do Hospital escolhido. O nosso sistema de provas atende ao padrão Ouro de segurança e 
                        confiabilidade dos resultados.</p>
                    <div class="mbr-section-btn mt-3">
                        <a class="btn btn-white display-7" href="home.php?acao=curso&id_curso=<?= $id_curso;?>">Meu Curso</a>
                    </div>
                    <br />
                    <div style="width: 150px;">
                     <img src="assets/images/Logo_protector.png" style="width: 100px;">   
                    </div>
                    <div style="margin-left: 120px; margin-top: -70px;">
                    <p class="mbr-section-title mbr-fonts-style align-center mb-4 display-7" style="font-size: 12px;">
                    Nosso sistema de provas é fiscalizado pelo software PROCTOR, que inviabiliza fraudes durante a realização do concurso, 
                    uma vez que o acadêmico está sujeito à fiscalização de áudio/vídeo, bem como à desclassificação, caso necessário.
                    </p>
                    </div>
                 
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Edital</strong></h3>
            </div>
        </div>
    </div>
</section>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <blockquote>
                <p class="mbr-text mbr-fonts-style display-4">
                    <?= $edital_est;?>
                </p>
                </blockquote>
            </div>
        </div>
    </div>
</section>


<!--<section class="content11 cid-tc0htzRrif" id="content11-43">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="mbr-section-btn align-center"><a class="btn btn-white display-4" href="">Ver mais</a></div>
            </div>
        </div>
    </div>
</section>-->

<section class="content4 cid-tc0htAmNz2" id="content4-44">
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Realizar Prova</strong></h3>
                
                
            </div>
        </div>
    </div>
</section>

<section class="content4 cid-tc0i5pOMKt" id="content4-47">
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-9">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-7">“Neste trabalho contra a doença, começamos não com interações genéticas ou celulares, mas com seres humanos. São eles que tornam a medicina tão complexa e fascinante” (Atul Gawande).
</h3>
                <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-5"><strong>
                    Boa Prova!</strong></h4>
                <div class="mbr-section-btn align-center"><a class="btn btn-white display-4" href="home.php?acao=prova&id_est=<?= $id_est;?>">Acessar</a></div>
            </div>
        </div>
    </div>
</section>

<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">