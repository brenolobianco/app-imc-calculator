
            <div class="content-page">
                <div class="content">
                    <?php include_once 'controllers/estagio/ControllerSelect.php';?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Estágio </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Estágio: <?= $nome_est;?></h4>
                                        <h5>Hospital: <?= $nome_hosp;?></h5>
                                        <h5>Valor: <?= $valor_est;?></h5>
                                        <h5>Valor com desconto: <?= $valor_desc_est;?></h5>
                                        <h5>Data de início: <?= $data_inicio_est;?></h5>
                                        <h5>Data de termino: <?= $data_termino_est;?></h5>
                                        <h5>Número de vagas: <?= $vagas_est;?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                     
                                        <h4 class="card-title" style="margin-top: 32px;">Link's Mercado Pago</h4>
                                        <h5>Link para aprovado</h5>
                                        <p>https://medhub.app.br/home.php?acao=etapa-1b</p>
                                        <h5>Link para em processo de aprovação</h5>
                                        <p>https://medhub.app.br/home.php?acao=etapa-1b</p>
                                        <br />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Pagamento Pix</h4>
                                        <h5><?= $val_pix_est;?></h5>
                                        <p><?= $chave_pix_est;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Descrição</h4>

                                        <p class="card-text">
                                            <?= $desc_est;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Edital</h4>

                                        <p class="card-text">
                                            <?= $edital_est;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-body">    
                                        <br />
                                        <h4 class="card-title">Prova</h4>
                                        
                                        <p class="card-text">
                                            <?= $link_prova_est;?>
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