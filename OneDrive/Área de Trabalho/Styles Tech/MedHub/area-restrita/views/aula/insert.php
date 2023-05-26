<div class="content-page">
                <div class="content">

                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/aula/ControllerInsert.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Nova Aula</h2>

                                    <form class="form-horizontal" id="formValidation" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre a Aula</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="nome_aula" class="form-control" placeholder="Nome da Aula" required>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="prof_id_aula" required>
                                                    <option value="">Selecionar o Professor</option>
                                                    <?php
                                                        $select = "SELECT * from professor";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_prof;?>"><?= $mostra->nome_prof;?></option>
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
                                            <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder="Nome da Aula">Descrição da Aula</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="desc_aula" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder="Nome da Aula">Video da Aula</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="arq_vid"  class="dropify"/>
                                            </div>
                                                
                                            <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder=""></label>
                                            <div class="col-sm-10">
                                                <div class="progress-bar color-success progress-bar-animated d-none progress-bar-video" role="progressbar" style="background-color: #88E450; height: 20px; width: 2%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="font-weight-bold percent-video" style="color: black;">
                                                    0% Completado...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Curso</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="est_id_aula">
                                                    <option value="">Selecionar o hospital e estágio</option>
                                                    <?php
                                                        $select = "SELECT * from estagio e JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>">Estágio <?= $mostra->nome_est;?>Hospital <?= $mostra->nome_hosp;?></option>
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
                                            <div class="col-sm-3">
                                                <select class="form-control" name="curso_id_aula">
                                                    <option value="">Selecionar o curso</option>
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
                                            <div class="col-sm-3">
                                                <select class="form-control" name="mod_id_aula">
                                                    <option value="1">Selecionar o módulo</option>
                                                    <?php
                                                        $select = "SELECT * from modulo WHERE treinamento != 'sim' OR treinamento IS NULL";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_mod;?>"><?= $mostra->nome_mod;?></option>
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
        
        
        <!--- VIDEO UPLOAD --->
        <script src="https://malsup.github.io/jquery.form.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $('.dropify').dropify({
                messages: {
                    'default': 'Solte um arquivo ou clique aqui',
                    'replace': 'Solte um arquivo ou clique aqui para substituir',
                    'remove':  'Remover',
                    'error':   'Ooops, ocorreu um erro!.'
                }

            });

            let bar = $('.progress-bar-video');
            let percent = $('span.percent-video');

            $(document).ready(function() {
                $('#formValidation').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal);
                    bar.removeClass('d-none');
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    console.log("porcentagem: " + percentComplete);

                    bar.width(percentVal);
                    percent.html(percentComplete + '%' + ' Completado...');
                },

                complete: function(xhr) {
                    setTimeout(function() {
                        new Swal({
                        title: "Sucesso!",
                        text: "Aula adicionada com sucesso!",
                        type: "success",
                        }).then(function() {
                            location.reload();
                        });
                    }, 1000);
                }
            });
            })

        </script>
        <!--- VIDEO UPLOAD --->

        

    </body>
</html>