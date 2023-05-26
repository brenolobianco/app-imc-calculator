
            <div class="content-page">
                <div class="content">
                    <?php include_once 'controllers/curso/ControllerSelect.php';?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Curso <?= $nome_curso;?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <img src="../upload/<?= $img_curso;?>" width="100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <h4 class="card-title"><?= $nome_curso;?></h4>
                                        <p class="card-text">
                                            <?= $desc_curso;?>
                                        </p>
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
        
    </body>
</html>