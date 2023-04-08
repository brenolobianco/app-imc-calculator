
<div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                            <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Vídeo da Aula</h2>
                                    
                                    <form method="post" action="controllers/aulaVideo/ControllerInsert.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre a Aula</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="nome_vid" class="form-control" placeholder="Titulo do Vídeo" required>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="aula_id_vid" required>
                                                    <option value="">Selecionar aula</option>
                                                <?php
                                                    include_once 'models/conecta.php';

                                                    $select = "SELECT * FROM aula WHERE treinamento = 'sim'";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_aula;?>"><?= $mostra->nome_aula;?></option>
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
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Subir Vídeo da Aula</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="arq_vid"  class="dropify" data-max-file-size="5000000M"/>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-10">
                                                <input name="SendCadImg" type="submit" value="Salvar" class="btn btn-success waves-effect waves-light" />
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