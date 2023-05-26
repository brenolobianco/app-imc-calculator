
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Vídeo da Aula </h3>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                             <?php include_once 'controllers/aulaVideo/ControllerSelect.php'; ?> 
    
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-3"><?= $nome_vid;?></h4>
                                    <ul class="list-group mb-0 user-list">

                                        <li class="list-group-item">
                                            <a href="#" class="user-list-item">
                                                    <div class="user-desc">
                                                    <center>
                                                    <video style="width: 70%; height: 50%;" controls>
                                                    <source src="../videos/<?= $id_vid;?>/<?= $arq_vid;?>" type="video/mp4">
                                                    <source src="../videos/<?= $id_vid;?>/<?= $arq_vid;?>" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                    </video>
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