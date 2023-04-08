<?php

<<<<<<< HEAD
include_once("../../../v2.php");
=======

function media_nota($conexao, $id_aula) {
    $select = "SELECT AVG(nota) as media FROM aula_treinamento_nota WHERE id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->fetch(PDO::FETCH_OBJ);
    return round($fetch->media, 2) ?? 0;
}


function visualizacoes($conexao, $id_aula) {
    $select = "SELECT SUM(assistido) as total FROM progresso_usuario_aulas WHERE id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->fetch(PDO::FETCH_OBJ);
    return $fetch->total ?? 0;
}


function visualizacoes_unicas($conexao, $id_aula) {
    $select = "SELECT COUNT(id_progresso) as total FROM progresso_usuario_aulas WHERE id_aula = :id_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->fetch(PDO::FETCH_OBJ);
    return $fetch->total ?? 0;
}

function getComentarios($conexao, $id_aula, $idLog) {
    $sql = "SELECT academico.nome_acad, nota.nota, nota.comentario FROM aula_treinamento_nota nota INNER JOIN academico ON nota.id_usuario = academico.id_acad WHERE id_aula = :id_aula ";
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->fetchAll(PDO::FETCH_OBJ);
    
    return $fetch;
} 


function primeiraLetra($nome) {
    $nome = explode(' ', $nome);
    return $nome[0][0];
}

function comentariosHtml($conexao, $id_aula, $idLog) {
    $comentarios = getComentarios($conexao, $id_aula, $idLog);
    $html = '';
    foreach ($comentarios as $key) {
        $nome = $key->nome_acad;
        $nota = $key->nota;
        $comentario = $key->comentario;
        $html .= '
            <div class="col-sm-4">
            <div class="comment">
                <div class="profıle-ımage">
                    <p class="name">'.primeiraLetra($nome).'</p>
                </div>
                <div class="username">'.$nome.' - Nota '.$nota.'</div>
                
                <div class="user-comment w-100">
                    <p>'.$comentario.'
                    </p>
                </div>
            
                </div>
            </div>    
        ';
    }

    return $html;
}

$id_aula = $_GET['id_aula'];
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650

?>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

