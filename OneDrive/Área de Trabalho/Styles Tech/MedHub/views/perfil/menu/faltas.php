<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=perfil&id_acad=<?=$idLog;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="header14 cid-tbjtGztFjX" id="header14-q" style="margin-top: -50px;">
    
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-5 image-wrapper">
            <img src="assets/images/img-boxhipocratis-800x560.png" alt="MedHub - pesquisa">
        </div>
        <div class="col-12 col-md">
            <div class="text-wrapper">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>Falta</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>
                        <?php
                            $query_pres = "SELECT COUNT(id_pres) AS qnt_pres FROM presenca WHERE sit_pres ='Ausente'";
                            $result_pres = $conexao->prepare($query_pres);
                            $result_pres->execute();
                    
                            $row_pres = $result_pres->fetch(PDO::FETCH_ASSOC);
                            
                            if($row_pres['qnt_pres'] == 1){
                                $f = 'falta';
                            }else{
                                $f = 'faltas';
                            }
                              
                        ?>
                       <?= $nomeLog;?>, você já possui <span style="font-size: 30px; color: orange;"> <?= $row_pres['qnt_pres'];?> 
                       <?= $f;?> </span><span style="color: #fff;"> no total!</span><br><br><h4>
                              <?php 
                              $select = "SELECT * from presenca p
                              JOIN matricula m ON m.id_mat = p.mat_id_pres
                              LEFT JOIN estagio e ON e.id_est = m.est_id_mat
                              WHERE sit_pres = 'Ausente' ORDER BY id_pres DESC";  
                              try{
                              $result = $conexao->prepare($select);
                              $result ->execute();
                              $contar = $result->rowCount();
                            
                              if($contar>0){
                              while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                              ?>
                              <p>
                               <strong style="color: #fff;">Dia</strong> <span style="color: orange;">
                                   <?php $input = $mostra->data_pres; $date = strtotime($input); echo date('d/m/Y', $date);?>
                               </span><span style="color: #fff;"> no <?= $mostra->nome_est;?></span><br><br>
                              </p>
                              <?php
                                }
                                }else{
                                  echo '<div class="alert alert-info">
                                      <button type="button" class="close" data-dismiss="warning"></button>
                                      <strong> Nada Cadastrado!!!</strong> 
                                      </div>';
                                }
                                }catch(PDOException $e){
                                  echo $e;
                                }
                             ?> 

                    </p>
                <div class="mbr-section-btn mt-3">
                </div>
            </div>
        </div>
    </div>
</div>
</section>