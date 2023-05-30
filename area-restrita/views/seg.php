            <div class="content-page">
                <div class="content">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/seguranca/ControllerUpdate.php';?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Segurança</h2>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="email" name="usuario" class="form-control" value="<?= $usuario?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-1 col-form-label">Senha</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="senha" class="form-control" value="<?= $senha?>">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group mb-0 justify-content-end row">
                                            <div class="col-sm-11">
                                                <button type="submit" name="atualizar" class="btn btn-success waves-effect waves-light">Salvar Alteração</button>
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