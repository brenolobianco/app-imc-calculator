<?php include_once 'controllers/estagio/ControllerSelect.php'; ?>

<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
     <div class="row">
        <div class="col-sm-12">
        <a href="home.php?acao=perfil&id_acad=<?=$idLog;?>" class="nav-link link btn btn-default mb-4 display-2" style="float: left; margin-left: 80px; margin-top: -30px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
        </div>
        <div class="col-sm-12">
            <center>
            <img src="assets/images/step-2.png" style="width: 300px; margin-top: -20px">
            <br>
            </center>
        </div>
    </div> 
    <div class="container-fluid">
        <div class="row">
        <?php include_once 'controllers/cadastrar/ControllerInsert.php';?>
        </div>
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Dia da Semana</strong>  
                </h3> 
                <center>
                <h4 style="color: #fff; line-height: 1.5;">Selecione o seu dia da semana. Caso ele não esteja disponível, 
                a vaga será repassada para o próximo candidato do ranking, conforme descrito no Edital do concurso.</h4>
                </center>    
            </div>
        </div>
    </div>
</section>
<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            

            <center>
              <div class="col-sm-12">
                <?php
                
                    $select = "SELECT * from horarios WHERE est_id_hora = $id_est";  
                    try{
                    $result = $conexao->prepare($select);
                    $result ->execute();
                    $contar = $result->rowCount();
                
                    if($contar>0){
                    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                        
                    if($mostra->acad_id_hora == null){
                            
                ?>

                <a href="home.php?acao=confirmar-a-semana&id_hora=<?=$mostra->id_hora;?>" class="btn btn-white display-4" style="width: 170px;"><?=$mostra->dia_hora;?></a>
               
                <?php
                }
                }
                }else{
                    echo '<h3 style="color: orange;">Você já selecionou seu horário!</h3>
                    <br>  <span style="color: #fff;"><a href="home.php?acao=upload-comprovante-de-residencia">Click AQUI refazer o upload dos documentos!</a></span>';
                }
                }catch(PDOException $e){
                    echo $e;
                }
                ?>
              </div>
            </center>
           <br><br>
        </div>
           
            
    </div>

    </div>
</div>

 <div style="width: 100%; height: 200px;"></div>
</section>

