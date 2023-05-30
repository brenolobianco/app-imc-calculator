<?php include_once 'controllers/curso/ControllerSelect.php';?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=hospital&id_est=<?= $id_est;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="header11 cid-tc0httnD9Z" id="header11-3v" style="margin-top: -25px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="prova-per col-12 col-md-5 image-wrapper">
                <div style='position:relative; top:0px; left:0px;'>
                    <img src="assets/images/background_verdeclaro.png">
                </div>
                <div class="img_hosp">
                    <img class="w-100" src="upload/<?= $img_curso;?>" alt="Área de prova">
                </div>
            </div>
            <div class="mar-per col-12 col-md">
                <div class="text-wrapper text-center" style="margin-right: 50px;">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong>Área de Prova</strong></h1>
                        <p class="mbr-text mbr-fonts-style display-7">
                        Nesse ambiente, você tem acesso ao concurso do Hospital escolhido. O nosso sistema de provas atende ao padrão Ouro de segurança e 
                        confiabilidade dos resultados.</p>
                    <div class="mbr-section-btn mt-3">
                        <a class="btn btn-white display-7" href="home.php?acao=curso&id_curso=<?= $id_curso;?>">Meu Curso</a>
                        <?php
                        
                        $select = "SELECT * from acad_pa p JOIN estagio e ON e.id_est = p.est_id_pa WHERE est_id_pa = $id_est LIMIT 1";  
                        try{
                        $result = $conexao->prepare($select);
                        $result ->execute();
                        $contar = $result->rowCount();
                        
                        if($contar>0){
                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                        ?>
                        <a href="listas/<?= $mostra->id_pa;?>/<?= $mostra->arq_pa; ?>" target="_blank">
                            <h3 style="margin-top: 30px; margin-left: 10px; color: yellow;">Visualizar Resultado</h3>
                        </a>
                        <?php
                        }
                        }
                        }catch(PDOException $e){
                        echo $e;
                        }
                        ?> 
                    </div>
                    
                    <br />
             
                    <img src="assets/images/bolo_forms.png" style="width: 300px;">   
   
                    <p class="mbr-section-title mbr-fonts-style align-center mb-4 display-7" style="font-size: 12px;">
                    Nosso sistema de provas é fiscalizado pelo software <strong style="color: orange;">BoloForms</strong>, que inviabiliza fraudes durante a realização do concurso, 
                    uma vez que o acadêmico está sujeito à fiscalização de áudio/vídeo, bem como à desclassificação, caso necessário.
                    </p>
                    <p class="mbr-section-title mbr-fonts-style align-center mb-4 display-7" style="font-size: 12px;">
                    <strong style="color: orange;">IMPORTANTE</strong><br />
                    O acadêmico deve certificar se a sua câmera e microfone estão ligados, 
                    para a averiguação de confiança de resultado pela Equipe MedHub. Ao finalizar a prova, receberemos as suas respostas, 
                    assim como o nível de confiabilidade de seu resultado pautado nos recursos presentes no Bolo Forms.
                    </p>
                  
                 
                    
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
                    <strong>Edital Resumido</strong></h3>
            </div>
        </div>
    </div>
</section>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <blockquote>
                <p class="mbr-text mbr-fonts-style display-4" style="height: 300px; overflow-y: scroll;">
                    <?= $edital_est;?>
                </p>
                </blockquote>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="mbr-section-btn mt-3">
                <?php
                    $select = "SELECT * from edital_pdf WHERE est_id_edital = $id_est LIMIT 1";  
                    try{
                    $result = $conexao->prepare($select);
                    $result ->execute();
                    $contar = $result->rowCount();
                
                    if($contar>0){
                    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                        
                ?>
                <a class="btn btn-white display-7" href="editais/<?= $mostra->id_edital;?>/<?= $mostra->arq_edital;?>" download>Download Edital Completo</a>
                <?php
                }
                }else{
                    echo 'Nenhum edital cadastrado!';
                }
                }catch(PDOException $e){
                    echo $e;
                }
                ?> 
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
                <div class="mbr-section-btn align-center"><a href="<?= $link_prova_est;?>" target="_blank" class="btn btn-white display-4">Acessar</a></div>
            </div>
        </div>
    </div>
</section>

<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">
    
    
    
    
    
    
    
    
    