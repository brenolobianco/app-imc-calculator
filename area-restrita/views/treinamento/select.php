

<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

<div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                            <!-- ESTÁTISTICAS! -->
                            <div class="col-sm-">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">Estatísticas</h4>

                                    <div class="content">


                                    <div class="card shadow">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-chart-bar"></i> Estatísticas de visualizações</h5>
                                            <div class="row">
                                            <div class="col-sm-4">
                                                <div class="card text-white bg-primary mb-3">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2"><i class="fas fa-eye"></i> Total de visualizações</h6>
                                                    <p class="card-text">100</p>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card text-white bg-success mb-3">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2"><i class="fas fa-eye"></i> Visualizações únicas</h6>
                                                    <p class="card-text">80</p>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card text-white bg-danger mb-3">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2"><i class="fas fa-percentage"></i> Media de notas</h6>
                                                    <p class="card-text">8.9</p>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- FIM ESTÁTISTICAS! -->

                            <div class="col-sm">
                                <div class="card-box">
                                <div class="card shadow">
  <div class="card-body">
    <h5 class="card-title">Comentários</h5>
    <div class="row">
      <div class="col-sm-4">
        <div class="card-img-overlay-wrapper">
          <img class="card-img rounded-circle" src="https://cdn2.iconfinder.com/data/icons/male-avatars/512/avatars_accounts___man_male_people_person_cowboy_hat.png" alt="Imagem do usuário 1">
          <div class="card-img-overlay">
            <h6 class="card-title">Comentário do usuário 1</h6>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, erat in molestie ullamcorper, sapien tortor blandit quam, a cursus est ex id lectus.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-img-overlay-wrapper">
          <img class="card-img rounded-circle" src="https://cdn0.iconfinder.com/data/icons/covid-19-3d/512/person_wearing_mask.png" alt="Imagem do usuário 2">
          <div class="card-img-overlay">
            <h6 class="card-title">Comentário do usuário 2</h6>
            <p class="card-text">Suspendisse potenti. Maecenas commodo mauris in orci dictum, at ullamcorper velit semper. Pellentesque euismod orci nec risus sagittis, ut elementum elit euismod.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card-img-overlay-wrapper">
          <img class="card-img rounded-circle" src="/assets/images/2-518x518.png" alt="Imagem do usuário 3">
          <div class="card-img-overlay">
            <h6 class="card-title">Comentário do usuário 3</h6>
            <p class="card-text">Fusce rutrum suscipit nisl, sed hendrerit felis. Integer dictum pharetra dolor, quis bibendum nibh fermentum nec.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

                                </div>
                            </div>
        

                        <div class="row">
                            <?php include_once 'controllers/treinamento/AulaControllerSelect.php';?>
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

        <style>
            .card-title {
  font-family: 'Roboto', sans-serif;
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1rem;
}
.card-subtitle {
  font-family: 'Roboto', sans-serif;
  font-size: 1rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}
.card-text {
  font-family: 'Roboto', sans-serif;
  font-size: 1.25rem;
  font-weight: 700;
}

.card-img-overlay-wrapper {
  position: relative;
}
.card-img-overlay {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  padding: 20px;
  text-align: center;
}
.card-img-overlay:hover {
  display: block;
}


        </style>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <script>
            $(document).ready(function() {
  $('.card-img-overlay-wrapper').on('mouseenter', function() {
    $(this).find('.card-img-overlay').fadeIn();
  }).on('mouseleave', function() {
    $(this).find('.card-img-overlay').fadeOut();
  });
});

        </script>
        
    </body>
</html>