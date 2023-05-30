
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include_once 'controllers/academico/ControllerUpdate.php'; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h2 class="mt-0 mb-3 header-title">Indicação</h2>
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Nome</label>
                                                <input type="text" class="form-control" name="nome_acad" value="<?= $nome_acad?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email</label>
                                                <input type="email" class="form-control" name="email_acad" value="<?= $email_acad?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Senha</label>
                                                <input type="text" class="form-control" name="senha_acad" value="<?= $senha_acad?>">   
                                            </div>  
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button name="atualizar" type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
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