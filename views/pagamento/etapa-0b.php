<br />
<?php 
include 'controllers/pagamento/ControllerSelect.php';

?>

<section class="form3 cid-tc0bT9FsJh" id="form3-3r" style="margin-top: 50px;">

    <div class="container">
 
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="card mb-3">
                  <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                  <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;;">
                    <h5 style="text-align: center; margin-top: 10px; font-size: 20px; color: #fff;">
                        de <s style="color: red;"><?= $valor_est?></s> por <strong style="color: #4ee44e; font-size: 30px;"><?= $valor_desc_est?></strong>
                    </h5>
                  </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">

            <?php
                $select = "SELECT * from matricula m JOIN curso c ON c.id_curso = curso_id_mat
                JOIN hospital h ON h.id_hosp = m.hosp_id_mat
                WHERE acad_id_mat = $idLog && pag_mat = 'Conferir'";  
                try{
                $result = $conexao->prepare($select);
                $result ->execute();
                $contar = $result->rowCount();

                if($contar>0){
                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                    
                   
            ?>
            <div class="card" style="color: #fff;">
              <div class="card-header">
                <?=$mostra->nome_hosp?>
              </div>
              <div class="card-body">
                <h5 class="card-title" style="color: orange;">Programa de Estágio</h5>
                <p class="card-text"><?=$mostra->nome_curso?><br> <br>Sua vaga está aguardando confirmação, click em comprar para confirmar!</p>
                <a href="home.php?acao=etapa-1&id_mat=<?=$mostra->id_mat?>"  class="btn btn-white display-4"> COMPRAR </a>
              </div>
            </div>
           

            <?php
            
            }
            }else{
                echo '<div class="alert alert-info">
                    <strong> Nenhum curso cadastrado!</strong> 
                    </div>';
            }
            }catch(PDOException $e){
                echo $e;
            }
            ?> 
                            
            </div>
            <div style="width: 100%; height:10px;"></div>
            
            <div class="offset-lg-1"></div>
        </div>
    </div>
</section>