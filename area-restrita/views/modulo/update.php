
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/modulo/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Módulo</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre o Módulo</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nome_mod" class="form-control" value="<?= $nome_mod;?>">
                                            </div>  
                                        </div>
                                        
                                         <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Estágio e Curso</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="est_id_mod">
                                                    <option value="<?= $id_est;?>">Estágio atual é <?= $nome_est;?></option>
                                                    <?php
                                                        $select = "SELECT * from estagio";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>"><?= $mostra->nome_est;?></option>
                                                    <?php
                                                    }
                                                    }else{
                                                        echo '<div class="alert alert-info">
                                                            <button type="button" class="close" data-dismiss="warning">x</button>
                                                            <strong> Nada Cadastrado!!!</strong> 
                                                            </div>';
                                                    }
                                                    }catch(PDOException $e){
                                                        echo $e;
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-5">  
                                                <select class="form-control" name="curso_id_mod">
                                                    <option value="<?= $id_curso;?>">Curso atual é <?= $nome_curso;?></option>
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
                                                            <button type="button" class="close" data-dismiss="warning">x</button>
                                                            <strong> Nada Cadastrado!!!</strong> 
                                                            </div>';
                                                    }
                                                    }catch(PDOException $e){
                                                        echo $e;
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Treinamento(ignore se for um curso)</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="est_id_mod_treinamento">
                                                    <option value="">Escolher o Estágio...</option>
                                                    <?php
                                                        $select = "SELECT * from estagio";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>"><?= $mostra->nome_est;?></option>
                                                    <?php
                                                    }
                                                    }else{
                                                        echo '<div class="alert alert-info">
                                                            <button type="button" class="close" data-dismiss="warning">x</button>
                                                            <strong> Nada Cadastrado!!!</strong> 
                                                            </div>';
                                                    }
                                                    }catch(PDOException $e){
                                                        echo $e;
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-5">  
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição do módulo</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="desc_mod" class="form-control"><?= $desc_mod;?></textarea>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="atualizar" class="btn btn-success waves-effect waves-light">Salvar</button>
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