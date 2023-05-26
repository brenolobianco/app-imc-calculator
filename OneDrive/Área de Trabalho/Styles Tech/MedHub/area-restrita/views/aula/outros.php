

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                               <?php 
                               include_once 'controllers/aula/ControllerSelect.php';
                               include_once 'controllers/aula/ControllerInsert.php';
                               ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Nova Aula <?= $nome_aula;?></h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Qual o outro curso?</label>
                                            <div class="col-sm-5">
                                                <input type="hidden" name="nome_aula" value="<?= $nome_aula?>">
                                                <input type="hidden" name="desc_aula" value="<?= $desc_aula;?>">
                                                <input type="hidden" name="prof_id_aula" value="<?= $prof_id_aula;?>"> 
                                                <input type="hidden" name="mod_id_aula" value="<?= $mod_id_aula;?>">
                                                <input type="hidden" name="est_id_aula" value="<?= $est_id_aula;?>">
                                                <select name="curso_id_aula" class="form-control">
                                                    <?php
                                                        $select = "SELECT * from curso";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_curso;?>"><?= $mostra->nome_curso;?></option>
                                                    <?php
                                                    }
                                                    }else{
                                                        echo '<div class="alert alert-info">
                                                            <button type="button" class="close" data-dismiss="warning"></button>
                                                            <strong> Nada Cadastrado!!!</strong> 
                                                            </div>';
                                                    }
                                                    }catch(PDOException $e){
                                                        echo '<div class="alert alert-info">
                                                            <button type="button" class="close" data-dismiss="warning"></button>
                                                            <strong> Você não pode excluir este curso, pois está vinculado à uma ou mais Aulas!</strong> 
                                                            </div>';
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="cadastrar" class="btn btn-success waves-effect waves-light">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                    </div> 
                </div> 

                <?php include 'footer.php';?>

            </div>

        </div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/dropify/dropify.min.js"></script>
        <script src="assets/js/pages/form-fileupload.init.js"></script>

    </body>
</html>