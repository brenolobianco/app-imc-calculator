<<<<<<< HEAD
           
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/estagio/ControllerInsert.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Nova Estágio</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre o Estágio</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="nome_est" class="form-control" placeholder="Nome do estágio" required>
                                            </div>
                                            <div class="col-sm-2">    
                                                <input type="text" placeholder="Início" class="form-control" name="data_inicio_est" data-toggle="input-mask" data-mask-format="00/00/0000" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2"> 
                                                <input type="text" placeholder="Término" class="form-control" name="data_termino_est" data-toggle="input-mask" data-mask-format="00/00/0000" />     
                                            </div>

                                            <div class="col-sm-2">
                                                <select name="ativo_est" class="form-control">
                                                    <option value="Ativado">Ativado</option>
                                                    <option value="Desativado">Desativado</option>
                                                </select>
                                            </div>    
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Hospital e Valores</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="hosp_id_est">
                                                    <?php
                                                        $select = "SELECT * from hospital";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_hosp;?>"><?= $mostra->nome_hosp;?></option>
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
                                            <div class="col-sm-2">
                                                <input type="text" name="vagas_est" class="form-control" placeholder="Vagas">
                                            </div> 

                                            <div class="col-sm-2">
                                                <input type="text" name="valor_est" class="form-control" data-toggle="input-mask" data-mask-format="#.##0,00" data-reverse="true" placeholder="Valor">
                                            </div> 
                                            <div class="col-sm-2">
                                                <input type="text" name="valor_desc_est" class="form-control" data-toggle="input-mask" data-mask-format="#.##0,00" data-reverse="true" placeholder="Valor com desconto">
                                            </div> 
                                              
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nota e Exceção</label>
                                           <div class="col-sm-2">
                                                <input type="text" name="nota_med_est" class="form-control" placeholder="Nota média">
                                            </div> 
                                            <div class="col-sm-8">
                                                <input type="text" name="exc_est" class="form-control" placeholder="Exceção">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Pix, valor e chave</label>
                                           <div class="col-sm-2">
                                                <input type="text" name="val_pix_est" class="form-control" placeholder="Valor em Pix">
                                            </div> 
                                            <div class="col-sm-8">
                                                <input type="text" name="chave_pix_est" class="form-control" placeholder="Chave Pix">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link Valor</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_valor_est" class="form-control" placeholder="Link para fazer o Estágio">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link Huber</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_huber_est" class="form-control" placeholder="Link para Huber">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link da Prova</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_prova_est" class="form-control" placeholder="Link da Prova">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição do estágio</label>
                                            <div class="col-sm-10">
                                                <textarea name="desc_est" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Edital do estágio</label>
                                            <div class="col-sm-10">
                                                <textarea name="edital_est" class="form-control"></textarea>
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
        <script src="assets/js/cep.js"></script> 
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/dropify/dropify.min.js"></script>
        <script src="assets/js/pages/form-fileupload.init.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
        <script src="assets/libs/moment/moment.js"></script>
        <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/js/pages/form-advanced.init.js"></script>   

    </body>
=======
<?php 
include('controllers/avaliacao/Fiscallize.php');
$classes = $fiscallize->classes();
?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/estagio/ControllerInsert.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Nova Estágio</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre o Estágio</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="nome_est" class="form-control" placeholder="Nome do estágio" required>
                                            </div>
                                            <div class="col-sm-2">    
                                                <input type="text" placeholder="Início" class="form-control" name="data_inicio_est" data-toggle="input-mask" data-mask-format="00/00/0000" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2"> 
                                                <input type="text" placeholder="Término" class="form-control" name="data_termino_est" data-toggle="input-mask" data-mask-format="00/00/0000" />     
                                            </div>

                                            <div class="col-sm-2">
                                                <select name="ativo_est" class="form-control">
                                                    <option value="Ativado">Ativado</option>
                                                    <option value="Desativado">Desativado</option>
                                                </select>
                                            </div>    
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Hospital e Valores</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="hosp_id_est">
                                                    <?php
                                                        $select = "SELECT * from hospital";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_hosp;?>"><?= $mostra->nome_hosp;?></option>
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
                                            <div class="col-sm-2">
                                                <input type="text" name="vagas_est" class="form-control" placeholder="Vagas">
                                            </div> 

                                            <div class="col-sm-2">
                                                <input type="text" name="valor_est" class="form-control" data-toggle="input-mask" data-mask-format="#.##0,00" data-reverse="true" placeholder="Valor">
                                            </div> 
                                            <div class="col-sm-2">
                                                <input type="text" name="valor_desc_est" class="form-control" data-toggle="input-mask" data-mask-format="#.##0,00" data-reverse="true" placeholder="Valor com desconto">
                                            </div> 
                                              
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Treinamento</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control" name="treinamento" id="">
                                                        <option value="sim">Sim</option>
                                                        <option value="nao">Não</option>
                                                    </select>
                                            </div>

                                            

                                            <div class="col-sm-3">
                                                <select class="form-control" name="id_turma_fiscallize" id="id_turma_fiscallize">
                                                    <option class="form-control" value="" selected>
                                                        Selecione a turma Fiscallize
                                                    </option>
                                                    <?php 
                                                    foreach($classes as $classe):
                                                    ?>
                                                        <option class="form-control" value="<?= $classe->id; ?>"><?= $classe->name; ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nota e Exceção</label>
                                           <div class="col-sm-2">
                                                <input type="text" name="nota_med_est" class="form-control" placeholder="Nota média">
                                            </div> 
                                            <div class="col-sm-8">
                                                <input type="text" name="exc_est" class="form-control" placeholder="Exceção">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Pix, valor e chave</label>
                                           <div class="col-sm-2">
                                                <input type="text" name="val_pix_est" class="form-control" placeholder="Valor em Pix">
                                            </div> 
                                            <div class="col-sm-8">
                                                <input type="text" name="chave_pix_est" class="form-control" placeholder="Chave Pix">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link Valor</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_valor_est" class="form-control" placeholder="Link para fazer o Estágio">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link Huber</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_huber_est" class="form-control" placeholder="Link para Huber">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Link da Prova</label>
                                            <div class="col-sm-10">
                                                <textarea name="link_prova_est" class="form-control" placeholder="Link da Prova">
                                                    
                                                </textarea>
                                            </div>      
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição do estágio</label>
                                            <div class="col-sm-10">
                                                <textarea name="desc_est" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Edital do estágio</label>
                                            <div class="col-sm-10">
                                                <textarea name="edital_est" class="form-control"></textarea>
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
        <script src="assets/js/cep.js"></script> 
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/dropify/dropify.min.js"></script>
        <script src="assets/js/pages/form-fileupload.init.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
        <script src="assets/libs/moment/moment.js"></script>
        <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/js/pages/form-advanced.init.js"></script>   

    </body>
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>