<div class="content-page">
<<<<<<< HEAD
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
                                                    <p class="card-text"><?php ?></p>
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
                                                <h6 class="card-title"></h6>
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
=======
    <div class="content">
        <div class="container-fluid">
            <!-- ESTÁTISTICAS! -->
            <div class="col-sm-">
                <div class="card-box">
                    <h4 class="header-title mt-0 mb-3">Estatísticas</h4>

                    <div class="content">


                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-bar"></i> Estatísticas de visualizações
                                </h5>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card text-white bg-primary mb-3">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2"><i class="fas fa-eye"></i> Total de
                                                    visualizações</h6>
                                                <p class="card-text"><?php echo visualizacoes($conexao, $id_aula); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card text-white bg-success mb-3">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2"><i class="fas fa-eye"></i> Visualizações
                                                    únicas</h6>
                                                <p class="card-text">
                                                    <?php echo visualizacoes_unicas($conexao, $id_aula); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card text-white bg-danger mb-3">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2"><i class="fas fa-percentage"></i> Media
                                                    de nota</h6>
                                                <p class="card-text"><?php echo media_nota($conexao, $id_aula); ?></p>
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

            <div class="col-sm-">
                <div class="card">
                    <div class="row card-box">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <?php echo comentariosHtml($conexao, $id_aula, $idLog); ?>
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
                <a href="home.php?acao=aula-outros&id_aula=<?= $id_aula;?>" class="btn btn-primary">Copiar esta Aula em
                    outro Curso</a>
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                                                $select = "SELECT * from aula_pdf WHERE aula_id_pdf =$id_aula" ;  
                                                try{
                                                $result = $conexao->prepare($select);
                                                $result ->execute();
                                                $contar = $result->rowCount();

                                                if($contar>0){
                                                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                            ?>
<<<<<<< HEAD
                                            <iframe src="../pdfs/<?= $mostra->id_pdf;?>/<?= $mostra->arq_pdf;?>" width="100%" height="600" style="border: none;"></iframe>
                                            <?php
=======
                                <iframe src="../pdfs/<?= $mostra->id_pdf;?>/<?= $mostra->arq_pdf;?>" width="100%"
                                    height="600" style="border: none;"></iframe>
                                <?php
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
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
<<<<<<< HEAD
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
=======
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
                                                    $select = "SELECT * from aula_vid WHERE aula_id_vid =$id_aula" ;  
                                                    try{
                                                    $result = $conexao->prepare($select);
                                                    $result ->execute();
                                                    $contar = $result->rowCount();

                                                    if($contar>0){
                                                    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                ?>
<<<<<<< HEAD
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
=======
                                <div class="user-desc">
                                    <center>
                                        <video style="width: 100%; height: 70%;" controls>
                                            <source src="../videos/<?= $mostra->id_vid;?>/<?= $mostra->arq_vid;?>"
                                                type="video/mp4">
                                            <source src="../videos/<?= $mostra->id_vid;?>/<?= $mostra->arq_vid;?>"
                                                type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    </center>
                                </div>
                                <?php
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
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
<<<<<<< HEAD
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
=======
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

    .comment {
        width: 400px;
        height: 80px;
        margin: 10px auto;
        background: white;
        border-radius: 5px;
    }

    .comment .profıle-ımage {
        float: left;
        width: 60px;
        height: 60px;
        margin: 6px 0px 0px 6px;
        background: #148F77;
        border-radius: 300px;
    }

    .comment .profıle-ımage:hover {
        opacity: 0.6;
    }

    .comment .profıle-ımage .name {
        color: white;
        font-size: 25px;
        margin: 0px;
        padding-top: 15px;
        text-align: center;

    }

    .comment .username {
        float: left;
        color: #212121;
        margin: 15px 0px 0px 5px;
        padding: 0px;
    }

    .comment .username:hover {
        color: #757575;
    }


    .comment .user-comment {
        margin: 0px;
        padding: 0px;
        position: relative;
    }

    .comment .user-comment p {
        color: #424242;
        margin: 0px;
        padding: 0px;
        position: relative;
        font-size: 1em;
        top: 35px;
        left: -36px;
        float: left;
    }

    .comment .user-comment span {
        color: #9E9E9E;
        font-size: 13px;
        margin: 0px;
        padding: 0px;
        position: relative;
        left: 75px;
        top: -13px;
    }

    .comment .user-comment span:hover {
        color: #616161;
    }

    #ds p {
        font-size: 12px;
        color: #212121;
        opacity: 0.6;
    }

    #ds p:hover {
        cursor: pointer;
        opacity: 1.0;
    }
</style>

<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>

<script>

    function genColorByLetter(letter) {
        const colors = [
            '#f44336',
            '#e91e63',
            '#9c27b0',
            '#673ab7',
            '#3f51b5',
            '#2196f3',
            '#03a9f4',
            '#00bcd4',
            '#009688',
            '#4caf50',
            '#8bc34a',
            '#cddc39',
            '#ffeb3b',
            '#ffc107',
            '#ff9800',
            '#ff5722',
            '#795548',
            '#9e9e9e',
            '#607d8b'
        ];
        const index = letter.charCodeAt(0) % colors.length;
        return colors[index];
    }

    let profileImages = document.querySelectorAll('.profıle-ımage');
    profileImages.forEach(image => {
        let letter = image.querySelector(".name").innerText;
        image.style.backgroundColor = genColorByLetter(letter);        
    });
</script>

<script>
    $(document).ready(function () {
        $('.card-img-overlay-wrapper').on('mouseenter', function () {
            $(this).find('.card-img-overlay').fadeIn();
        }).on('mouseleave', function () {
            $(this).find('.card-img-overlay').fadeOut();
        });
    });
</script>

</body>

>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>