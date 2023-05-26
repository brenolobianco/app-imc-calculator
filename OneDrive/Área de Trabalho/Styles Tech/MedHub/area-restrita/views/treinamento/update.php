
<div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/treinamento/AulaControllerUpdate.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="mt-0 mb-3 header-title">Editar Aula - Treinamento</h1>

                                    <form id="formValidation" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nome da aula</label>
                                                <input type="text" name="nome_aula" class="form-control" value="<?= $nome_aula?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nome do professor</label>
                                                <select class="form-control" name="prof_id_aula">
                                                    <option value="<?= $prof_id_aula;?>"><?= $nome_prof;?></option>
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

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Descrição da aula</label>
                                                <textarea type="text" name="desc_aula" class="form-control"><?= $desc_aula;?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder="Video da aula" data-toggle="tooltip" title="video da aula">Video da Aula</label>
                                            <div class="col-sm-12">
                                              <?php 

                                              if($dropfy_thumb) {?>
                                                    <input type="file" name="arq_vid" id="arq_vid"  class="dropify" data-default-file="<?= $dropfy_thumb;?>" />
                                              <?php } else{?>
                                                    <input type="file" name="arq_vid" id="arq_vid"  class="dropify"/>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- VIDEO UPLOAD -->
                                        <label for="inputEmail3" class="col-sm-2 col-form-label" placeholder=""></label>
                                        <div class="col-sm-10">
                                            <div class="progress-bar color-success progress-bar-animated d-none progress-bar-video" role="progressbar" style="background-color: #88E450; height: 20px; width: 2%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <span class="font-weight-bold percent-video" style="color: black;">
                                                0% Completado...
                                                </span>
                                            </div>
                                        </div>
                                        <!-- VIDEO UPLOAD -->
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Estágio</label>
                                                <select class="form-control" name="est_id_aula">
                                                <option value="<?= $est_id_aula;?>"><?= $nome_est;?></option>
                                                    <?php
                                                        $select = "SELECT * from estagio e LEFT JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                                                    ?>
                                                    <option value="<?= $mostra->id_est;?>">Estágio <?= $mostra->nome_est;?> Hospital <?= $mostra->nome_hosp;?></option>
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
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Taxa de acerto quiz</label>
                                                <input type="text" name="taxa_acerto_quiz" class="form-control" value="<?= $taxa_acerto_quiz;?>">
                                            </div>
                                            
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Módulo</label>
                                                <select class="form-control" name="mod_id_aula">
                                                    <option value="1">Selecionar o módulo</option>
                                                    <?php
                                                        $select = "SELECT * FROM modulo WHERE treinamento = 'sim'";  
                                                        try{
                                                        $result = $conexao->prepare($select);
                                                        $result ->execute();
                                                        $contar = $result->rowCount();

                                                        if($contar>0){
                                                        while($aula = $result->FETCH(PDO::FETCH_OBJ)){
                                                        
                                                        if($mod_id_aula == $aula->id_mod){
                                                    ?>
                                                        <option value="<?= $aula->id_mod;?>" selected><?= $aula->nome_mod;?></option>
                                                    <?php } else {?>
                                                        <option value="<?= $aula->id_mod;?>"><?= $aula->nome_mod;?></option>
                                                    <?php } ?>
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
                                        
                                        <div class="form-group form-row">
                                        <label for=""></label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="cronograma_semanas">
                                                <option value="1">1 Semana</option>
                                                <option value="2">2 Semana</option>
                                                <option value="3">3 Semana</option>
                                                <option value="4">4 Semana</option>
                                                <option value="5">5 Semana</option>
                                                <option value="6">6 Semana</option>
                                                <option value="7">7 Semana</option>
                                                <option value="8">8 Semana</option>
                                                <option value="9">9 Semana</option>
                                                <option value="10">10 Semana</option>
                                                <option value="11">11 Semana</option>
                                                <option value="12">12 Semana</option>
                                                <option value="13">13 Semana</option>
                                                <option value="14">14 Semana</option>
                                                <option value="15">15 Semana</option>
                                                <option value="16">16 Semana</option>
                                                <option value="17">17 Semana</option>
                                                <option value="18">18 Semana</option>
                                                <option value="19">19 Semana</option>
                                                <option value="20">20 Semana</option>
                                                <option value="21">21 Semana</option>
                                                <option value="22">22 Semana</option>
                                                <option value="23">23 Semana</option>
                                                <option value="24">24 Semana</option>
                                                <option value="25">25 Semana</option>
                                                <option value="26">26 Semana</option>
                                                <option value="27">27 Semana</option>
                                                <option value="28">28 Semana</option>
                                                <option value="29">29 Semana</option>
                                                <option value="30">30 Semana</option>
                                                <option value="31">31 Semana</option>
                                                <option value="32">32 Semana</option>
                                                <option value="33">33 Semana</option>
                                                <option value="34">34 Semana</option>
                                                <option value="35">35 Semana</option>
                                                <option value="36">36 Semana</option>
                                                <option value="37">37 Semana</option>
                                                <option value="38">38 Semana</option>
                                                <option value="39">39 Semana</option>
                                                <option value="40">40 Semana</option>
                                            </select>
                                        </div>
                                    </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <button type="submit" name="atualizar" class="btn btn-success waves-effect waves-light">Atualizar</button>
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

        <script>
            var drEvent = $('.dropify').dropify();

            drEvent.on('dropify.afterClear', function(event, element){
                let xml = new XMLHttpRequest();
                xml.open("POST", "", true);
                xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xml.send("remove_video=true");
            });

            var cronogramaSemanas = document.querySelector('select[name=cronograma_semanas]');
            let valor = <?= $cronograma_semanas;?>;
            var cronogramaOption = document.querySelectorAll('select[name=cronograma_semanas] option');
            for(var i = 0; i < cronogramaOption.length; i++){
                if(cronogramaOption[i].value == valor){
                    cronogramaOption[i].selected = true;
                }
            }
        </script>

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