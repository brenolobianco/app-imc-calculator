
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/academico/ControllerInsert.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Indicação</h2>

                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                        <input type="hidden"
                                        class="form-control" name="usuario_id" id="" aria-describedby="helpId" placeholder="" 
                                        value="<?php echo $idLogado; ?>">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Informações da indição</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="nome_acad" placeholder="Nome Completo" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="email" class="form-control" name="email_acad" placeholder="Email" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="senha_acad" placeholder="Senha" required>   
                                                </div>  
                                            </div>
                                            <div class="form-group mb-0 justify-content-end row">
                                                <div class="col-sm-10">
                                                    <button name="cadastrar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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