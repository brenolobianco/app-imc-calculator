
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>PDF Edital </h3>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <?php include_once 'controllers/editalPdf/ControllerSelect.php'; ?> 
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3">PDF do Edital <?= $nome_edital;?></h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                                <iframe src="../editais/<?= $id_edital;?>/<?= $arq_edital;?>" width="100%" height="600" style="border: none;"></iframe>
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