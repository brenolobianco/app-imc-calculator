

        <div class="content-page">
            <div class="content">
                <div class="row">
                            <div class="col-xl-12">
                                <?php include_once 'controllers/ranking/ControllerSelect.php';?>
                            </div>
                        </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6">
                                <h4>Ranking <?= $nome_est;?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Ranking de Classificados</h4>

                                    <div class="inbox-widget">
                                        <?php
                                            $i = 1;
                                            $select = "SELECT * from matricula m JOIN academico a 
                                            ON a.id_acad = m.acad_id_mat WHERE est_id_mat = $id_est 
                                            ORDER BY nota_mat DESC";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();

                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

                                        ?>
                                        <div class="inbox-item">
                                            <a href="home.php?acao=academico&id_acad=<?= $mostra->id_acad;?>">
                                                <?php 
                                                if($mostra->img_acad != null){
                                                    $img_acad2 = "../upload/$mostra->img_acad";
                                                }else{
                                                    $img_acad2 = "assets/images/users/user.png";
                                                }
                                                ?>
                                                <div class="inbox-item-img"><img src="<?= $img_acad2;?>" class="rounded-circle" alt=""></div>
                                                <h5 class="inbox-item-author mt-0 mb-1"><?= $mostra->nome_acad;?></h5>
                                                <p class="inbox-item-text">
                                                    <?php 
                                                    if($mostra->nota_mat >= 7 ){
                                                        echo "Aprovado em ".$i++."º lugar";
                                                    }else{
                                                        echo 'Reprovado';
                                                    } 
                                                    ?> 
                                                </p>
                                                <p class="inbox-item-date">Nota: <?= $mostra->nota_mat;?></p>
                                            </a>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                            echo '<div class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="warning"></button>
                                                <strong> Nenhum acadêmico cadastrado!!!</strong> 
                                                </div>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                        ?>    
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Indicações</h4>

                                    <div class="inbox-widget">
                                        <?php
                                            $select = "SELECT * from matricula m JOIN academico a 
                                            ON a.id_acad = m.acad_id_mat WHERE est_id_mat = $id_est && nota_mat = 999";  
                                            try{
                                            $result = $conexao->prepare($select);
                                            $result ->execute();
                                            $contar = $result->rowCount();

                                            if($contar>0){
                                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

                                        ?>
                            
                                        <div class="inbox-item">
                                        <a href="home.php?acao=academico&id_acad=<?= $mostra->id_acad;?>">
                                                <?php 
                                                if($mostra->img_acad != null){
                                                    $img_acad2 = "../upload/$mostra->img_acad";
                                                }else{
                                                    $img_acad2 = "assets/images/users/user.png";
                                                }
                                                ?>
                                                <div class="inbox-item-img"><img src="<?= $img_acad2;?>" class="rounded-circle" alt=""></div>
                                                <h5 class="inbox-item-author mt-0 mb-1"><?= $mostra->nome_acad;?></h5>
                                                <p class="inbox-item-text">
                                                    Indicação
                                                </p>
                                                <p class="inbox-item-date">Indicado por <?= $mostra->indicado_mat;?></p>
                                            </a>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                            echo '<div class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="warning"></button>
                                                <strong> Nenhum acadêmico cadastrado!!!</strong> 
                                                </div>';
                                        }
                                        }catch(PDOException $e){
                                            echo $e;
                                        }
                                        ?> 
                                    </div>
                                </div>
                            </div>

                                                  
                    </div> 
                </div> 
 
                <?php include "footer.php";?>

            </div>
        </div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="assets/libs/morris-js/morris.min.js"></script>
        <script src="assets/libs/raphael/raphael.min.js"></script>
        <script src="assets/js/pages/dashboard.init.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>
