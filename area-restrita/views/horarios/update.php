           
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/horarios/ControllerUpdate.php';?> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Horário</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Dia</label>
                                                <input type="text" name="dia_hora" class="form-control" value="<?= $dia_hora;?>">
                                            </div> 
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Acadêmico</label>
                                                <select name="acad_id_hora" class="form-control">
                                                    <?php if($nome_acad == null){
                                                        $r = 'Livre';
                                                    }else{
                                                        $r = $nome_acad;
                                                    }?>
                                                    <option value="<?= $acad_id_hora;?>">Atual: <?=$r;?></option>
                                                    <?php
                                                        $select = "SELECT * from matricula m 
                                                        LEFT JOIN academico a ON acad_id_mat = a.id_acad";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();
                                                    
                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_acad;?>"><?=$mostra->nome_acad;?></option>
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
                                                </select>
                                            </div> 
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Início</label>
                                                <input type="text" name="in_hora" class="form-control" value="<?= $in_hora;?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Término</label>
                                                <input type="text" name="out_hora" class="form-control" value="<?= $out_hora;?>">
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
</html>