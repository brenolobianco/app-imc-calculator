
            <div class="content-page">
                <div class="content">
                    <?php include_once 'controllers/horarios/ControllerSelect.php';?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Estágio </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Dia: <?= $dia_hora;?></h4>
                                        <h5>Início: <?= $in_hora;?></h5>
                                        <h5>Término: <?= $out_hora;?></h5>
                              
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