
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <?php include_once 'controllers/hospital/ControllerSelect.php';?>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Hospital <?= $nome_hosp;?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card mb-4">
                                    <img class="card-img-top img-fluid" src="../upload/<?= $img_hosp;?>" alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card mb-4">
                   
                                    <div class="card-body">
                                        <h4 class="card-title">Hospital: <?= $nome_hosp;?></h4>
                                        <p class="card-text">
                                            Responsável: <strong> <?= $resp_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            Telefone: <strong> <?= $fone_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            Email: <strong> <?= $email_hosp;?></strong>
                                        </p> 
                                        <p class="card-text">
                                            Senha: <strong> <?= $senha_hosp;?></strong>
                                        </p>
                                        <hr />
                                        <p class="card-text">
                                            CEP: <strong> <?= $cep_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            UF: <strong> <?= $uf_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            Cidade: <strong> <?= $cidade_hosp;?></strong>
                                        </p> 
                                        <p class="card-text">
                                            Bairro: <strong> <?= $bairro_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            Rua: <strong> <?= $rua_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            Número: <strong> <?= $num_hosp;?></strong>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">MedHub</small>
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