
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <?php include_once 'controllers/hospital/ControllerInsert.php';?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Novo Hospital</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data"> 
                                    <div class="mb-3">
                                    
                                      <input type="hidden"
                                        class="form-control" name="usuario_id" id="" aria-describedby="helpId" placeholder="" 
                                        value="<?php echo $idLogado; ?>">
                                    </div>
                                    


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="nome_hosp" placeholder="Nome do Hospital" required>
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="fone_hosp" data-toggle="input-mask" data-mask-format="(00) 00000-0000" placeholder="Telefone">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="cep_hosp" name="cep_hosp" type="text" id="cep_hosp" 
               onblur="pesquisacep(this.value);" data-toggle="input-mask" data-mask-format="00000-000" placeholder="Cep">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="bairro_hosp" id="bairro_hosp" placeholder="Bairro">
                                                <div style="width: 100%; height: 16px;"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="resp_hosp" placeholder="Responsável">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="senha_hosp" placeholder="Senha Acesso">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="uf_hosp" id="uf_hosp" placeholder="UF">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="num_hosp" placeholder="Número">
                                                <div style="width: 100%; height: 16px;"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="email" class="form-control" name="email_hosp" placeholder="Email">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="whats_hosp" placeholder="Login acesso">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="cidade_hosp" id="cidade_hosp" placeholder="Cidade">
                                                <div style="width: 100%; height: 16px;"></div>
                                                <input type="text" class="form-control" name="rua_hosp" id="rua_hosp" placeholder="Rua">
                                                <div style="width: 100%; height: 16px;"></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="file" name="img_hosp[]" class="dropify" data-max-file-size="100M" />
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-12">
                                                <button id="submit" name="cadastrar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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
</html>