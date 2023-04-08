
            <div class="content-page">
                <div class="content">
                    <?php include_once 'controllers/professor/ControllerSelect.php';?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Professor <?= $nome_prof;?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title"><?= $nome_prof;?></h4>
                                        <p class="card-text">
                                            <strong>Descrição</strong><br />
                                            <?= $desc_prof;?>
                                        </p>
                                        <p class="card-text">
                                            Telefone: <?= $email_prof;?><br />
                                            Whats: <?= $whats_prof;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">Curriculo Lates</h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                                <div class="user-desc">
                                                    <center>
                                                        <a href="<?= $link_cv_lates_prof;?>" target="_blank" class="btn btn-primary">Vizualizar Curriculo Lates</a>
                                                    </center>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
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