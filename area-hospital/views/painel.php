

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <h5>Solicitações de Crachá</h5>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <?php
                                $select = "SELECT * from matricula m 
                                JOIN estagio e ON e.id_est = m.est_id_mat
                                JOIN academico a ON a.id_acad = m.acad_id_mat
                                WHERE cert_mat ='sim'";  
                                try{
                                $result = $conexao->prepare($select);
                                $result ->execute();
                                $contar = $result->rowCount();

                                if($contar>0){
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

                                    if($mostra->hosp_id_est == $idLog){
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box widget-user">
                                    <div class="media">
                                        <?php 
                                        if($mostra->img_acad != null){
                                            $img_acad2 = "../upload/$mostra->img_acad";
                                        }else{
                                            $img_acad2 = "assets/images/users/user.png";
                                        }
                                        ?>
                                        <div class="avatar-lg mr-3">
                                            <img src="<?= $img_acad2;?>" class="img-fluid rounded-circle" alt="user">
                                        </div>
                                        <div class="media-body overflow-hidden">
                                            <h5 class="mt-0 mb-1"><?=$mostra->nome_acad;?></h5>
                                            <p class="text-muted mb-2 font-13 text-truncate"><?=$mostra->nome_est;?></p>
                                            <a href="home.php?acao=academico&id_acad=<?=$mostra->id_acad;?>" class="btn btn-sm btn-info">Conferir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }else{
                                echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="warning"></button>
                                    <strong> Nada Cadastrado!!!</strong> 
                                    </div>';
                            }
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

                        </div>
                        <br /><br />
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <h5>Solicitações de Desitência</h5>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <?php
                                $select = "SELECT * from matricula m 
                                JOIN estagio e ON e.id_est = m.est_id_mat
                                JOIN academico a ON a.id_acad = m.acad_id_mat
                                WHERE data_des_mat != ' null '";  
                                try{
                                $result = $conexao->prepare($select);
                                $result ->execute();
                                $contar = $result->rowCount();

                                if($contar>0){
                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

                                    if($mostra->hosp_id_est == $idLog){
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box widget-user">
                                    <div class="media">
                                        <?php 
                                        if($mostra->img_acad != null){
                                            $img_acad2 = "../upload/$mostra->img_acad";
                                        }else{
                                            $img_acad2 = "assets/images/users/user.png";
                                        }
                                        ?>
                                        <div class="avatar-lg mr-3">
                                            <img src="<?= $img_acad2;?>" class="img-fluid rounded-circle" alt="user">
                                        </div>
                                        <div class="media-body overflow-hidden">
                                            <h5 class="mt-0 mb-1"><?= $mostra->nome_acad;?></h5>
                                            <p class="text-muted mb-2 font-13 text-truncate"><?= $mostra->nome_est;?></p>
                                            <a href="home.php?acao=academico&id_acad=<?=$mostra->id_acad;?>" class="btn btn-sm btn-danger">Conferir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }else{
                                echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="warning"></button>
                                    <strong> Nada Cadastrado!!!</strong> 
                                    </div>';
                            }
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
