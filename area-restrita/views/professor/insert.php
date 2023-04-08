
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                              <?php include_once 'controllers/professor/ControllerInsert.php';?> 
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Novo Professor</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                           
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sobre o Professor</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nome_prof" class="form-control" placeholder="Nome do Professor" required>
                                            </div>  
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Contato do Professor</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="whats_prof" class="form-control" data-toggle="input-mask" data-mask-format="(00) 00000-0000" placeholder="WhatsApp">
                                            </div> 
                                            <div class="col-sm-6">
                                                <input type="text" name="email_prof" class="form-control" placeholder="Email">
                                            </div> 
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">CV Lates Professor</label> 
                                            <div class="col-sm-10">
                                                <input type="text" name="link_cv_lates_prof" class="form-control" placeholder="Link CV Lates do Professor">
                                            </div>    
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição do Professor</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="desc_prof" class="form-control"></textarea>
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