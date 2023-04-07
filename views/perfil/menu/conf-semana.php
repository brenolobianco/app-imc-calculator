<?php include_once 'controllers/horarios/ControllerUpdate.php';  ?>

<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
      
    <div class="container-fluid">
        <div class="row">
        <?php include_once 'controllers/cadastrar/ControllerInsert.php';?>
        </div>
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
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Confirmar Dia da Semana</strong>  
                </h3> 
                <center>
                <h4 style="color: #fff; line-height: 1.5;">
                Dia selecionado <span style="color: orange;"><?=$dia_hora?></span>, no perido de <span style="color: orange;"><?=$in_hora?></span> à <span style="color: orange;"><?=$out_hora?></span>.<br> Caso você não confirme, 
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

                
                <form method="post" action="#">
                     <center>
                      <div class="form-group">
                      
                        <input type="hidden" name="acad_id_hora" value="<?= $idLog;?>">
                   
                        
                        <div class="form-group">
                        <input name="atualizar" type="submit" class="btn btn-white display-4" style="width: 200px;" value="Prosseguir"/>
                        </div>
                      </center>
                      </div>
                      
                    </form>
               

              </div>
            </center>
           <br><br>
        </div>
           
            
    </div>

    </div>
</div>

 <div style="width: 100%; height: 200px;"></div>
</section>

