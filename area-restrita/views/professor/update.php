
            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                               <?php include_once 'controllers/professor/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Editar Professor</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Professor</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nome_prof" class="form-control" value="<?= $nome_prof;?>">
                                            </div>  
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Contato do Professor</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="whats_prof" class="form-control" value="<?= $whats_prof;?>">
                                            </div> 
                                            <div class="col-sm-6">
                                                <input type="email" name="email_prof" class="form-control" value="<?= $email_prof;?>">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">CV Lates Professor</label> 
                                            <div class="col-sm-10">
                                                <input type="text" name="link_cv_lates_prof" class="form-control" value="<?= $link_cv_lates_prof;?>">
                                            </div>    
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Descrição do Professor</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="desc_prof" class="form-control"> <?= $desc_prof;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-10">
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