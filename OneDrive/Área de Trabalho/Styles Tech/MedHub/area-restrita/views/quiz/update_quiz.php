<?php 


if(isset($_POST['atualizar'])){
    $id_vid_aula   = trim(strip_tags($_POST["id_vid_aula"])); 
    $pergunta  = $_POST["pergunta"];
    $alternativa_a  = $_POST["alternativa_a"];
    $alternativa_b  = (isset($_POST["alternativa_b"])) ?  $_POST["alternativa_b"]: null;
    $alternativa_c  = (isset($_POST["alternativa_c"])) ?  $_POST["alternativa_c"]: null;
    $alternativa_d  = (isset($_POST["alternativa_d"])) ?  $_POST["alternativa_d"]: null;
    $alternativa_e  = (isset($_POST["alternativa_e"])) ?  $_POST["alternativa_e"]: null;
    $correta  = $_POST["alternativa_correta"];          

    $update = "UPDATE quiz_treinamento SET pergunta = :pergunta, alternativa_a = :alternativa_a, alternativa_b = :alternativa_b, alternativa_c = :alternativa_c, alternativa_d = :alternativa_d, alternativa_e = :alternativa_e, alternativa_correta = :alternativa_correta WHERE id_quiz = :id_quiz";
    try{
        $result = $conexao->prepare($update);
        $result ->bindParam(':id_quiz', $id_vid_aula, PDO::PARAM_INT);
        $result ->bindParam(':pergunta', $pergunta, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_a',$alternativa_a, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_b',$alternativa_b, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_c',$alternativa_c, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_d',$alternativa_d, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_e',$alternativa_e, PDO::PARAM_STR);
        $result ->bindParam(':alternativa_correta',$correta, PDO::PARAM_STR);
        $result ->execute();
        $contar = $result->rowCount();
        if($contar>0){
            header("Refresh: 0");
            echo '
            <div class="alert alert-success" role="alert">
            <strong>Atualizado com sucesso!</strong>
            </div>';
        
        }else{
            echo '<div class="alert alert-danger" role="alert">
            <strong>Erro ao atualizar!</strong>
            </div>';
        }
    
    }catch(PDOException $e){
        echo $e;
    }
}

$atualizar = 0;
if(isset($_GET['edit'])){
    $edit = $_GET['edit'];


    $select = "SELECT * FROM quiz_treinamento WHERE id_quiz = :id_quiz";
    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_quiz', $edit, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        $atualizar = $contar;
        if($contar>0){
            while($exibir = $result->fetch(PDO::FETCH_ASSOC)){
                $pergunta = $exibir['pergunta'];
                $alternativa_a = $exibir['alternativa_a'];
                $alternativa_b = $exibir['alternativa_b'];
                $alternativa_c = $exibir['alternativa_c'];
                $alternativa_d = $exibir['alternativa_d'];
                $alternativa_e = $exibir['alternativa_e'];
                $alternativa_correta = $exibir['alternativa_correta'];
            }
        }else{
            echo '<div class="alert alert-danger" role="alert">
            <strong>Erro ao atualizar!</strong>
            </div>';
        }
    } catch(PDOException $e){
        echo $e;
    }
}




?>

<div class="content-page">
    <div class="content">
        <?php 
        if($atualizar>0){
            echo '
            <div class="alert alert-success" role="alert">
            <strong>Atualizado com sucesso!</strong>
            </div>';
        }
        
        ?>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                </div>
                <div class="col-md-12">
                    <div class="card-box">
                        <h2 class="mt-0 mb-3 header-title">Editar Quiz</h2>

                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                            <div class="form-row">

                            <div class="form-group col-md-12">
                                    <label class="col-sm-6 col-form-label" for="inlineFormInputGroup">Pergunta</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <input type="text" name="pergunta" value="<?= $pergunta ?>" class="form-control" id="inlineFormInputGroup"
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
                                            <textarea type="text" value="<?= $alternativa_a ?>" name="alternativa_a" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa" required><?= $alternativa_a ?></textarea>
                                                <input type="hidden" value="<?= $edit ?>" name="id_vid_aula">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">B</div>
                                            <textarea type="text" value="<?= $alternativa_b ?>" name="alternativa_b" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"><?= $alternativa_b ?></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">C</div>
                                            <textarea type="text" value="<?= $alternativa_c ?>" name="alternativa_c" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"><?= $alternativa_c ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">D</div>
                                            <textarea type="text" value="<?= $alternativa_d ?>" name="alternativa_d" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"><?= $alternativa_d ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-2 col-form-label"
                                        for="inlineFormInputGroup">ALTERNATIVA</label>
                                    <div class="col-auto">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">E</div>
                                            <textarea type="text" value="<?= $alternativa_e ?>" name="alternativa_e" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Alternativa"><?= $alternativa_e ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="resposta">Alternativa correta: </label>
                                    <select class="form-control" name="alternativa_correta" required>

                                        <option value="">SELECIONE: </option>
                                        <option value="A" <?php if($alternativa_correta == "A") { echo "selected"; } ?> >A</option>
                                        <option value="B" <?php if($alternativa_correta == "B") { echo "selected"; } ?>>B</option>
                                        <option value="C" <?php if($alternativa_correta == "C") { echo "selected"; } ?>>C</option>
                                        <option value="D" <?php if($alternativa_correta == "D") { echo "selected"; } ?>>D</option>
                                        <option value="E" <?php if($alternativa_correta == "E") { echo "selected"; } ?>>E</option>
                                    </select>
                                </div>

                                <div class="submit">
                                    <div class="col-sm-10">
                                        <button type="submit" name="atualizar"
                                            class="btn btn-success waves-effect waves-light">Atualizar</button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    
                        </form>
                    </div>

                    <!-- Accordion Using List Group -->
                    <div class="col-md-6 col-md-offset-3">
                        <div id="accordion">
                            <div class="panel list-group">
                                <!-- panel class must be in -->




            
                            </div>


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