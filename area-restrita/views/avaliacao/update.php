<?php 
include_once('controllers/avaliacao/Fiscallize.php'); 


if(!isset($_GET['id'])){
    header("Location: index.php?acao=avaliacoes");
}
$id = $_GET['id'];


function programaEstagio($conexao) {
    $sql = "SELECT * FROM estagio";
    $result = $conexao->prepare($sql);
    $result->execute();

    return $result;
}

$estagios = programaEstagio($conexao);





?>

<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <?php include_once 'controllers/avaliacao/ControllerUpdate.php';?>
                </div>
                <div class="col-md-12">
                    <div class="card-box">
                        <h2 class="mt-0 mb-3 header-title">Nova avaliação</h2>

                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Selecione a avaliacao: </label>
                                <div class="col-sm-5">
                                    <select name="avaliacao_id_fiscallize" class="form-control">
                                        <?php  foreach($fiscallize->provas() as $prova ): ?>
                                            <?php if($prova->id == $mostra['avaliacao_id_fiscallize']): ?>
                                                <option value="<?php echo $prova->id ?>" selected>
                                                    <?php echo $prova->name ?>
                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo $prova->id ?>">
                                                    <?php echo $prova->name ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    

                                    <div class="add">
                                        <a href="https://remote.fiscallize.com.br" target="_blank" class="waves-effect waves-light float-right">Adicionar</a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Programa de estágio: </label>
                                <div class="col-sm-5">
                                    <select name="id_est" class="form-control" required>
                                        <?php 
                                            while($estagio = $estagios->fetch(PDO::FETCH_ASSOC)):
                                        ?>
                                            
                                            <?php if($estagio['id_est'] == $mostra['id_est']): ?>
                                                <option value="<?php echo $estagio['id_est'] ?>" selected>
                                                    <?php echo $estagio['nome_est'] ?>
                                                </option>
                                            <?php endif; ?>

                                            <?php if($estagio['id_est'] != $mostra['id_est']): ?>
                                                <option value="<?php echo $estagio['id_est'] ?>">
                                                    <?php echo $estagio['nome_est'] ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nome avaliacao</label>
                                <div class="col-sm-5">
                                    <input type="text" name="nome_avaliacao" value="<?php echo $mostra['nome_avaliacao']; ?>" id="nome_avaliacao" placeholder="Nome da avaliacao" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Data avaliacao</label>
                                
                                    <div class="col-sm-3">
                                        <input type="datetime-local" name="data_avaliacao" id="data_avaliacao" value="<?php echo $atual; ?>" placeholder="Data da avaliacao" class="form-control">
                                    </d1iv>

                                </div>

                                <label for="inputPassword3" class="col-sm-2 col-form-label">Liberado</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="liberado" id="">
                                        <?php if($mostra['liberado'] == 'liberado'): ?>
                                            <option value="liberado" selected>Liberado</option>
                                            <option value="bloqueado">Bloqueado</option>

                                        <?php else: ?>
                                            <option value="liberado">Liberado</option>
                                            <option value="bloqueado" selected>Bloqueado</option>

                                        <?php endif; ?>


                                    </select>

                                </div>
                            </div>



                            <!-- Accordion Using List Group -->
                            <div class="form-group mb-0  mt-5 justify-content-end row">
                                <div class="col-sm-10">
                                    <button type="submit" name="atualizar"
                                        class="btn btn-success waves-effect waves-light">Salvar</button>
                                </div>
                            </div>

                        </form>


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