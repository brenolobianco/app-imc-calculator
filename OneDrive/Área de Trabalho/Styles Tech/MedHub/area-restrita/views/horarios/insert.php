        <?php include_once 'controllers/estagio/ControllerSelect.php'; ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include_once 'controllers/horarios/ControllerInsert.php'; ?>
                        </div>
                        <div class="col-md-12">
                            <div class="card-box">
                                <h2 class="mt-0 mb-3 header-title">Novo Horário <?= $id_est; ?></h2>

                                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" name="usuario_id" id="" aria-describedby="helpId" placeholder="" value="<?php echo $idLogado; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre o Horário</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="dia_hora" class="form-control" placeholder="Dia da semana" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" name="est_id_hora" value="<?= $id_est; ?>" />
                                            <input type="text" name="in_hora" class="form-control" placeholder="Início" />
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="out_hora" class="form-control" placeholder="Término" />
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

            <?php include 'footer.php'; ?>

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

        </html>