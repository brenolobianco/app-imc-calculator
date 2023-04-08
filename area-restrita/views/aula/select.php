
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <?php include_once 'controllers/aula/ControllerSelect.php';?>
                            <div class="col-sm-12">
                                <h3>Aula do curso <?= $nome_curso;?></h3>
                            </div>
                            <div class="col-md-12">
                                <a href="home.php?acao=aula-outros&id_aula=<?= $id_aula;?>" class="btn btn-primary">Copiar esta Aula em outro Curso</a>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="card-body">
                                                <h4 class="card-title">Aula: <?= $nome_aula;?></h4>
                                                <p class="card-text"><strong>Estágio:</strong> <?= $nome_est;?></p>
                                                <p class="card-text"><strong>Módulo: </strong> <?= $nome_mod;?></p>
                                                <p class="card-text"><strong>Curso:</strong> <?= $nome_curso;?></p>
                                                <p class="card-text"><strong>Professor:</strong> <?= $nome_prof;?></p>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="card-body">
                                                <h4 class="card-title">Descrição da aula <?= $nome_aula;?></h4>
                                                <p class="card-text"><?= $desc_aula;?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-sm-6">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">PDF</h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                            <?php
                                                $select = "SELECT * from aula_pdf WHERE aula_id_pdf =$id_aula" ;  
                                                try{
                                                $result = $conexao->prepare($select);
                                                $result ->execute();
                                                $contar = $result->rowCount();

                                                if($contar>0){
                                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                            ?>
                                            <iframe src="../pdfs/<?= $mostra->id_pdf;?>/<?= $mostra->arq_pdf;?>" width="100%" height="600" style="border: none;"></iframe>
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
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">Videos</h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                                <?php
                                                    $select = "SELECT * from aula_vid WHERE aula_id_vid =$id_aula" ;  
                                                    try{
                                                    $result = $conexao->prepare($select);
                                                    $result ->execute();
                                                    $contar = $result->rowCount();

                                                    if($contar>0){
                                                    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                ?>
                                                <div class="user-desc">
                                                <center>
                                                    <video style="width: 100%; height: 70%;" controls>
                                                        <source src="../videos/<?= $mostra->id_vid;?>/<?= $mostra->arq_vid;?>" type="video/mp4">
                                                        <source src="../videos/<?= $mostra->id_vid;?>/<?= $mostra->arq_vid;?>" type="video/ogg">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </center> 
                                                </div>
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
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>               
                        </div>
                    </div> 
                <?php include 'footer.php';?>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>