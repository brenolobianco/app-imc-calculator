<<<<<<< HEAD
           
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/estagio/ControllerUpdate.php';?> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Estágio</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Nome do estágio</label>
                                                <input type="text" name="nome_est" class="form-control" value="<?= $nome_est;?>">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Data de início</label>
                                                <input type="text" name="data_inicio_est" class="form-control" value="<?= $data_inicio_est;?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Data de término</label>
                                                <input type="text" name="data_termino_est" class="form-control" value="<?= $data_termino_est;?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Estado do estágio</label>
                                                <select name="ativo_est" class="form-control">
                                                    <option value="<?= $ativo_est;?>"><?= $ativo_est;?></option>
                                                    <?php if($ativo_est !='Ativado'){
                                                        $ativo ='Ativado';
                                                    }else{
                                                        $ativo ='Desativado';
                                                    }?>
                                                    <option value="<?= $ativo;?>"><?= $ativo;?></option>
                                                </select>
                                            </div>
                                              
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Hospital do estágio</label>
                                                <select class="form-control" name="hosp_id_est" id="">
                                                    <option value="<?= $hosp_id_est;?>">Atual é <?= $nome_hosp;?></option>
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

                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Treinamento</label>
                                                <select type="text" class="place_form form-control" name="treinamento">
                                                    <option value="nao" class="nao" <?php if($treinamento != "sim") {echo 'selected';} ?>><b style="color: #fff;">nao</b></option>
                                                    <option value="sim" class="sim"  <?php if($treinamento == "sim") {echo 'selected';} ?>>sim</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Vagas Disponíveis</label>
                                                <input type="text" name="vagas_est" class="form-control" value="<?= $vagas_est;?>">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Valor</label>
                                                <input type="text" name="valor_est" class="form-control" value="<?= $valor_est;?>">
                                            </div>  
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Valor com Desconto</label>
                                                <input type="text" name="valor_desc_est" class="form-control" value="<?= $valor_desc_est;?>">
                                            </div> 
                                        </div>
                                        <div class="form-row">
                                            
                                            <div class="form-group col-sm-2">
                                                <label for="inputEmail4">Nota </label>
                                                <input type="text" name="nota_med_est" class="form-control" value="<?= $nota_med_est;?>">
                                            </div> 
                                            <div class="form-group col-sm-10">
                                                <label for="inputEmail4">Exceção</label>
                                                <input type="text" name="exc_est" class="form-control" value="<?= $exc_est;?>">
                                            </div> 
                                        </div>
                                        <div class="form-row">
                                            
                                            <div class="form-group col-sm-2">
                                                <label for="inputEmail4">Valor Pix ( Desconto ) </label>
                                                <input type="text" name="val_pix_est" class="form-control" value="<?= $val_pix_est;?>">
                                            </div> 
                                            <div class="form-group col-sm-10">
                                                <label for="inputEmail4">Chave Pix</label>
                                                <input type="text" name="chave_pix_est" class="form-control" value="<?= $chave_pix_est;?>">
                                            </div> 
                                        </div>
                                     
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link de pagamento - mercadoPago</label>
                                                <textarea name="link_valor_est" class="form-control"><?= $link_valor_est;?></textarea>
                                            </div>      
                                        </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link Huber</label>
                                                <textarea name="link_huber_est" class="form-control"><?= $link_huber_est;?></textarea>
                                            </div>      
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link da prova - google form´s</label>
                                                <textarea name="link_prova_est" class="form-control"><?= $link_prova_est;?></textarea>
                                            </div>      
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Descrição do estágio</label>
                                                <textarea name="desc_est" class="form-control"><?= $desc_est;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Edital do estágio</label>
                                                <textarea type="text" name="edital_est" class="form-control"><?= $edital_est;?></textarea>
                                            </div>
                                        </div>
                                      
                                        <div class="form-row">
                                            <div class="col-md-12">
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
                                <?php include_once 'controllers/estagio/ControllerUpdate.php';?> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Estágio</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Nome do estágio</label>
                                                <input type="text" name="nome_est" class="form-control" value="<?= $nome_est;?>">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Data de início</label>
                                                <input type="text" name="data_inicio_est" class="form-control" value="<?= $data_inicio_est;?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Data de término</label>
                                                <input type="text" name="data_termino_est" class="form-control" value="<?= $data_termino_est;?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Estado do estágio</label>
                                                <select name="ativo_est" class="form-control">
                                                    <option value="<?= $ativo_est;?>"><?= $ativo_est;?></option>
                                                    <?php if($ativo_est !='Ativado'){
                                                        $ativo ='Ativado';
                                                    }else{
                                                        $ativo ='Desativado';
                                                    }?>
                                                    <option value="<?= $ativo;?>"><?= $ativo;?></option>
                                                </select>
                                            </div>
                                              
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Hospital do estágio</label>
                                                <select class="form-control" name="hosp_id_est" id="">
                                                    <option value="<?= $hosp_id_est;?>">Atual é <?= $nome_hosp;?></option>
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

                                            <div class="form-group col-md-5">
                                                <label for="inputEmail4">Treinamento</label>
                                                <select type="text" class="place_form form-control" name="treinamento">
                                                    
                                                    <option value="nao" class="nao" <?php if($treinamento != "sim") {echo 'selected';} ?>><b style="color: #fff;">Não</b></option>
                                                    <option value="sim" class="sim"  <?php if($treinamento == "sim") {echo 'selected';} ?>>Sim</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                            <label for="inputEmail4">Selecione a turma Fiscallize</label>
                                            <select class="form-control" name="id_turma_fiscallize" id="id_turma_fiscallize">
                                                <?php 
                                                    $html = '';

                                                    for($i = 0; $i < count($classes); $i++) {
                                                        $classe = $classes[$i]; 
                                                           
                                                        if($id_turma_fiscallize == $classe->id) {
                                                            $html .= '<option class="form-control" value="'.$classe->id.'" selected>'.$classe->name.'</option>';
                                                        } else {
                                                            $html .= '<option class="form-control" value="'.$classe->id.'">'.$classe->name.'</option>';
                                                        }

                                                    }

                                                ?>
                                                    <?= $html; ?>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Vagas Disponíveis</label>
                                                <input type="text" name="vagas_est" class="form-control" value="<?= $vagas_est;?>">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Valor</label>
                                                <input type="text" name="valor_est" class="form-control" value="<?= $valor_est;?>">
                                            </div>  
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Valor com Desconto</label>
                                                <input type="text" name="valor_desc_est" class="form-control" value="<?= $valor_desc_est;?>">
                                            </div> 
                                        </div>
                                        <div class="form-row">
                                            
                                            <div class="form-group col-sm-2">
                                                <label for="inputEmail4">Nota </label>
                                                <input type="text" name="nota_med_est" class="form-control" value="<?= $nota_med_est;?>">
                                            </div> 
                                            <div class="form-group col-sm-10">
                                                <label for="inputEmail4">Exceção</label>
                                                <input type="text" name="exc_est" class="form-control" value="<?= $exc_est;?>">
                                            </div> 
                                        </div>
                                        <div class="form-row">
                                            
                                            <div class="form-group col-sm-2">
                                                <label for="inputEmail4">Valor Pix ( Desconto ) </label>
                                                <input type="text" name="val_pix_est" class="form-control" value="<?= $val_pix_est;?>">
                                            </div> 
                                            <div class="form-group col-sm-10">
                                                <label for="inputEmail4">Chave Pix</label>
                                                <input type="text" name="chave_pix_est" class="form-control" value="<?= $chave_pix_est;?>">
                                            </div> 
                                        </div>
                                     
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link de pagamento - mercadoPago</label>
                                                <textarea name="link_valor_est" class="form-control"><?= $link_valor_est;?></textarea>
                                            </div>      
                                        </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link Huber</label>
                                                <textarea name="link_huber_est" class="form-control"><?= $link_huber_est;?></textarea>
                                            </div>      
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Link da prova - google form´s</label>
                                                <textarea name="link_prova_est" class="form-control"><?= $link_prova_est;?></textarea>
                                            </div>      
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Descrição do estágio</label>
                                                <textarea name="desc_est" class="form-control"><?= $desc_est;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Edital do estágio</label>
                                                <textarea type="text" name="edital_est" class="form-control"><?= $edital_est;?></textarea>
                                            </div>
                                        </div>
                                      
                                        <div class="form-row">
                                            <div class="col-md-12">
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
</html>