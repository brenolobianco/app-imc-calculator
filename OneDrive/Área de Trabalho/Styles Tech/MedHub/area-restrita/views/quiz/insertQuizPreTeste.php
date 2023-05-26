<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <?php include_once 'controllers/quiz/ControllerInsertPreTeste.php';?>
                </div>
                <div class="col-md-12">
                    <div class="card-box">
                        <h2 class="mt-0 mb-3 header-title">Novo Quiz</h2>

                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Aula</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="id_vid_aula" required>
                                        <option value="">Selecionar aula</option>
                                        <?php
                                                    include_once 'models/conecta.php';

                                                    $select = "SELECT * from aula WHERE treinamento = 'sim'";  
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


                    </div>
                    <div>
                        <div>
                            <div class="d-flex content col-md-12" style="justify-content: space-between;">

                                <div class="ml-0">
                                    <div class="d-flex alinhar" style="text-align: center;">
                                        <h2 class="alinhar texto-mudulo-accordion">Perguntas</h2>
                                    </div>
                                </div>


                                <div class="btn btn-lighten-primary" href="#quiz" data-parent="#accordion"
                                    data-toggle="collapse">
                                    <div class="max mr-auto">
                                        <img src="https://fonts.gstatic.com/s/i/short-term/release/materialsymbolsoutlined/add/default/40px.svg"
                                            alt="" srcset=""
                                            class="animate__animated animate__delay-1s animate__fadeInUp">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="collapse mb-5" id="quiz">
                        <form class="form-horizontal" action="" method="post">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label class="col-sm-6 col-form-label" for="inlineFormInputGroup">Pergunta</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <input type="text" name="pergunta" class="form-control" id="inlineFormInputGroup"
                                                placeholder="PERGUNTA">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">A</div>
                                            <textarea type="text" name="alternativa_a" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">B</div>
                                            <textarea type="text" name="B" name="alternativa_b" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">C</div>
                                            <textarea type="text" name="alternativa_c" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">D</div>
                                            <textarea type="text" name="alternativa_d" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">E</div>
                                            <textarea type="text" name="alternativa_e" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resposta">Alternativa correta: </label>
                                    <select class="form-control" name="alternativa_correta" required>
                                        <option value="">SELECIONE: </option>
                                        <option value="A" <?php if($alternativa_correta == "A") { echo "selected"; } ?>>A</option>
                                        <option value="B" <?php if($alternativa_correta == "B") { echo "selected"; } ?> >B</option>
                                        <option value="C" <?php if($alternativa_correta == "C") { echo "selected"; } ?>>C</option>
                                        <option value="D" <?php if($alternativa_correta == "D") { echo "selected"; } ?>>D</option>
                                        <option value="E" <?php if($alternativa_correta == "E") { echo "selected"; } ?>>E</option>
                                    </select>
                                </div>

                                <div class="submit">
                                    <div class="col-sm-10">
                                        <button type="submit" name="cadastrar"
                                            class="btn btn-success waves-effect waves-light">Adicionar Quiz</button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    <!-- Accordion Using List Group -->
                    <div class="col-md-6 col-md-offset-3">
                        <div id="accordion">

                        </div>
                    </div>

                    <div class="form-group mb-0  mt-5 justify-content-end row">
                        <div class="col-sm-10">
                            <button type="submit" name="cadastrar"
                                class="btn btn-success waves-effect waves-light">Salvar</button>
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

<style>
    .list-group-item {
        padding: 5px 10px
    }
</style>
<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- Plugins Js -->
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

<!-- Init js-->
<script src="assets/js/pages/form-advanced.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
</body>

</html>