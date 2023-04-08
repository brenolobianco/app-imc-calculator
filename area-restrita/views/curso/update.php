<<<<<<< HEAD

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/curso/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Curso</h2>
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            
                                            <div class="form-row">    
                                                <div class="form-group col-md-9">
                                                    <label for="inputEmail4">Nome do curso</label>
                                                    <input type="text" class="form-control" name="nome_curso" value="<?= $nome_curso;?>">
                                                    <div style="width: 100%; height: 16px;"></div>
                                                        <select class="form-control" name="est_id_curso">
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
                                                    <div style="width: 100%; height: 16px;"></div>
                                                    <textarea class="form-control" name="desc_curso" cols="30" rows="6"><?= $desc_curso;?></textarea>
                                                </div>
                                               
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">Imagem do Curso</label>
                                                    <img src="../upload/<?= $img_curso;?>" width="100%"><br /> 
                                                    <input type="file" class="form-control" name="img[]">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <button id="submit" name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
=======

            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/curso/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Curso</h2>
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            
                                            <div class="form-row">    
                                                <div class="form-group col-md-9">
                                                    <label for="inputEmail4">Nome do curso</label>
                                                    <input type="text" class="form-control" name="nome_curso" value="<?= $nome_curso;?>">
                                                    <div style="width: 100%; height: 16px;"></div>
                                                        <select class="form-control" name="est_id_curso">
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
                                                    <div style="width: 100%; height: 16px;"></div>
                                                    <textarea class="form-control" name="desc_curso" cols="30" rows="6"><?= $desc_curso;?></textarea>
                                                </div>
                                               
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">Imagem do Curso</label>
                                                    <img src="../upload/<?= $img_curso;?>" width="100%"><br /> 
                                                    <input type="file" class="form-control" name="img[]">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <button id="submit" name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>